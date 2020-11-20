#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import pymysql


def save_poc_scan_results(task_id, poc_id):
    # 数据库基本信息
    host = "localhost"
    username = "homestead"
    password = "secret"
    database = "hb_scanner"

    # 连接数据库
    db = pymysql.connect(host, username, password, database)
    cursor = db.cursor()

    # 如果存在漏洞则保存
    sql_insert = "INSERT INTO poc_scan_results " \
                 "(task_id, poc_id) " \
                 "VALUES ({}, {})".format(task_id, poc_id)

    try:
        cursor.execute(sql_insert)
        db.commit()
    except:
        db.rollback()

    # 断开数据库
    db.close()


if __name__ == "__main__":
    pass
