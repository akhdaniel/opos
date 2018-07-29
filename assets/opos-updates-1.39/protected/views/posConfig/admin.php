<?php
/* @var $this PosConfigController */
/* @var $model PosConfig */

$this->breadcrumbs=array(
	'Pos Configs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PosConfig', 'url'=>array('index')),
	array('label'=>'Create PosConfig', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pos-config-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pos Configs</h1>

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
	'id'=>'pos-config-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'iface_vkeyboard',
		/*
		'iface_cashdrawer',
		'name',
		'state',
		'journal_id',
		'iface_self_checkout',
		'iface_electronic_scale',
		'shop_id',
		'group_by',
		'iface_payment_terminal',
		'sequence_id',
		'iface_print_via_proxy',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
