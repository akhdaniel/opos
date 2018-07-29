<?php
$this->breadcrumbs=array(
	'App Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AppSetting','url'=>array('index')),
	array('label'=>'Create AppSetting','url'=>array('create')),
	array('label'=>'Update AppSetting','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AppSetting','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppSetting','url'=>array('admin')),
);
?>

<h1>View AppSetting #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'val',
	),
)); ?>
