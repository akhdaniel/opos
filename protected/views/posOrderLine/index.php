<?php
/* @var $this PosOrderLineController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pos Order Lines',
);

$this->menu=array(
	array('label'=>'Create PosOrderLine', 'url'=>array('create')),
	array('label'=>'Manage PosOrderLine', 'url'=>array('admin')),
);
?>

<h1>Pos Order Lines</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
