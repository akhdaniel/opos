<?php
$this->breadcrumbs=array(
	'Session Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SessionPayment','url'=>array('index')),
	array('label'=>'Create SessionPayment','url'=>array('create')),
	array('label'=>'View SessionPayment','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SessionPayment','url'=>array('admin')),
);
?>

<h1>Update SessionPayment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>