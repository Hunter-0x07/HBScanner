#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from celery_tasks.port_scan import get_task_info, get_ip, save_data
from celery_tasks.port_scan import update_task_status
from celery_tasks.port_scan import PortScanThread
from celery_tasks.celery import HBScanner_cel
from queue import Queue

@HBScanner_cel.task
def port_scan(task_id):
    # 连接数据库并获取指定任务数据，目标域名或IP，起始端口
    # 和结束端口，线程数量，扫描方式
    result = get_task_info(task_id)
    target = result[0]
    start_port = result[1]
    end_port = result[2]
    thread_num = result[3]
    scan_method = result[4]

    # 尝试获取目标域名IP
    target_ip = get_ip(target)

    # 指定队列保存待存储数据
    data_queue = Queue()

    # 用队列存储待扫描的端口
    port_queue = Queue()
    for port in range(start_port, (end_port+1)):
        port_queue.put(port)

    # 列表保存已启动的端口扫描线程
    thread_list = []

    # 列表保存线程名
    thread_name_list = []
    for num in range(thread_num):
        thread_name = f"端口扫描线程_{num}"
        thread_name_list.append(thread_name)

    # 连接数据库并更新任务扫描状态为running
    task_status = "running"
    update_task_status(task_id, task_status)

    # 创建并启动端口扫描线程
    for thread_id in thread_name_list:
        thread = PortScanThread(
            thread_id = thread_id, 
            target_ip = target_ip, 
            scan_method = scan_method,
            port_queue = port_queue,
            data_queue = data_queue,
            )
        thread.start()
        thread_list.append(thread)

    # 等待所有任务执行结束
    for t in thread_list:
        t.join()

    # 将待存储数据从队列取出并保存到列表
    port_list = list(data_queue.queue)
    print(port_list)

    # 保存并更新任务执行状态
    if port_list:
        save_data(task_id, target_ip, port_list)
        task_status = 'completed'
        update_task_status(task_id, task_status)
    else:
        task_status = 'failed'
        update_task_status(task_id, task_status)

