<?php
/* @var $this JoinPaymentPaymentController */
/* @var $model JoinPaymentPayment */

$this->breadcrumbs=array(
	'Join Payment Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JoinPaymentPayment', 'url'=>array('index')),
	array('label'=>'Create JoinPaymentPayment', 'url'=>array('create')),
	array('label'=>'Update JoinPaymentPayment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JoinPaymentPayment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JoinPaymentPayment', 'url'=>array('admin')),
);
?>

<h1>View JoinPaymentPayment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'join_payment_id',
		'payment_type_id',
		'amount',
		'card_no',
	),
)); ?>
