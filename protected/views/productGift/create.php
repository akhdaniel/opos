<?php
$this->breadcrumbs=array(
	'Product Gifts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductGift','url'=>array('index')),
	array('label'=>'Manage ProductGift','url'=>array('admin')),
);
?>

<h1>Create ProductGift</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>