<?php
/* @var $this CustomerTypeController */
/* @var $model CustomerType */

$this->breadcrumbs=array(
	'Customer Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerType', 'url'=>array('index')),
	array('label'=>'Create CustomerType', 'url'=>array('create')),
	array('label'=>'View CustomerType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustomerType', 'url'=>array('admin')),
);
?>

<h1>Update CustomerType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>