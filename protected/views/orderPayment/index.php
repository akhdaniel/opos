<?php
/* @var $this OrderPaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Order Payments',
);

$this->menu=array(
	array('label'=>'Create OrderPayment', 'url'=>array('create')),
	array('label'=>'Manage OrderPayment', 'url'=>array('admin')),
);
?>

<h1>Order Payments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
