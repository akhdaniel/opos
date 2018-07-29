<?php
$this->breadcrumbs=array(
	'Prepare Barcodes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PrepareBarcode','url'=>array('index')),
	array('label'=>'Create PrepareBarcode','url'=>array('create')),
	array('label'=>'View PrepareBarcode','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PrepareBarcode','url'=>array('admin')),
);
?>

<h1>Update PrepareBarcode <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>