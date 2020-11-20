#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from celery_tasks.Wappalyzer import save_finger_result
from celery_tasks.celery import HBScanner_cel


@HBScanner_cel.task
def finger_scan(task_id):
    save_finger_result(task_id)


