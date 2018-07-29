<?php
/* @var $this JoinPaymentPaymentController */
/* @var $model JoinPaymentPayment */

$this->breadcrumbs=array(
	'Join Payment Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JoinPaymentPayment', 'url'=>array('index')),
	array('label'=>'Create JoinPaymentPayment', 'url'=>array('create')),
	array('label'=>'View JoinPaymentPayment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JoinPaymentPayment', 'url'=>array('admin')),
);
?>

<h1>Update JoinPaymentPayment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>