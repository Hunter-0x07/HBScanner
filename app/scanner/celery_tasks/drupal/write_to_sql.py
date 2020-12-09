#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import pymysql


if __name__ == "__main__":
    host = "localhost"
    database = 'hb_scanner'
    username = "homestead"
    password = "secret"

    # 连接数据库
    db= pymysql.connect(host, username, password, database)
    cursor= db.cursor()

    # 构建列表字典
    poc_list = [
         {'poc_name': 'PhpMyAdmin2.8.0.3无需登录任意文件包含导致代码执行',
         'poc_path': 'scanner/dedecms/dedecms_recommend_sqli.py',
         'manufacturer': '上海卓卓网络科技有限公司',
         'type': 'sql注入',
         'level': '高危',
         'href': 'http://blog.csdn.net/change518/article/details/20564207'},
         {'poc_name': 'phpstudy phpmyadmin默认密码漏洞',
         'poc_path': 'scanner/dedecms/dedecms_recommend_sqli.py',
         'manufacturer': '上海卓卓网络科技有限公司',
         'type': 'sql注入',
         'level': '高危',
         'href': 'http://blog.csdn.net/change518/article/details/20564207'},
         {'poc_name': 'ThinkPHP 代码执行漏洞',
         'poc_path': 'scanner/dedecms/dedecms_recommend_sqli.py',
         'manufacturer': '上海卓卓网络科技有限公司',
         'type': 'sql注入',
         'level': '高危',
         'href': 'http://blog.csdn.net/change518/article/details/20564207'},
         {'poc_name': 'ThinkPHP V5代码执行漏洞',
         'poc_path': 'scanner/dedecms/dedecms_recommend_sqli.py',
         'manufacturer': '上海卓卓网络科技有限公司',
         'type': 'sql注入',
         'level': '高危',
         'href': 'http://blog.csdn.net/change518/article/details/20564207'}
         ]
    
    with db.cursor() as cursor:
        for poc in poc_list:
            sql = "INSERT INTO poc_list " \
                  "(poc_name, poc_path, manufacturer, type, level, href) " \
                  "VALUES " \
                  "('{}', '{}', '{}', '{}', '{}', '{}')".format(poc['poc_name'], poc['poc_path'], poc['manufacturer'], poc['type'], poc['level'], poc['href'])
            
            cursor.execute(sql)
    
    db.commit()