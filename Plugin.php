<?php

/**
 * UserAgent for Typecho
 *
 * @package UserAgent
 * @author Hakula
 * @version 0.2.3
 * @link https://hakula.xyz/
 */

class UserAgent_Plugin implements Typecho_Plugin_Interface {
    /**
     * 激活插件方法，如果激活失败，直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {}

    /**
     * 禁用插件方法，如果禁用失败，直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate() {}

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form) {
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
    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render($ua) {
        $options = Typecho_Widget::widget('Widget_Options');
        $url_plugin = $options->pluginUrl . '/UserAgent/';  // 插件地址 -> https://example.com/usr/plugins/UserAgent/
        global $url_img, $size;
        $url_img = $url_plugin . "img/";
        $size = Typecho_Widget::widget('Widget_Options')->plugin('UserAgent')->size;
        $display = Typecho_Widget::widget('Widget_Options')->plugin('UserAgent')->display;

        /* 操作系统 */
        require_once 'get_os.php';
        $Os = get_os($ua);
        $OsImg = self::img("os/", $Os['code'], $Os['title']);
        $OsName = $Os['title'];

        /* 浏览器 */
        require_once 'get_browser_name.php';
        $Browser = get_browser_name($ua);
        $BrowserImg = self::img("browser/", $Browser['code'], $Browser['title']);
        $BrowserName = $Browser['title'];

        /* 显示模式 */
        switch ($display) {
            case 0:
                $ua = "&nbsp;&nbsp;" . $OsImg . "&nbsp;&nbsp;" . $BrowserImg;
                break;
            case 1:
                $ua = "&nbsp;&nbsp;(&nbsp;" . $OsName . "&nbsp;/&nbsp;" . $BrowserName . "&nbsp;)";
                break;
            default:
                $ua = "&nbsp;&nbsp;(&nbsp;" . $OsImg . "&nbsp;" . $OsName . "&nbsp;/&nbsp;" . $BrowserImg . "&nbsp;" . $BrowserName . "&nbsp;)";
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
    public static function img($type, $name, $title) {
        global $size, $url_img;
        $img = "<img nogallery class='icon-ua' src='" . $url_img . $type . $name . ".svg' title='" . $title . "' alt='" . $title . "' height='" . $size . "' style='vertical-align:-2px;' />";
        return $img;
    }
}
