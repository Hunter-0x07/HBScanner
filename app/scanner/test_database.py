#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import pymysql
from celery_tasks.Wappalyzer import save_finger_result, WebPage


def test_database():
    # 数据库基本信息
    host = "localhost"
    username = "homestead"
    password = "secret"
    database = "hb_scanner"

    # 连接数据库
    db = pymysql.connect(host, username, password, database)
    cursor = db.cursor()

    task_id = 1
    poc_id = 1

    # 如果存在漏洞则保存
    sql_insert = "INSERT INTO poc_scan_results " \
                 "(task_id, poc_id) " \
                 "VALUES ({}, {})".format(task_id, poc_id)

    cursor.execute(sql_insert)
    db.commit()

    # 断开数据库
    db.close()


if __name__ == "__main__":
    test_database()
