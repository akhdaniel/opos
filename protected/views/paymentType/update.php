<?php
$this->breadcrumbs=array(
	'Payment Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaymentType','url'=>array('index')),
	array('label'=>'Create PaymentType','url'=>array('create')),
	array('label'=>'View PaymentType','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PaymentType','url'=>array('admin')),
);
?>

<h1>Update PaymentType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>