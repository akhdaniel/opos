<?php
/* @var $this PosOrderLineController */
/* @var $model PosOrderLine */

$this->breadcrumbs=array(
	'Pos Order Lines'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PosOrderLine', 'url'=>array('index')),
	array('label'=>'Manage PosOrderLine', 'url'=>array('admin')),
);
?>

<h1>Create PosOrderLine</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>