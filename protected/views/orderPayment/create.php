<?php
/* @var $this OrderPaymentController */
/* @var $model OrderPayment */

$this->breadcrumbs=array(
	'Order Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderPayment', 'url'=>array('index')),
	array('label'=>'Manage OrderPayment', 'url'=>array('admin')),
);
?>

<h1>Create OrderPayment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>