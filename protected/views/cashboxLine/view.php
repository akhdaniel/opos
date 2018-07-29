<?php
$this->breadcrumbs=array(
	'Cashbox Lines'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CashboxLine','url'=>array('index')),
	array('label'=>'Create CashboxLine','url'=>array('create')),
	array('label'=>'Update CashboxLine','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CashboxLine','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CashboxLine','url'=>array('admin')),
);
?>

<h1>View CashboxLine #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session_payment_id',
		'number_opening',
		'number_closing',
		'pieces',
		'oe_id',
	),
)); ?>
