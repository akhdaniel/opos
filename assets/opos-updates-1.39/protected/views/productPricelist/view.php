<?php
/* @var $this ProductPricelistController */
/* @var $model ProductPricelist */

$this->breadcrumbs=array(
	'Product Pricelists'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ProductPricelist', 'url'=>array('index')),
	array('label'=>'Create ProductPricelist', 'url'=>array('create')),
	array('label'=>'Update ProductPricelist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductPricelist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductPricelist', 'url'=>array('admin')),
);
?>

<h1>View ProductPricelist #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'currency_id',
		'name',
		'active',
		'type',
		'company_id',
	),
)); ?>
