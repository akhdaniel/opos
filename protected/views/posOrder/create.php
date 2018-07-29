<?php
/* @var $this PosOrderController */
/* @var $model PosOrder */

$this->breadcrumbs=array(
	'Pos Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PosOrder', 'url'=>array('index')),
	array('label'=>'Manage PosOrder', 'url'=>array('admin')),
);
?>

<h1>Create PosOrder</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>