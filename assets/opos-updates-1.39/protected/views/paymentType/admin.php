<?php
$this->breadcrumbs=array(
	'Payment Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PaymentType','url'=>array('index')),
	array('label'=>'Create PaymentType','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('payment-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Payment Types</h1>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Sync Payment Types',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>bu('/paymentType/sync')
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'payment-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id','filter'=>false),
		'name',
		'type',
		'code',
		'oe_id',
		'oe_debit_account_id',
		'oe_credit_account_id',
		'sorting',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
