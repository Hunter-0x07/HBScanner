#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from celery_tasks.celery import HBScanner_cel
from celery_tasks.drupal.Drupal7_CVE_2018_7600 import Drupal7RemoteCodeExecute

@HBScanner_cel.task
def drupal7_cve_2018_7600_verify(url, task_id, poc_id):
    testVuln = Drupal7RemoteCodeExecute(url, task_id, poc_id)
    testVuln.run()




