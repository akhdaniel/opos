<?php
/* @var $this PosConfigController */
/* @var $model PosConfig */

$this->breadcrumbs=array(
	'Pos Configs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PosConfig', 'url'=>array('index')),
	array('label'=>'Create PosConfig', 'url'=>array('create')),
	array('label'=>'View PosConfig', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PosConfig', 'url'=>array('admin')),
);
?>

<h1>Update PosConfig <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>