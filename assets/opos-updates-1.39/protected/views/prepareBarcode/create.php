<?php
$this->breadcrumbs=array(
	'Prepare Barcodes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PrepareBarcode','url'=>array('index')),
	array('label'=>'Manage PrepareBarcode','url'=>array('admin')),
);
?>

<h1>Create PrepareBarcode</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>