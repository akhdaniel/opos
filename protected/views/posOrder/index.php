<?php
/* @var $this PosOrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pos Orders',
);

$this->menu=array(
	array('label'=>'Create PosOrder', 'url'=>array('create')),
	array('label'=>'Manage PosOrder', 'url'=>array('admin')),
);
?>

<h1>Pos Orders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
