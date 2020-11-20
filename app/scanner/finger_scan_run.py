#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sys

from celery_tasks.finger_scan_task import finger_scan

if __name__ == "__main__":
    task_id = sys.argv[1]
    finger_scan.delay(task_id)
