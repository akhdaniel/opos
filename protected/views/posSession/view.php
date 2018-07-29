<?php
/* @var $this PosSessionController */
/* @var $model PosSession */

$this->breadcrumbs=array(
	'Pos Sessions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PosSession', 'url'=>array('index')),
	array('label'=>'Create PosSession', 'url'=>array('create')),
	array('label'=>'Update PosSession', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PosSession', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PosSession', 'url'=>array('admin')),
);
?>

<h1>View PosSession #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_uid',
		'create_date',
		'write_date',
		'write_uid',
		'config_id',
		'cash_journal_id',
		'start_at',
		'cash_register_id',
		'user_id',
		'name',
		'stop_at',
		'state',
	),
)); ?>
<p>
<h1>List Orders</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pos-order-grid',
	'dataProvider'=>$modelPosOrder->search(),
	'filter'=>$modelPosOrder,
	'columns'=>array(
		//'id',
		//'create_uid',
		//'create_date',
		//'write_date',
		//'write_uid',
		'sale_journal',
		'pos_reference',
		//'account_move',
		'date_order',
		//'partner_id',
		//'nb_print',
		//'note',
		//'user_id',
		//'invoice_id',
		//'company_id',
		//'session_id',
		'name',
		//'state',
		//'shop_id',
		//'pricelist_id',
		//'picking_id',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<button name="add" onclick="javascript:location.href='<?php echo bu("posOrder/create?posSessionId=" . $model->id)?>'">New Order</button>