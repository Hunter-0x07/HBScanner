#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
端口扫描模块
"""
import nmap3
import json
import pymysql
import sys
import time

class PortScan:
    """
    """
    def __init__(self):
        """"""
        # 存放端口扫描结果
        self._port_scan_res = {}

        # 存放目标开放端口
        self._open_ports = []

        # 存放端口状态,open,filtered,closed,unfiltered
        self._port_status = ["open"]

    def port_scan(self, target):
        """
        进行端口扫描

        :param target: string 目标域名
        :return: dict {"ip": [21, 22, ...]}
        """
        nmap = nmap3.Nmap()

        # 扫描常用端口
        print("正在进行常用端口扫描...")
        res = nmap.scan_top_ports(target)

        # 从结果中获取目标IP地址
        target_ip = list(res.keys())[0]

        # 从结果中获取目标开放端口
        for target_info in list(res.values())[0]:
            if target_info["state"] in self._port_status:
                self._open_ports.append(target_info["portid"])

        self._port_scan_res["ip"] = target_ip
        self._port_scan_res["open_ports"] = self._open_ports

        print("常用端口扫描结束")

        return self._port_scan_res

    def save_port_scan(self, target_id):
        """
        根据任务id查询相应任务信息对其进行扫描，
        并将扫描结果保存到数据库

        :param target_id: int 任务id
        :return:
        """
        # 数据库基本信息
        host = "localhost"
        username = "homestead"
        password = "secret"
        database = "hb_scanner"

        # 连接数据库
        db = pymysql.connect(host, username, password, database)
        cursor = db.cursor()

        # 根据id查询数据库信息
        sql_find = "select * from port_scan_tasks where id = {}".format(target_id)
        cursor.execute(sql_find)
        result = cursor.fetchone()
        target = result[2]
        task_name = result[1]

        # 更新扫描任务表状态为running
        scan_status = "running"
        sql_update = "update port_scan_tasks " \
                     "set status = '{}'" \
                     "where id = {}".format(scan_status, target_id)
        try:
            cursor.execute(sql_update)
            db.commit()
        except:
            db.rollback()

        # 调用扫描器对目标执行扫描并返回扫描结果
        port_scan_results = self.port_scan(target)
        target_ip = port_scan_results['ip']
        target_open_ports = port_scan_results['open_ports']

        # 将扫描结果保存到数据库
        for open_port in target_open_ports:
            sql_insert = "insert into port_scan_results " \
                         "(task_id, target_ip, open_port) " \
                         "values " \
                         "({}, '{}', {})".format(target_id, target_ip, open_port)
            try:
                cursor.execute(sql_insert)
                db.commit()
            except:
                db.rollback()

        # 更新扫描任务状态为completed
        scan_status = "completed"
        sql_update = 'update port_scan_tasks ' \
                     'set status = "{}" ' \
                     'where id = {}'.format(scan_status, target_id)

        try:
            cursor.execute(sql_update)
            db.commit()
        except:
            db.rollback()

        # 关闭数据库连接
        db.close()


if __name__ == "__main__":
    """测试"""
    target_id = sys.argv[1]
    target = "secwalker.com"
    ps = PortScan()
    # print(ps.celery_tasks(target))
    ps.save_port_scan(target_id)


