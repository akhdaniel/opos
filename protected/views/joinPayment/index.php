<?php
/* @var $this JoinPaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Join Payments',
);

$this->menu=array(
	array('label'=>'Create JoinPayment', 'url'=>array('create')),
	array('label'=>'Manage JoinPayment', 'url'=>array('admin')),
);
?>

<h1>Join Payments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
