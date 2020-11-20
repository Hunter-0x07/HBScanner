#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sys
from celery_tasks.subdomain_scan_task import subdomain_scan

if __name__ == "__main__":
    task_id = sys.argv[1]
    subdomain_scan.delay(task_id)