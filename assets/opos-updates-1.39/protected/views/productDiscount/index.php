<?php
$this->breadcrumbs=array(
	'Product Discounts',
);

$this->menu=array(
	array('label'=>'Create ProductDiscount','url'=>array('create')),
	array('label'=>'Manage ProductDiscount','url'=>array('admin')),
);
?>

<h1>Product Discounts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
