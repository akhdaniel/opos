<?php
/* @var $this JoinPaymentPaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Join Payment Payments',
);

$this->menu=array(
	array('label'=>'Create JoinPaymentPayment', 'url'=>array('create')),
	array('label'=>'Manage JoinPaymentPayment', 'url'=>array('admin')),
);
?>

<h1>Join Payment Payments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
