<?php

/**
 * UserAgent for Typecho
 *
 * @package UserAgent
 * @author Hakula
 * @link https://hakula.xyz/
 * @version 0.1.0
 */
class UserAgent_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法，如果激活失败，直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
    }

    /**
     * 禁用插件方法，如果禁用失败，直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        /* 图标大小 */
        $size = new Typecho_Widget_Helper_Form_Element_Radio(
            'size',
            array(
                '12' => '12px 大小',
                '13' => '13px 大小',
                '14' => '14px 大小',
                '15' => '15px 大小',
                '16' => '16px 大小',
                '17' => '17px 大小',
                '18' => '18px 大小'
            ),
            '16',
            _t('选择图标尺寸大小'),
            _t('')
        );
        $form->addInput($size->multiMode());

        /* 显示模式 */
        $display = new Typecho_Widget_Helper_Form_Element_Radio(
            'display',
            array(
                '0' => '只显示图标',
                '1' => '只显示文字',
                '2' => '显示图片和文字'
            ),
            '0',
            _t('选择 UserAgent 显示模式'),
            _t('')
        );
        $form->addInput($display->multiMode());
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render($ua)
    {
        $options = Typecho_Widget::widget('Widget_Options');
        $url_plugin = $options->pluginUrl . '/UserAgent/';  // 插件地址 -> https://example.com/usr/plugins/UserAgent/
        global $url_img, $size;
        $url_img = $url_plugin . "img/";

        $size = Typecho_Widget::widget('Widget_Options')->plugin('UserAgent')->size;
        $display = Typecho_Widget::widget('Widget_Options')->plugin('UserAgent')->display;

        /* URLencode */
        $url_parm = urlencode($ua);
 
        /* 利用 UserAgentString 的 API */
        error_reporting(E_ERROR); 
        // ini_set("display_errors", "Off");
        $request = "http://www.useragentstring.com/?uas=" . $url_parm . "&getJSON=all";
        $getua = json_decode(file_get_contents($request));
        $BrowserName = $getua->agent_name; // 浏览器名称
        $BrowserVersion = $getua->agent_version; // 浏览器版本
        $OsType = $getua->os_type; // 操作系统类型
        $OsName = $getua->os_name; // 操作系统名称
        $OsVersion = $getua->os_versionNumber; // 操作系统版本
        $LinuxDistibution = $getua->linux_distibution; // Linux 发行版
 
        /* 图标文件名适配 */
        /* 浏览器 */
        switch ($BrowserName) {
            case "Chrome":
            case "Firefox":
            case "Safari":
            case "Edge":
            case "Opera":
            case "QQBrowser":
            case "BlackBerry":
                $img_browser = $BrowserName;
                break;
            case "Sogou Explorer":
            case "Internet Explorer":
            case "Android Webkit Browser":
                $img_browser = str_replace(" ", "-", $BrowserName);
                break;
            default:
                $img_browser = "Others";
                break;
        }
 
        /* 操作系统 */
        if ($OsType == "Windows") {
            switch ($OsName) {
                case "Windows 10":
                    $img_system = "Windows-10";
                    break;
                case "Windows 8.1":
                case "Windows 8":
                    $img_system = "Windows-8";
                    break;
                default:
                    $img_system = "Windows";
                    break;
            }
        } elseif ($OsType == "Android") {
            $img_system = "Android";
        } elseif ($OsName == "OS X" || ($OsName == "iPhone OS") || $OsType == "Macintosh") {
            $img_system = "Apple";
        } elseif ($OsType == "Linux") {
            if (($LinuxDistibution == "Ubuntu") || ($LinuxDistibution == "CentOS") || ($LinuxDistibution == "Fedora") || ($LinuxDistibution == "Debian")) {
                $img_system = $LinuxDistibution;
            } else if ($LinuxDistibution == "Red Hat") {
                $img_system = "Red-Hat";
            } else {
                $img_system = "Linux";
            }
        } elseif (($OsType == "FreeBSD") || ($OsType == "BlackBerryOS")) {
            $img_system = $OsType;
        } else {
            $img_system = "Others";
        }

        /* 图标 */
        if ($OsVersion != "") {
            $OsImg = self::img("os/", $img_system, $OsName . "&nbsp;" . $OsVersion);
        } else {
            $OsImg = self::img("os/", $img_system, $OsName);
        }

        if ($BrowserVersion != "--") {
            $BrowserImg = self::img("browser/", $img_browser, $BrowserName . "&nbsp;" . $BrowserVersion);
        } else {
            $BrowserImg = self::img("browser/", $img_browser, $BrowserName);
        }

        /* 显示模式 */
        switch ($display) {
            case 0:
                $ua = "&nbsp;&nbsp;" . $OsImg . "&nbsp;&nbsp;" . $BrowserImg;
                break;
            case 1:
                $ua = "&nbsp;&nbsp;(&nbsp;" . $OsName . "&nbsp;/&nbsp;" . $BrowserName . "&nbsp;" . $BrowserVersion . "&nbsp;)";
                break;
            case 2:
                $ua = "&nbsp;&nbsp;(&nbsp;" . $OsImg . "&nbsp;" . $OsName . "&nbsp;/&nbsp;" . $BrowserImg . "&nbsp;" . $BrowserName . "&nbsp;" . $BrowserVersion . "&nbsp;)";
                break;
            default:
                $ua = "&nbsp;&nbsp;" . $OsImg . "&nbsp;&nbsp;" . $BrowserImg;
                break;
        }

        echo $ua;
    }

    /**
     * 图标
     *
     * @access public
     * @return void
     */
    public static function img($type, $name, $title)
    {
        global $size, $url_img;

        // 默认大小 16px
        if ($size == "") {
            $size = 16;
        }

        $img = "<img nogallery class='icon-ua' src='" . $url_img . $type . $name . ".svg' title='" . $title . "' alt='" . $title . "' height='" . $size . "' style='vertical-align:-2px;' />";

        return $img;
    }
}