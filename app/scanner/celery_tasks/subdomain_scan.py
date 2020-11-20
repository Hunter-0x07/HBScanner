#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
基于搜索引擎的子域名收集
"""

import requests
from bs4 import BeautifulSoup
from urllib.parse import urlparse
import pymysql


class SubDomainScan:
    """
    子域名收集，多种收集办法，例如基于搜索引擎，基于字典，基于第三方等
    """

    def __init__(self):
        """"""
        self._subdomain_list = []

    def bing_subdomain_search(self, site, pages):
        """
        基于bing搜索引擎收集子域名

        :param site: string 域名
        :param pages: string 搜索引擎页数
        :return: list
        """
        headers = {'User-Agent': 'Mozilla/5.0 (X11;Linux x86_64; rv:60.0) Gecko/20100101 Firefox/60.0',
                   'Accept': '*/*',
                   'Accept-Language': 'en-US,en;q=0.5',
                   'Accept-Encoding': 'gzip,deflate',
                   'referer': "http://cn.bing.com/search?q=email+site%3abaidu.com&qs=n&"
                              "sp=-1&pq=emailsite%3abaidu.com&first=2&FORM=PERE1"
                   }
        print("正在进行子域名收集...")

        for i in range(1, int(pages) + 1):
            url = "https://cn.bing.com/search?q=site%3a" + site + "&go=Search&qs=ds&" \
                                                                  "first=" + str((int(i) - 1) * 10) + "&FORM=PERE"
            conn = requests.session()
            conn.get("http://cn.bing.com", headers=headers)
            html = conn.get(url, stream=True, headers=headers, timeout=8)
            soup = BeautifulSoup(html.content, 'html.parser')
            job_bt = soup.findAll("h2")
            for i in job_bt:
                link = i.a.get("href")
                domain = str(urlparse(link).scheme + "://" + urlparse(link).netloc)
                if domain in self._subdomain_list:
                    pass
                else:
                    self._subdomain_list.append(domain)

        print("子域名收集完成")

        return self._subdomain_list

    def save_bing_subdomain_search(self, target_id):
        """
        基于bing搜索引擎收集子域名

        :param site: string 域名
        :param pages: string 搜索引擎页数
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
        sql_find = "select * from subdomain_scan_tasks where id = {}".format(target_id)
        cursor.execute(sql_find)
        result = cursor.fetchone()
        target = result[2]
        task_name = result[1]

        # 更新子域名枚举任务表状态为running
        scan_status = "running"
        sql_update = "update subdomain_scan_tasks " \
                     "set status = '{}'" \
                     "where id = {}".format(scan_status, target_id)
        try:
            cursor.execute(sql_update)
            db.commit()
        except:
            db.rollback()

        # 对目标执行扫描并返回扫描结果
        try:
            subdomain_scan_results = self.bing_subdomain_search(target, 15)

            # 将扫描结果保存到任务结果表
            for subdomain in subdomain_scan_results:
                sql_insert = "insert into subdomain_scan_results " \
                             "(task_id, target_domain, subdomain) " \
                             "values " \
                             "({}, '{}', '{}')".format(target_id, target, subdomain)

                try:
                    cursor.execute(sql_insert)
                    db.commit()
                except:
                    db.rollback()

            # 更新扫描任务状态为completed
            scan_status = "completed"
            sql_update = "update subdomain_scan_tasks " \
                         "set status = '{}'" \
                         "where id = {}".format(scan_status, target_id)
            try:
                cursor.execute(sql_update)
                db.commit()
            except:
                db.rollback()
        except:
            # 更新任务状态为failed
            scan_status = "failed"
            sql_update = "update subdomain_scan_tasks " \
                         "set status = '{}'" \
                         "where id = {}".format(scan_status, target_id)
            try:
                cursor.execute(sql_update)
                db.commit()
            except:
                db.rollback()

        # 关闭数据库连接
        db.close()


if __name__ == "__main__":
    site = "vulnweb.com"
    subdomain = SubDomainScan()
    subdomain_list = subdomain.bing_subdomain_search(site, 15)
    print(subdomain_list)
