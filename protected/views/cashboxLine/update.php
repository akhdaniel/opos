<?php
$this->breadcrumbs=array(
	'Cashbox Lines'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CashboxLine','url'=>array('index')),
	array('label'=>'Create CashboxLine','url'=>array('create')),
	array('label'=>'View CashboxLine','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CashboxLine','url'=>array('admin')),
);
?>

<h1>Update CashboxLine <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>