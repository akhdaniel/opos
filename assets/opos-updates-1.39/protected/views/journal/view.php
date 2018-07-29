<?php
$this->breadcrumbs=array(
	'Journals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Journal','url'=>array('index')),
	array('label'=>'Create Journal','url'=>array('create')),
	array('label'=>'Update Journal','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Journal','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Journal','url'=>array('admin')),
);
?>

<h1>View Journal #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'datetime',
		'account_id',
		'debit',
		'credit',
		'reference',
	),
)); ?>
