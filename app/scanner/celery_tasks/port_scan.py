#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""基于Socket和Nmap的端口扫描
扫描方式:
(1)CONNECT(全连接)扫描
(2)SYN（半开放）扫描
(3)FIN扫描
(4)TCP Null扫描
"""

import socket
import threading
from queue import Queue
import pymysql
import nmap3
import logging
import sys
from scapy.all import *
from threading import Lock


# 配置logging日志选项
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s %(levelname)s %(message)s",
    datefmt="%m/%d/%Y %H:%M:%S",
)

lock = threading.Lock()


class PortScanThread(threading.Thread):
    """端口扫描线程类"""

    def __init__(self, thread_id: str, target_ip: str, scan_method: str, port_queue: Queue, data_queue: Queue) -> None:
        """初始化"""
        super().__init__()

        self.target_ip = target_ip
        self.port_queue = port_queue
        self.data_queue = data_queue
        self.thread_id = thread_id
        self.scan_method = scan_method

    def run(self):
        """调用功能函数"""
        logging.info(f"启动{self.thread_id}")

        # 选择扫描方式
        if self.scan_method == "connect":
            # 全连接扫描
            self.full_scan()
        elif self.scan_method == "syn":
            # 半开放扫描
            self.syn_scan()
        elif self.scan_method == "fin":
            # FIN扫描
            self.fin_scan()
        elif self.scan_method == "null":
            # TCP null扫描
            self.null_scan()

        logging.info(f"结束{self.thread_id}")

    def full_scan(self):
        """全连接扫描"""
        while not self.port_queue.empty():
            port = self.port_queue.get()
            logging.info(f"{self.thread_id}, 探测端口: {port}")

            # 建立套接字
            s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

            # 设置超时时间
            s.settimeout(1)

            # 建立TCP连接
            try:
                result = s.connect((self.target_ip, port))
                if not result:
                    logging.info(f"{port} 开放")
                    lock.acquire()
                    self.data_queue.put(port)
                    lock.release()

            except Exception as e:
                pass

            finally:
                # 关闭TCP连接
                s.close()

    def syn_scan(self):
        """半开放扫描"""
        while not self.data_queue.empty():
            port = self.data_queue.get()
            logging.info(f"{self.thread_id}, 探测端口: {port}")

            # 设置原地址和端口
            src_ip = "192.168.43.112"
            src_port = 4444

            # 设置IP头
            ipLayer = IP(src=src_ip, dst=self.target_ip)

            # 设置为syn数据包
            tcpLayer = TCP(sport=src_port, dport=port, flag="s")

            packet = ipLayer/tcpLayer

            # 设置超时时间
            timeout = 1

            # 发送数据包
            try:
                ans, unans = sr(packet, timeout=timeout)
                if ans:
                    # 判断响应包是否为syn, ack包
                    if (ans[0][1].getlayer(TCP).flags == 'SA'):
                        logging.info(f"{port} 开放")
                        self.data_queue.put(port)

                        # 之后构造rset包，中断连接
                        ipLayer = IP(src=src_ip, dst=self.target_ip)
                        tcpLayer = TCP(sport=src_port, dport=port, flag="R")
                        packet = ipLayer/tcpLayer
                        send(packet)

            except Exception as e:
                pass

    def fin_scan(self):
        """FIN扫描"""
        # 创建 nmap 对象
        nm = nmap3.Nmap()

        while not self.port_queue.empty():
            port = self.data_queue.get()
            logging.info(f"{self.thread_id}, 探测端口: {port}")

            # 指定扫描选项
            try:
                result = nm.scan(host=self.target_ip,
                                 arguments=f'-sF -p {port}', timout=2)
                if result:
                    logging.info(f"{port} 开放")
                    self.data_queue.put(port)

            except Exception as e:
                pass

    def null_scan(self):
        """Null扫描"""
        # 创建 nmap 对象
        nm = nmap3.Nmap()

        while not self.port_queue.empty():
            port = self.data_queue.get()
            logging.info(f"{self.thread_id}, 探测端口: {port}")

            # 指定扫描选项
            try:
                result = nm.scan(host=self.target_ip,
                                 arguments=f'-sN -p {port}', timout=1)
                if result:
                    logging.info(f"{port} 开放")
                    self.data_queue.put(port)

            except Exception as e:
                pass


def get_task_info(task_id: int) -> tuple:
    """连接数据库并获取指定任务数据，目标域名或IP，起始端口
    ，结束端口，线程数量

    :param task_id: 指定任务id
    :return: 任务数据元组
    """
    # 数据库基本信息
    host = "localhost"
    username = "homestead"
    password = "secret"
    database = "hb_scanner"

    # 连接数据库
    db = pymysql.connect(host, username, password, database)
    try:
        with db.cursor() as cursor:
            sql = "SELECT target, start_port, end_port, thread_num, scan_method " \
                  "FROM port_scan_tasks WHERE id = {}".format(task_id)

            # 执行sql查询
            cursor.execute(sql)
            result = cursor.fetchone()

        db.commit()

    except Exception as e:
        logging.error(f"发现错误: {e}")

    finally:
        # 关闭数据库连接
        db.close()

    return result


def get_ip(target: str) -> str:
    """获取目标域名的IP地址

    :param target: 目标域名
    :return: 目标IP地址
    """
    target_ip = socket.gethostbyname(target)

    return target_ip


def update_task_status(task_id: int, task_status: str) -> None:
    """更新扫描任务状态为failed

    :param task_id: 指定任务的id
    :param task_status: 指定任务的状态
    :return: None
    """
    # 数据库基本信息
    host = "localhost"
    username = "homestead"
    password = "secret"
    database = "hb_scanner"

    # 连接数据库
    db = pymysql.connect(host, username, password, database)
    try:
        with db.cursor() as cursor:
            sql = "UPDATE port_scan_tasks " \
                  "SET status = '{}' " \
                  "WHERE id = {}".format(task_status, task_id)

            cursor.execute(sql)

        db.commit()

    except Exception as e:
        logging.error(f"发现错误: {e}")

    finally:
        db.close()


def save_data(task_id: int, target_ip: str, port_list: list) -> None:
    """保存扫描结果并更新执行任务状态

    :param task_id: 任务id
    :param target_ip: 目标IP
    :param port_list: 目标开放端口列表
    :return: None
    """
    # 数据库基本信息
    host = "localhost"
    username = "homestead"
    password = "secret"
    database = "hb_scanner"

    # 连接数据库
    db = pymysql.connect(host, username, password, database)
    try:
        with db.cursor() as cursor:
            # 保存端口
            for port in port_list:
                sql_insert = "INSERT INTO port_scan_results " \
                             "(task_id, target_ip, open_port) " \
                             "values " \
                             "({}, '{}', {})".format(task_id, target_ip, port)

                cursor.execute(sql_insert)

        db.commit()

    except Exception as e:
        logging.error(f"发现错误: {e}")

    finally:
        db.close()


if __name__ == "__main__":
    # result = get_task_info(2)
    # logging.info(f"结果: {result}")
    # print(get_ip('www.secwalker.com'))
    # update_task_run(2)
    pass
