<?php
/* @var $this SaleShopController */
/* @var $model SaleShop */

$this->breadcrumbs=array(
	'Sale Shops'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SaleShop', 'url'=>array('index')),
	array('label'=>'Create SaleShop', 'url'=>array('create')),
	array('label'=>'View SaleShop', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SaleShop', 'url'=>array('admin')),
);
?>

<h1>Update SaleShop <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>