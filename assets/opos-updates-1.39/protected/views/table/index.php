<?php
/* @var $this TableController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tables',
);

$this->menu=array(
	array('label'=>'Create Table', 'url'=>array('create')),
	array('label'=>'Manage Table', 'url'=>array('admin')),
);
?>

<h1>Tables</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
