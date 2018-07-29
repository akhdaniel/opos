<?php
/* @var $this JoinPaymentDetailController */
/* @var $model JoinPaymentDetail */

$this->breadcrumbs=array(
	'Join Payment Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JoinPaymentDetail', 'url'=>array('index')),
	array('label'=>'Create JoinPaymentDetail', 'url'=>array('create')),
	array('label'=>'View JoinPaymentDetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JoinPaymentDetail', 'url'=>array('admin')),
);
?>

<h1>Update JoinPaymentDetail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>