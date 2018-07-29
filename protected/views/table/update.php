<?php
/* @var $this TableController */
/* @var $model Table */

$this->breadcrumbs=array(
	'Tables'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Table', 'url'=>array('index')),
	array('label'=>'Create Table', 'url'=>array('create')),
	array('label'=>'View Table', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Table', 'url'=>array('admin')),
);
?>

<h1>Update Table <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>