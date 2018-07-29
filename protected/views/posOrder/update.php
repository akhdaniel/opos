<?php
/* @var $this PosOrderController */
/* @var $model PosOrder */

$this->breadcrumbs=array(
	'Pos Orders'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PosOrder', 'url'=>array('index')),
	array('label'=>'Create PosOrder', 'url'=>array('create')),
	array('label'=>'View PosOrder', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PosOrder', 'url'=>array('admin')),
);
?>

<h1>Update PosOrder <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>