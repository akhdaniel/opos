<?php
/* @var $this JoinPaymentController */
/* @var $model JoinPayment */

$this->breadcrumbs=array(
	'Join Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JoinPayment', 'url'=>array('index')),
	array('label'=>'Create JoinPayment', 'url'=>array('create')),
	array('label'=>'View JoinPayment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JoinPayment', 'url'=>array('admin')),
);
?>

<h1>Update JoinPayment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>