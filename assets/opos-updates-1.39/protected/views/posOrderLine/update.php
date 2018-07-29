<?php
/* @var $this PosOrderLineController */
/* @var $model PosOrderLine */

$this->breadcrumbs=array(
	'Pos Order Lines'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PosOrderLine', 'url'=>array('index')),
	array('label'=>'Create PosOrderLine', 'url'=>array('create')),
	array('label'=>'View PosOrderLine', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PosOrderLine', 'url'=>array('admin')),
);
?>

<h1>Update PosOrderLine <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>