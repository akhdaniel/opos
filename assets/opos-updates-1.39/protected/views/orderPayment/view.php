<?php
/* @var $this OrderPaymentController */
/* @var $model OrderPayment */

$this->breadcrumbs=array(
	'Order Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrderPayment', 'url'=>array('index')),
	array('label'=>'Create OrderPayment', 'url'=>array('create')),
	array('label'=>'Update OrderPayment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OrderPayment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderPayment', 'url'=>array('admin')),
);
?>

<h1>View OrderPayment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'order_id',
		'payment_type_id',
		'amount',
		'card_no',
	),
)); ?>
