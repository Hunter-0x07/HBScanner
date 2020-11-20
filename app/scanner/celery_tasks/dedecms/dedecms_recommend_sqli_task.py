#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from celery_tasks.celery import HBScanner_cel
from celery_tasks.dedecms.dedecms_recommend_sqli import DedecmsRecommendSqliBaseVerify


@HBScanner_cel.task
def dedecms_recommend_sqli_BaseVerify(url, task_id, poc_id):
    testVuln = DedecmsRecommendSqliBaseVerify(url, task_id, poc_id)
    testVuln.run()
