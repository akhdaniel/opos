<?php
/* @var $this JoinPaymentDetailController */
/* @var $model JoinPaymentDetail */

$this->breadcrumbs=array(
	'Join Payment Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JoinPaymentDetail', 'url'=>array('index')),
	array('label'=>'Manage JoinPaymentDetail', 'url'=>array('admin')),
);
?>

<h1>Create JoinPaymentDetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>