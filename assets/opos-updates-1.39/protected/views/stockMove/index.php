<?php
$this->breadcrumbs=array(
	'Stock Moves',
);

$this->menu=array(
	array('label'=>'Create StockMove','url'=>array('create')),
	array('label'=>'Manage StockMove','url'=>array('admin')),
);
?>

<h1>Stock Moves</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
