<?php
$this->breadcrumbs=array(
	'Product Discounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductDiscount','url'=>array('index')),
	array('label'=>'Create ProductDiscount','url'=>array('create')),
	array('label'=>'View ProductDiscount','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ProductDiscount','url'=>array('admin')),
);
?>

<h1>Update ProductDiscount <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>