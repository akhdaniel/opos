<?php
$this->breadcrumbs=array(
	'Stock Moves'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StockMove','url'=>array('index')),
	array('label'=>'Manage StockMove','url'=>array('admin')),
);
?>

<h1>Create StockMove</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>