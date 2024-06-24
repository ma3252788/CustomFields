<?php

/**
 * Typecho自定义字段
 * 最新版本：v1.0.0
 *
 * @package CustomFields
 * @author 马春杰
 * @version 1.0.0
 * @link https://www.machunjie.com/opensource/1792.html
 * @link_gitee https://gitee.com/public_sharing/CustomFields
 * @link_github https://github.com/ma3252788/CustomFields
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class CustomFields_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->getDefaultFieldItems = array(__CLASS__, 'addCustomFields');
        return _t('插件已激活');
    }

    public static function deactivate()
    {
        return _t('插件已禁用');
    }

    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $fieldJson = new Typecho_Widget_Helper_Form_Element_Textarea('fieldJson', NULL, '[]', _t('字段配置'), _t('请输入字段配置的JSON字符串，例如: [{"name":"Bettor","label":"打赌人","description":"这是一个自定义字段"}]'));
        $form->addInput($fieldJson);
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}

    public static function addCustomFields($layout)
    {
        // 获取插件配置
        $options = Typecho_Widget::widget('Widget_Options');
        $customFields = json_decode($options->plugin('CustomFields')->fieldJson, true);

        if (is_array($customFields)) {
            foreach ($customFields as $field) {
                if (isset($field['name']) && isset($field['label'])) {
                    $description = isset($field['description']) ? $field['description'] : '';
                    $element = new Typecho_Widget_Helper_Form_Element_Text($field['name'], NULL, '', _t($field['label']), _t($description));
                    $layout->addItem($element);
                }
            }
        }
    }
}
?>