<?php
/* @var $this SaleShopController */
/* @var $model SaleShop */

$this->breadcrumbs=array(
	'Sale Shops'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SaleShop', 'url'=>array('index')),
	array('label'=>'Create SaleShop', 'url'=>array('create')),
	array('label'=>'Update SaleShop', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SaleShop', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SaleShop', 'url'=>array('admin')),
);
?>

<h1>View SaleShop #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'pricelist_id',
		'project_id',
		'name',
		'payment_default_id',
		'company_id',
		'warehouse_id',
	),
)); ?>
