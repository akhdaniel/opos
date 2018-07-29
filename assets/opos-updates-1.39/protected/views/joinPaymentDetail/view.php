<?php
/* @var $this JoinPaymentDetailController */
/* @var $model JoinPaymentDetail */

$this->breadcrumbs=array(
	'Join Payment Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JoinPaymentDetail', 'url'=>array('index')),
	array('label'=>'Create JoinPaymentDetail', 'url'=>array('create')),
	array('label'=>'Update JoinPaymentDetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JoinPaymentDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JoinPaymentDetail', 'url'=>array('admin')),
);
?>

<h1>View JoinPaymentDetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'join_payment_id',
		'order_id',
		'amount',
	),
)); ?>
