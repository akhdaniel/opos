<?php
/* @var $this JoinPaymentDetailController */
/* @var $model JoinPaymentDetail */

$this->breadcrumbs=array(
	'Join Payment Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List JoinPaymentDetail', 'url'=>array('index')),
	array('label'=>'Create JoinPaymentDetail', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#join-payment-detail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Join Payment Details</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'join-payment-detail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'join_payment_id',
		'order_id',
		'amount',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
