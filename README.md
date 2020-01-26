# UserAgent for Typecho

Typecho 插件，用于在评论区显示用户使用的操作系统、浏览器信息及对应图标。

## 使用说明

1. 解压后修改文件夹名为 UserAgent，将插件上传至网站目录的 `/usr/plugins` 下
2. 在 Typecho 后台「插件管理」处启用插件
3. 在需要显示的地方插入以下代码：

```php
<?php UserAgent_Plugin::render($comments->agent); ?>
```

## TODO

- 持续（按需）添加更多浏览器支持，冷门浏览器还是算了。

## 更新日志

- v0.2&emsp;（2019/01/28）将 UA 识别方式本地化，移植了 Wordpress 插件的识别方法。
- v0.1&emsp;（2019/01/27）第一个版本，尚处于测试阶段，请勿用于生产环境。

## 致谢

### 原项目

本项目基于 [ennnnny](https://github.com/ennnnny) 的项目 [UserAgent for Typecho](https://github.com/ennnnny/typecho)，在此感谢。

实际上原本我自己博客上使用的就是此插件，但有些地方不太满意，原作者似乎也不再更新了，于是我就打算自己动手丰衣足食，本项目因此诞生。

### Wordpress 插件

> [WP-UserAgent](https://wordpress.org/plugins/wp-useragent)

本项目实质就是将 Wordpress 平台的 UserAgent 插件移植到了 Typecho 平台，感谢原作者 [Kyle Baker](https://www.kyleabaker.com)。

### Iconfont

> [Iconfont](https://www.iconfont.cn) - 阿里巴巴矢量图标库

本项目操作系统、浏览器图标均使用 Iconfont 提供的 SVG 矢量图标，在此感谢。

## 问题反馈

由于本人实际只是代码初学者（甚至没学过 PHP 语言……），又是第一次使用 Github，很多地方都不太明白，还请大家多多指教。

除了在此提 Issue 外，也可以到我的[个人博客](https://hakula.xyz/project/ua_typecho.html)留言，或者通过[邮箱](mailto:i@hakula.xyz)联系我。

希望本插件能帮助到有需要的博主。
