<?php
$this->breadcrumbs=array(
	'Product Gifts',
);

$this->menu=array(
	array('label'=>'Create ProductGift','url'=>array('create')),
	array('label'=>'Manage ProductGift','url'=>array('admin')),
);
?>

<h1>Product Gifts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
