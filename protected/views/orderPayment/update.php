<?php
/* @var $this OrderPaymentController */
/* @var $model OrderPayment */

$this->breadcrumbs=array(
	'Order Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderPayment', 'url'=>array('index')),
	array('label'=>'Create OrderPayment', 'url'=>array('create')),
	array('label'=>'View OrderPayment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OrderPayment', 'url'=>array('admin')),
);
?>

<h1>Update OrderPayment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>