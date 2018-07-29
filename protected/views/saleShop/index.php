<?php
/* @var $this SaleShopController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sale Shops',
);

$this->menu=array(
	array('label'=>'Create SaleShop', 'url'=>array('create')),
	array('label'=>'Manage SaleShop', 'url'=>array('admin')),
);
?>

<h1>Sale Shops</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
