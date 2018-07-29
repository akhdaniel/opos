<?php
/* @var $this PosOrderLineController */
/* @var $model PosOrderLine */

$this->breadcrumbs=array(
	'Pos Order Lines'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PosOrderLine', 'url'=>array('index')),
	array('label'=>'Create PosOrderLine', 'url'=>array('create')),
	array('label'=>'Update PosOrderLine', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PosOrderLine', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PosOrderLine', 'url'=>array('admin')),
);
?>

<h1>View PosOrderLine #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'notice',
		'product_id',
		'order_id',
		'price_unit',
		'price_subtotal',
		'company_id',
		'price_subtotal_incl',
		'qty',
		'discount',
		'name',
	),
)); ?>
