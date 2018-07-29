<?php
/* @var $this PosOrderController */
/* @var $model PosOrder */

$this->breadcrumbs=array(
	'Pos Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PosOrder', 'url'=>array('index')),
	array('label'=>'Create PosOrder', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pos-order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pos Orders</h1>

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
	'id'=>'pos-order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'sale_journal',
		/*
		'pos_reference',
		'account_move',
		'date_order',
		'partner_id',
		'nb_print',
		'note',
		'user_id',
		'invoice_id',
		'company_id',
		'session_id',
		'name',
		'state',
		'shop_id',
		'pricelist_id',
		'picking_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
