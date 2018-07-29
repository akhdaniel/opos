<?php
/* @var $this PosConfigController */
/* @var $model PosConfig */

$this->breadcrumbs=array(
	'Pos Configs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PosConfig', 'url'=>array('index')),
	array('label'=>'Create PosConfig', 'url'=>array('create')),
	array('label'=>'Update PosConfig', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PosConfig', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PosConfig', 'url'=>array('admin')),
);
?>

<h1>View PosConfig #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'iface_vkeyboard',
		'iface_cashdrawer',
		'name',
		'state',
		'journal_id',
		'iface_self_checkout',
		'iface_electronic_scale',
		'shop_id',
		'group_by',
		'iface_payment_terminal',
		'sequence_id',
		'iface_print_via_proxy',
	),
)); ?>
