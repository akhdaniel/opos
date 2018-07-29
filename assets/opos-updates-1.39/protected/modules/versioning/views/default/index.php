<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId ?> Menu</h1>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create ZIP and Upload',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/versioning/default/createzip')
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Upgrade',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/versioning/default/upgrade'),
    'htmlOptions'=>array(
        'onclick'=>'return confirm("Are You Sure to Upgrade to the latest version?")'
    )
)); ?>
