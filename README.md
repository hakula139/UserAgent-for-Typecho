# UserAgent for Typecho

Typecho 插件，用于在评论区显示用户使用的操作系统、浏览器信息及对应图标。

基于 <a href="http://www.useragentstring.com" target="_blank">User Agent String</a> 的 API。

## 使用说明

1. 解压后确保文件夹名为 UserAgent，将插件上传至网站目录的 /usr/plugins 下
2. 在 Typecho 后台「插件管理」处启用插件
3. 在需要显示的地方插入以下代码：

```php
<?php UserAgent_Plugin::render($comments->agent); ?>
```

## TODO

1. 目前对每一条 User Agent 都要调用 API，当一页有多条 UA 时页面加载速度很慢，未来可能会考虑将识别方式本地化。
2. 无法识别国产浏览器（其实还是 API 的问题），未来将通过更换其他平台的 API 或者本地化解决这个问题。

## 更新日志

- v0.1.0    第一个版本，尚处于测试阶段，请勿用于生产环境

## 致谢

### 原项目

本项目部分参考 <a href="https://github.com/ennnnny" target="_blank">ennnnny</a> 开发的项目 <a href="https://github.com/ennnnny/typecho" target="_blank">UserAgent for Typecho</a>，在此感谢。实际上原本我在自己博客上使用的就是此插件，但有些地方不太满意，因此就产生了本项目。

### Wordpress 插件

> <a href="https://2heng.xin/2017/10/19/show-comment-ua" target="_blank">在 WordPress 评论框显示用户 UA</a>

本项目主要参考此文章，在此感谢。本插件本质上就是将对应 Wordpress 插件移植到了 Typecho 平台。

## 问题反馈

由于本人实际只是代码初学者，又是第一次使用 Github，有很多地方其实都不太明白，肯定会有许多问题，希望大家多多指教。

除了在此提 Issue 外，也可以到我的 <a href="https://hakula.xyz" target="_blank">个人博客</a> 留言，或者通过 <a href="mailto:i@hakula.xyz" target="_blank">邮箱</a> 联系我。