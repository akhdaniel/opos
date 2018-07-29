<?php
/* @var $this TableController */
/* @var $model Table */

$this->breadcrumbs=array(
	'Tables'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Table', 'url'=>array('index')),
	array('label'=>'Create Table', 'url'=>array('create')),
	array('label'=>'Update Table', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Table', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Table', 'url'=>array('admin')),
);
?>

<h1>View Table #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'table_name',
		'status',
	),
)); ?>
