<?php
$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Session','url'=>array('index')),
	array('label'=>'Create Session','url'=>array('create')),
	array('label'=>'View Session','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Session','url'=>array('admin')),
);
?>

<h1>Update Session <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>