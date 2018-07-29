<?php
$this->breadcrumbs=array(
	'App Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AppSetting','url'=>array('index')),
	array('label'=>'Manage AppSetting','url'=>array('admin')),
);
?>

<h1>Create AppSetting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>