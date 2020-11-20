#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from celery_tasks.port_scan import PortScan
from celery_tasks.celery import HBScanner_cel

@HBScanner_cel.task
def port_scan(task_id):
    ps = PortScan()
    ps.save_port_scan(task_id)


