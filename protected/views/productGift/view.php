<?php
$this->breadcrumbs=array(
	'Product Gifts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductGift','url'=>array('index')),
	array('label'=>'Create ProductGift','url'=>array('create')),
	array('label'=>'Update ProductGift','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductGift','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductGift','url'=>array('admin')),
);
?>

<h1>View ProductGift #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'buy_qty',
		'gift_product_id',
		'get_qty',
	),
)); ?>
