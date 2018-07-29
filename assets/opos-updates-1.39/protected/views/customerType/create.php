<?php
/* @var $this CustomerTypeController */
/* @var $model CustomerType */

$this->breadcrumbs=array(
	'Customer Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerType', 'url'=>array('index')),
	array('label'=>'Manage CustomerType', 'url'=>array('admin')),
);
?>

<h1>Create CustomerType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>