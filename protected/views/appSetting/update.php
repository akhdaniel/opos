<?php
$this->breadcrumbs=array(
	'App Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AppSetting','url'=>array('index')),
	array('label'=>'Create AppSetting','url'=>array('create')),
	array('label'=>'View AppSetting','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AppSetting','url'=>array('admin')),
);
?>

<h1>Update AppSetting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>