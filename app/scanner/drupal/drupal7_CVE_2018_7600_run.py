#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sys

sys.path.append("/home/vagrant/code/scanner/")

from celery_tasks.drupal.drupal7_CVE_2018_7600_task import drupal7_cve_2018_7600_verify

if __name__ == "__main__":
    url = sys.argv[1]
    task_id = sys.argv[2]
    poc_id = sys.argv[3]
    drupal7_cve_2018_7600_verify.delay(url, task_id, poc_id)

