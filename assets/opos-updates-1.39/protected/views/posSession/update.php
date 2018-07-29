<?php
/* @var $this PosSessionController */
/* @var $model PosSession */

$this->breadcrumbs=array(
	'Pos Sessions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PosSession', 'url'=>array('index')),
	array('label'=>'Create PosSession', 'url'=>array('create')),
	array('label'=>'View PosSession', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PosSession', 'url'=>array('admin')),
);
?>

<h1>Update PosSession <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>