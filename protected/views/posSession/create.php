<?php
/* @var $this PosSessionController */
/* @var $model PosSession */

$this->breadcrumbs=array(
	'Pos Sessions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PosSession', 'url'=>array('index')),
	array('label'=>'Manage PosSession', 'url'=>array('admin')),
);
?>

<h1>Create PosSession</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>