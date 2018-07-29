<?php
/* @var $this ProductPricelistController */
/* @var $model ProductPricelist */

$this->breadcrumbs=array(
	'Product Pricelists'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductPricelist', 'url'=>array('index')),
	array('label'=>'Create ProductPricelist', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-pricelist-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Product Pricelists</h1>

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
	'id'=>'product-pricelist-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'currency_id',
		/*
		'name',
		'active',
		'type',
		'company_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
