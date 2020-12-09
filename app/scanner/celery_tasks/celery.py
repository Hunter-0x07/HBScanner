#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from celery import Celery

BROKER_URL = 'amqp://secwalker:deng12345@localhost:5672/rabbitmq'

HBScanner_cel = Celery('HBScanner_celery',
                       broker=BROKER_URL,
                       include=[
                           'celery_tasks.port_scan_task',
                           'celery_tasks.subdomain_scan_task',
                           'celery_tasks.finger_scan_task',
                           'celery_tasks.dedecms.dedecms_recommend_sqli_task',
                           'celery_tasks.drupal.drupal7_CVE_2018_7600_task',
                       ])
