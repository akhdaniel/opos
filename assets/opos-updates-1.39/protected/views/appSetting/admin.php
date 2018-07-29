<?php
$this->breadcrumbs=array(
	'App Settings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AppSetting','url'=>array('index')),
	array('label'=>'Create AppSetting','url'=>array('create')),
);
?>

<h1>Manage App Settings</h1>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'app-setting-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'filter'=>false),
		'code',
		'val',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
