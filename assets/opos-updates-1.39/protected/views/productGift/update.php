<?php
$this->breadcrumbs=array(
	'Product Gifts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductGift','url'=>array('index')),
	array('label'=>'Create ProductGift','url'=>array('create')),
	array('label'=>'View ProductGift','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ProductGift','url'=>array('admin')),
);
?>

<h1>Update ProductGift <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>