<?php
/* @var $this JoinPaymentDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Join Payment Details',
);

$this->menu=array(
	array('label'=>'Create JoinPaymentDetail', 'url'=>array('create')),
	array('label'=>'Manage JoinPaymentDetail', 'url'=>array('admin')),
);
?>

<h1>Join Payment Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
