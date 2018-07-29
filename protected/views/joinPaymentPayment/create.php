<?php
/* @var $this JoinPaymentPaymentController */
/* @var $model JoinPaymentPayment */

$this->breadcrumbs=array(
	'Join Payment Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JoinPaymentPayment', 'url'=>array('index')),
	array('label'=>'Manage JoinPaymentPayment', 'url'=>array('admin')),
);
?>

<h1>Create JoinPaymentPayment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>