<?php
/* @var $this PosConfigController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pos Configs',
);

$this->menu=array(
	array('label'=>'Create PosConfig', 'url'=>array('create')),
	array('label'=>'Manage PosConfig', 'url'=>array('admin')),
);
?>

<h1>Pos Configs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
