<?php
/* @var $this SaleShopController */
/* @var $model SaleShop */

$this->breadcrumbs=array(
	'Sale Shops'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SaleShop', 'url'=>array('index')),
	array('label'=>'Create SaleShop', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sale-shop-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sale Shops</h1>

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
	'id'=>'sale-shop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'pricelist_id',
		/*
		'project_id',
		'name',
		'payment_default_id',
		'company_id',
		'warehouse_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
