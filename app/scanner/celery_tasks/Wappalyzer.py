#!/usr/bin/env python3
# -*- coding:utf-8 -*-

import re
import json
import requests
from bs4 import BeautifulSoup
import pymysql


class WebPage(object):
    """获取指定url页面并通过BeautifulSoup提取特征

    特征包括: url, html content, headers, script, 
    title, meta tags
    """

    def __init__(self, url: str, verify=True) -> None:
        """初始化

        :param: 目标url
        :return: None
        """
        response = requests.get(url, verify=verify, timeout=10)
        self.url = url
        self.html = response.content.decode('utf8')
        self.headers = response.headers

        # 通过BeautifulSoup解析html响应并提取tags
        self.parsed_html = soup = BeautifulSoup(self.html, "html.parser")
        self.scripts = [script['src'] for script in
                        soup.findAll('script', src=True)]
        self.meta = {
            meta['name'].lower():
                meta['content'] for meta in soup.findAll(
                'meta', attrs=dict(name=True, content=True))
        }

        self.title = soup.title.string if soup.title else 'None'

        wappalyzer = Wappalyzer()
        self.apps = wappalyzer.analyze(self)

    def info(self) -> dict:
        """返回指纹匹配结果"""
        return list(self.apps)


class Wappalyzer(object):
    """
    """

    def __init__(self, apps_file=None):
        """初始化"""
        if apps_file:
            with open(apps_file, 'r') as fd:
                obj = json.load(fd)
        else:
            with open("/home/vagrant/code/scanner/celery_tasks/apps.json", 'r') as fd:
                obj = json.load(fd)

        self.categories = obj['categories']
        self.apps = obj['apps']

        for name, app in self.apps.items():
            self._prepare_app(app)

    def _prepare_app(self, app):
        """"""

        for key in ['url', 'html', 'script', 'implies']:
            value = app.get(key)
            if value is None:
                app[key] = []
            else:
                if not isinstance(value, list):
                    app[key] = [value]

        for key in ['headers', 'meta']:
            value = app.get(key)
            if value is None:
                app[key] = {}

        obj = app['meta']
        if not isinstance(obj, dict):
            app['meta'] = {'generator': obj}

        for key in ['headers', 'meta']:
            obj = app[key]
            app[key] = {k.lower(): v for k, v in obj.items()}

        for key in ['url', 'html', 'script']:
            app[key] = [self._prepare_pattern(pattern) for pattern in app[key]]

        for key in ['headers', 'meta']:
            obj = app[key]
            for name, pattern in obj.items():
                obj[name] = self._prepare_pattern(obj[name])

    def _prepare_pattern(self, pattern):
        """
        编译正则匹配模式
        """
        regex, _, rest = pattern.partition('\\;')
        try:
            return re.compile(regex, re.I)
        except re.error as e:
            # regex that never matches:
            # http://stackoverflow.com/a/1845097/413622
            return re.compile(r'(?!x)x')

    def _has_app(self, app, webpage):
        """
        匹配是否web page对象有指纹库相应特征
        """

        for regex in app['url']:
            if regex.search(webpage.url):
                return True

        for name, regex in app['headers'].items():
            if name in webpage.headers:
                content = webpage.headers[name]
                if regex.search(content):
                    return True

        for regex in app['script']:
            for script in webpage.scripts:
                if regex.search(script):
                    return True

        for name, regex in app['meta'].items():
            if name in webpage.meta:
                content = webpage.meta[name]
                if regex.search(content):
                    return True

        for regex in app['html']:
            if regex.search(webpage.html):
                return True

    def _get_implied_apps(self, detected_apps):
        """"""

        def __get_implied_apps(apps):
            _implied_apps = set()
            for app in apps:
                if 'implies' in self.apps[app]:
                    _implied_apps.update(set(self.apps[app]['implies']))
            return _implied_apps

        implied_apps = __get_implied_apps(detected_apps)
        all_implied_apps = set()

        while not all_implied_apps.issuperset(implied_apps):
            all_implied_apps.update(implied_apps)
            implied_apps = __get_implied_apps(all_implied_apps)

        return all_implied_apps

    def get_categories(self, app_name):
        """
        以列表形式返回指纹所属类别
        """
        cat_nums = self.apps.get(app_name, {}).get("cats", [])
        cat_names = [self.categories.get("%s" % cat_num, "")
                     for cat_num in cat_nums]

        return cat_names

    def analyze(self, webpage):
        """
        以列表形式返回web page对象中匹配好的指纹
        """
        detected_apps = set()

        for app_name, app in self.apps.items():
            if self._has_app(app, webpage):
                detected_apps.add(app_name)

        detected_apps |= self._get_implied_apps(detected_apps)

        return detected_apps


def save_finger_result(target_id):
    """
    保存指纹数据
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
    sql_find = "select * from finger_scan_tasks where id = {}".format(
        target_id)
    cursor.execute(sql_find)
    result = cursor.fetchone()
    target = result[2]
    if not target.startswith('http://') and not target.startswith("https://"):
        target = "http://" + target
    task_name = result[1]

    # 更新子域名枚举任务表状态为running
    scan_status = "running"
    sql_update = "update finger_scan_tasks " \
                 "set status = '{}'" \
                 "where id = {}".format(scan_status, target_id)
    try:
        cursor.execute(sql_update)
        db.commit()
    except:
        db.rollback()

    # 对目标执行扫描并返回扫描结果
    try:
        wp_obj = WebPage(target)
        finger_results = wp_obj.info()

        # 将扫描结果保存到任务结果表
        for finger in finger_results:
            sql_insert = "INSERT INTO finger_scan_results " \
                         "(task_id, target_domain, target_app) " \
                         "VALUES " \
                         "({}, '{}', '{}')".format(target_id, target, finger)

            try:
                cursor.execute(sql_insert)
                db.commit()
            except:
                db.rollback()

        # 更新扫描任务状态为completed
        scan_status = "completed"
        sql_update = "UPDATE finger_scan_tasks " \
                     "SET status = '{}'" \
                     "WHERE id = {}".format(scan_status, target_id)
        try:
            cursor.execute(sql_update)
            db.commit()
        except:
            db.rollback()
    except:
        # 更新任务状态为failed
        scan_status = "failed"
        sql_update = "UPDATE finger_scan_tasks " \
                     "SET status = '{}'" \
                     "WHERE id = {}".format(scan_status, target_id)
        try:
            cursor.execute(sql_update)
            db.commit()
        except:
            db.rollback()

    # 关闭数据库连接
    db.close()


if __name__ == "__main__":
    # target = "http://test.com"
    # wp_obj = WebPage(target)
    # finger_results = wp_obj.info()
    # dict = json.loads('./apps.json')
    pass
