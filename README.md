# 碳·谈    [![Build Status](https://travis-ci.org/qcminecraft/Carbon-Forum-F.svg?branch=master)](https://travis-ci.org/qcminecraft/Carbon-Forum-F)
**警告：当前版本并不稳定，请勿用于生产环境，请及时备份数据！！**

* 一个高效美观的PHP开源论坛


## 相关项目

* [原项目](https://github.com/lincanbin/Carbon-Forum)
* [API 文档](https://github.com/lincanbin/Carbon-Forum-API-Documentation)
* Android 客户端

## 依赖

* PHP >=5.4.0
* [__PDO_MYSQL__](http://php.net/manual/en/ref.pdo-mysql.php)
* MySQL >=5.0
* [__mod_rewrite__](http://httpd.apache.org/docs/2.2/mod/mod_rewrite.html) Apache module / [__ngx_http_rewrite_module__](https://github.com/qcminecraft/Carbon-Forum-F/blob/master/nginx.conf) / [__ISAPI_Rewrite__](http://www.helicontech.com/isapi_rewrite/) IIS module / IIS7+. 
* 如果使用Apache作为http服务器，则需要 [__mod_headers__](http://httpd.apache.org/docs/2.2/mod/mod_headers.html)

## 安装

1. 请确保目录权限为 777
2. 打开 ```http://www.yourdomain.com/install``` 并安装
3. 打开论坛并注册，第一个账号将成为管理员账号

## 升级

1. 备份文件( ```/upload/*``` ) 和数据库
2. 删除除了 ```/upload/*``` 外所有文件，上传最新版本。
3. 确保目录可读写
4. 打开 ```http://www.yourdomain.com/update``` 并更新

## 特性

* 移动端适配
* 实时通知推送
* 讨论标签为 Quora/StackOverflow 风格 
* API支持
* High FE&BE performance. 
* 全异步加载，提高页面加载速度
* Excellent search engine optimization (mobile adaptation Sitemap support) .
* Perfect draft saving mechanism. 
* The modern Notification Center (currently supported and @ replies).
* Geetest 验证码

## 贡献

[查看全部](https://github.com/qcminecraft/Carbon-Forum-F/graphs/contributors)



## 协议

``` 
Copyright 2006-2018 QingCao (qingcaomc@gmail.com)

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
```
