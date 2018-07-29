<?php
/* @var $this CustomerTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Customer Types',
);

$this->menu=array(
	array('label'=>'Create CustomerType', 'url'=>array('create')),
	array('label'=>'Manage CustomerType', 'url'=>array('admin')),
);
?>

<h1>Customer Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
