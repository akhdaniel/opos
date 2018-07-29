<?php
$this->breadcrumbs=array(
	'Stock Moves'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StockMove','url'=>array('index')),
	array('label'=>'Create StockMove','url'=>array('create')),
	array('label'=>'View StockMove','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StockMove','url'=>array('admin')),
);
?>

<h1>Update StockMove <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>