<?php
/* @var $this JoinPaymentController */
/* @var $model JoinPayment */

$this->breadcrumbs=array(
	'Join Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JoinPayment', 'url'=>array('index')),
	array('label'=>'Manage JoinPayment', 'url'=>array('admin')),
);
?>

<h1>Create JoinPayment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>