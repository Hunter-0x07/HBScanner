#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sys

sys.path.append("/home/vagrant/code/scanner/")

from celery_tasks.dedecms.dedecms_recommend_sqli_task import dedecms_recommend_sqli_BaseVerify

if __name__ == "__main__":
    url = sys.argv[1]
    task_id = sys.argv[2]
    poc_id = sys.argv[3]
    dedecms_recommend_sqli_BaseVerify.delay(url, task_id, poc_id)
