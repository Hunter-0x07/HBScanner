# HBScanner

> 期待：希望对安全技术的学习永远保持一颗炙热的心

## Description

**炙心"HeartBurn"** -- **计划打造一款分布式web漏洞扫描器**

##### 1).开发架构
- web端：基于 Bootstrap + Laravel + mysql
- 任务调度: celery + rabbitmq
- 扫描引擎: python

##### 2).信息收集功能
- 目标子域名收集
- 应用指纹识别
- 操作系统与端口服务探测

##### 3).漏洞检测功能
- 常见开发框架及CMS漏洞检测
- 常用中间件和第三方组件漏洞检测

## Status

##### 暂时暂停开发，预计明年3月开始重写

##### 1).为什么暂停开发？
- 功能代码实现糟糕，重复代码过多
- 进行开发知识与安全知识的补充，准备明年的重写

### Demonstration

![Demo](https://github.com/Hunter-0x07/HBScanner/blob/master/HBScanner.gif?raw=true)
