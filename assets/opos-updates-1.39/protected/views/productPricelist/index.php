<?php
/* @var $this ProductPricelistController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Pricelists',
);

$this->menu=array(
	array('label'=>'Create ProductPricelist', 'url'=>array('create')),
	array('label'=>'Manage ProductPricelist', 'url'=>array('admin')),
);
?>

<h1>Product Pricelists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
