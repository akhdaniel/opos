<?php
$this->breadcrumbs=array(
	'Product Discounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductDiscount','url'=>array('index')),
	array('label'=>'Manage ProductDiscount','url'=>array('admin')),
);
?>

<h1>Create ProductDiscount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>