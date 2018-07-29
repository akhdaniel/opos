<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->breadcrumbs=array(
	'Companies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Company', 'url'=>array('index')),
	array('label'=>'Create Company', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#company-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Companies</h1>

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
	'id'=>'company-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'parent_id',
		'partner_id',
		'currency_id',
		'create_uid',
		/*
		'create_date',
		'write_date',
		'write_uid',
		'rml_footer',
		'rml_header',
		'paper_format',
		'logo_web',
		'rml_header2',
		'rml_header3',
		'rml_header1',
		'account_no',
		'company_registry',
		'custom_footer',
		'expects_chart_of_accounts',
		'paypal_account',
		'overdue_msg',
		'tax_calculation_rounding_method',
		'expense_currency_exchange_account_id',
		'income_currency_exchange_account_id',
		'schedule_range',
		'po_lead',
		'security_lead',
		'manufacturing_lead',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
