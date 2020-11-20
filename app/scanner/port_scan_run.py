#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sys

from celery_tasks.port_scan_task import port_scan

if __name__ == "__main__":
    task_id = sys.argv[1]
    port_scan.delay(task_id)
