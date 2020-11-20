#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from celery_tasks.celery import HBScanner_cel
from celery_tasks.subdomain_scan import SubDomainScan

@HBScanner_cel.task
def subdomain_scan(task_id):
    ds = SubDomainScan()
    ds.save_bing_subdomain_search(task_id)

