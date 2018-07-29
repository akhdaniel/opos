<?php
$this->breadcrumbs=array(
	'Payment Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PaymentType','url'=>array('index')),
	array('label'=>'Create PaymentType','url'=>array('create')),
	array('label'=>'Update PaymentType','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete PaymentType','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PaymentType','url'=>array('admin')),
);
?>

<h1>View PaymentType #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
		'oe_id',
		'code',
		'oe_debit_account_id',
		'oe_credit_account_id',
		'sorting',
	),
)); ?>
