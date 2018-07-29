<?php
/* @var $this SaleShopController */
/* @var $model SaleShop */

$this->breadcrumbs=array(
	'Sale Shops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SaleShop', 'url'=>array('index')),
	array('label'=>'Manage SaleShop', 'url'=>array('admin')),
);
?>

<h1>Create SaleShop</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>