<?php
/* @var $this PosOrderController */
/* @var $model PosOrder */

$this->breadcrumbs=array(
	'Pos Orders'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PosOrder', 'url'=>array('index')),
	array('label'=>'Create PosOrder', 'url'=>array('create')),
	array('label'=>'Update PosOrder', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PosOrder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PosOrder', 'url'=>array('admin')),
);
?>

<h1>View PosOrder #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'sale_journal',
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
	),
)); ?>
