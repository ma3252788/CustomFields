<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
include 'header.php';
include 'menu.php';

$options = Typecho_Widget::widget('Widget_Options')->plugin('CustomFields');
?>

<div class="main">
    <div class="body container">
        <form method="post" action="<?php $options->adminUrl('options-plugin.php?config=CustomFields'); ?>">
            <label for="fields">自定义字段列表（每行一个字段名称）</label>
            <textarea id="fields" name="fields" rows="10"><?php echo htmlspecialchars($options->fields); ?></textarea>
            <button type="submit">保存</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
