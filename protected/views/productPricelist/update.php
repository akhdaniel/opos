<?php
/* @var $this ProductPricelistController */
/* @var $model ProductPricelist */

$this->breadcrumbs=array(
	'Product Pricelists'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductPricelist', 'url'=>array('index')),
	array('label'=>'Create ProductPricelist', 'url'=>array('create')),
	array('label'=>'View ProductPricelist', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductPricelist', 'url'=>array('admin')),
);
?>

<h1>Update ProductPricelist <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>