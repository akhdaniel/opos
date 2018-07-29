<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
	array('label'=>'Create Order', 'url'=>array('create')),
);

?>

<h1>List Orders</h1>

<?php if(Yii::app()->session['session_id']): ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'New Order',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/order/create')
    )); ?>
<?php endif;?>

<?php if($oe_summary_mode==0):?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Post OpenERP Orders',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>bu('/order/recreateUnpostedOeOrders'),
    'htmlOptions'=>array(
        'onclick'=>"$('#modalProgress').modal('show')"
    ),    
)); ?>
<?php endif;?>



<?php $this->renderPartial('_progress', array() ); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'order-grid',
    'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
         array(
            'value'=>'CHtml::link( $data->table->table_name, Yii::app()->createUrl("/order/view/" . $data->id )) ', 
            'type'=>'raw',
            'name'=>'table_id',
            'visible'=> AppSetting::model()->findOrCreate("pos_mode","retail")->val == "resto"?true:false
        ),
         
        array('value'=>'CHtml::link( $data->number, Yii::app()->createUrl("/order/view/" . $data->id )) ', 
        	'type'=>'raw',
        	'name'=>'number',
        	'header'=>'Number'),
		'notes',
		'order_date',
        array('value'=>'number_format($data->total,2)', 'name'=>'total','header'=>'Total',
        	'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'number_format($data->discount_special,2)', 'name'=>'discount_special','header'=>'Discount Special',
            'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'number_format($data->total_paid,2)', 'name'=>'total','header'=>'Total Paid',
        	'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'number_format($data->total_change,2)', 'name'=>'total','header'=>'Total Change',
        	'htmlOptions'=>array('style'=>'text-align: right')),
		'salesman_id',
		'state',
		'session_id',
		// array(
		// 	'class'=>'CButtonColumn',
		// ),
	),
)); ?>

<?php
cs()->registerScript('ku',"
");
?>

