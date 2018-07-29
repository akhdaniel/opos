<?php
$this->breadcrumbs=array(
	'Session Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SessionPayment','url'=>array('index')),
	array('label'=>'Create SessionPayment','url'=>array('create')),
	array('label'=>'Update SessionPayment','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SessionPayment','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SessionPayment','url'=>array('admin')),
);
?>

<h1>View SessionPayment #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session_id',
		'payment_type_id',
		'oe_statement_id',
	),
)); ?>
