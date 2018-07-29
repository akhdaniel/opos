<?php
/* @var $this PosConfigController */
/* @var $model PosConfig */

$this->breadcrumbs=array(
	'Pos Configs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PosConfig', 'url'=>array('index')),
	array('label'=>'Manage PosConfig', 'url'=>array('admin')),
);
?>

<h1>Create PosConfig</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>