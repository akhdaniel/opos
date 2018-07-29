<?php
/* @var $this PosSessionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pos Sessions',
);

$this->menu=array(
	array('label'=>'Create PosSession', 'url'=>array('create')),
	array('label'=>'Manage PosSession', 'url'=>array('admin')),
);
?>

<h1>Pos Sessions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
