<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->breadcrumbs=array(
	'Companies'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Company', 'url'=>array('index')),
	array('label'=>'Create Company', 'url'=>array('create')),
	array('label'=>'Update Company', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Company', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Company', 'url'=>array('admin')),
);
?>

<h1>View Company #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'parent_id',
		'partner_id',
		'currency_id',
		'create_uid',
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
	),
)); ?>
