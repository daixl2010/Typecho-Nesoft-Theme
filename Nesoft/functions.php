<?php
function themeConfig($form) {

	$global_notice = new Typecho_Widget_Helper_Form_Element_Text('global_notice', NULL, _t(''), _t('站点公告'), _t('在这里填入公告，不显示则留空'));
    $form->addInput($global_notice);
	
	$thumbDisplay = new Typecho_Widget_Helper_Form_Element_Radio('thumbDisplay', 
    array('yes' => _t('启用'), 'no' => _t('禁用')), 'display', _t('略缩图显示'),_t('不兼容timthumb的用户请禁用此功能；禁用后可删除Thumbnail插件'));
    $form->addInput($thumbDisplay);
	
    $global_beian = new Typecho_Widget_Helper_Form_Element_Text('global_beian', NULL, _t(''), _t('备案号'), _t('在这里填入天朝备案号，不显示则留空'));
    $form->addInput($global_beian);
	
	$seo_zdts = new Typecho_Widget_Helper_Form_Element_Textarea('seo_zdts', NULL, NULL, _t('百度推送代码'), _t('这里输入你的推送代码,不填则不显示。'));
    $form->addInput($seo_zdts);
	
	$seo_analysis_yb = new Typecho_Widget_Helper_Form_Element_Textarea('seo_analysis_yb', NULL, NULL, _t('流量统计'), _t('这里输入你的统计代码,网站头部加载。'));
    $form->addInput($seo_analysis_yb);
	
	$ad_list = new Typecho_Widget_Helper_Form_Element_Textarea('ad_list', NULL, NULL, _t('列表广告'), _t('这里输入你的广告代码,不填则不显示。'));
    $form->addInput($ad_list);
	
	$ad_single_top = new Typecho_Widget_Helper_Form_Element_Textarea('ad_single_top', NULL, NULL, _t('文章上部广告'), _t('这里输入你的广告代码,不填则不显示。'));
    $form->addInput($ad_single_top);
	
	$ad_comments_top = new Typecho_Widget_Helper_Form_Element_Textarea('ad_comments_top', NULL, NULL, _t('评论上部广告'), _t('这里输入你的广告代码,不填则不显示。'));
    $form->addInput($ad_comments_top);
	
	$ad_widget_top = new Typecho_Widget_Helper_Form_Element_Textarea('ad_widget_top', NULL, NULL, _t('右边栏广告'), _t('这里输入你的广告代码,不填则不显示。'));
    $form->addInput($ad_widget_top);
}

