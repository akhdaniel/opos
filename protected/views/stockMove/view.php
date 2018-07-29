<?php
$this->breadcrumbs=array(
	'Stock Moves'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StockMove','url'=>array('index')),
	array('label'=>'Create StockMove','url'=>array('create')),
	array('label'=>'Update StockMove','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StockMove','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StockMove','url'=>array('admin')),
);
?>

<h1>View StockMove #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session_id',
		'product_id',
		'qty',
	),
)); ?>
