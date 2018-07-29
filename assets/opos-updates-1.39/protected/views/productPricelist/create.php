<?php
/* @var $this ProductPricelistController */
/* @var $model ProductPricelist */

$this->breadcrumbs=array(
	'Product Pricelists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductPricelist', 'url'=>array('index')),
	array('label'=>'Manage ProductPricelist', 'url'=>array('admin')),
);
?>

<h1>Create ProductPricelist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>