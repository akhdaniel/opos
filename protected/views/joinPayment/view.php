<?php
/* @var $this JoinPaymentController */
/* @var $model JoinPayment */

$this->breadcrumbs=array(
	'Join Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JoinPayment', 'url'=>array('index')),
	array('label'=>'Create JoinPayment', 'url'=>array('create')),
	array('label'=>'Update JoinPayment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JoinPayment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JoinPayment', 'url'=>array('admin')),
);
?>

<h1>View JoinPayment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'join_number',
		'join_date',
		'total_paid',
		'total_change',
		'state',
		'salesman_id',
		'session_id',
	),
)); ?>
