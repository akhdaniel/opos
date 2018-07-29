<?php
$this->breadcrumbs=array(
	'Prepare Barcodes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PrepareBarcode','url'=>array('index')),
	array('label'=>'Create PrepareBarcode','url'=>array('create')),
	array('label'=>'Update PrepareBarcode','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete PrepareBarcode','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PrepareBarcode','url'=>array('admin')),
);
?>

<h1>View PrepareBarcode #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'qty',
	),
)); ?>
