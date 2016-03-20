<?php
/**
 * KindEditor编辑器 For Typecho
 * 
 * @package KEditor 
 * @author ljweb
 * @version 1.0.6
 * @link http://ljweb.com.ru
 */
class KEditor_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('admin/write-post.php')->richEditor = array('KEditor_Plugin', 'render');
        Typecho_Plugin::factory('admin/write-page.php')->richEditor = array('KEditor_Plugin', 'render');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        /** 换行符设置 */
        $newlineTag = new Typecho_Widget_Helper_Form_Element_Text('newlineTag', NULL, 'br', _t('设置回车换行符'), _t('可选参数：p, br'));
		$form->addInput($newlineTag);

        $themesTab = new Typecho_Widget_Helper_Form_Element_Text('themesTab', NULL, 'default', _t('设置编辑器风格'), _t('默认风格：default'));
		$form->addInput($themesTab);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function render($post)
    {
        $options = Helper::options();
		$plugin_options = Typecho_Widget::widget('Widget_Options')->plugin('KEditor');
		$newlineTag = $plugin_options->newlineTag;
		$themesTab = $plugin_options->themesTab;
		$editor_path = Typecho_Common::url('KEditor/editor', $options->pluginUrl);
		echo "
<script type=\"text/javascript\" charset=\"utf-8\" src=\"{$editor_path}/kindeditor.js\"></script> 
<script type=\"text/javascript\">
    KE.show({
		resizeMode : 1,
	    themesPath : '{$themesTab}',
		langPath : 'zh_CN',
	    newlineTag : '{$newlineTag}',
        id : 'text'
    });
	$('btn-save').addEvent('mouseover', function (e) {
		KE.util.setData('text'); 
	});
	$('btn-submit').addEvent('mouseover', function (e) {
		KE.util.setData('text'); 
	});
    function insertHtml(id, html) {
        KE.util.focus(id);
        KE.util.selection(id);
        KE.util.insertHtml(id, html);
    }
    /** 附件插入实现 */
    var insertImageToEditor = function (title, url, link) {
        insertHtml('text', '<a href=\"' + link + '\" title=\"' + title + '\"><img src=\"' + url + '\" alt=\"' + title + '\" /></a>');
    };
    var insertLinkToEditor = function (title, url, link) {
        insertHtml('text', '<a href=\"' + url + '\" title=\"' + title + '\">' + title + '</a>');
    };
</script>";
    }
}