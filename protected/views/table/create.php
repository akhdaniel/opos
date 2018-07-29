<?php
/* @var $this TableController */
/* @var $model Table */

$this->breadcrumbs=array(
	'Tables'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Table', 'url'=>array('index')),
	array('label'=>'Manage Table', 'url'=>array('admin')),
);
?>

<h1>Create Table</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>