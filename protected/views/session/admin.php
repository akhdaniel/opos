<?php
$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Session','url'=>array('index')),
	array('label'=>'Create Session','url'=>array('create')),
);


?>

<h1>Manage Sessions</h1>

<?php 
$session = Session::model()->findByPk(Yii::app()->session['session_id']);
?>

<?php if (!isset(Yii::app()->session['session_id']) || $session->state == SESSION_CLOSED) : ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'New Session',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/session/create')
    )); ?>
<?php else: ?>

    <?php if($session->state == SESSION_OPEN): ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'New Order',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/order/create')
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close Active Session [' . $session->name  . ']' ,
        'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'htmlOptions'=>array('onclick'=>'return confirm("Close current session?")'),
        //'url'=>bu('/session/close')
        'url'=>bu('/session/closingControl/'. $session->id)
    )); ?>
    <?php endif; ?>

<?php endif; ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Run Automatic Sync',
        'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/session/autopost'),
        'buttonType'=>'link',
        'htmlOptions'=>array(
            'target'=>"_new"
        ),    
    )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'session-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'filter'=>false),
		//'name',
        array('value'=>'CHtml::link( $data->name, Yii::app()->createUrl("/session/view/" . $data->id )) ', 
        	'type'=>'raw',
        	'name'=>'name',
        	'header'=>'Name'),
		'open_date',
		'close_date',
        array('value'=>'($data->state == SESSION_CLOSED || $data->state == SESSION_POSTED)?number_format($data->total_sales,2):"..."', 
            'name'=>'total_sales','header'=>'Total Sales',
        	'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'($data->state == SESSION_CLOSED || $data->state == SESSION_POSTED)?number_format($data->total_drawer,2):"..."', 
            'name'=>'total_drawer','header'=>'Total Cash Drawer',
        	'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'($data->state == SESSION_CLOSED || $data->state == SESSION_POSTED)?number_format($data->totalCash,2):"..."', 
            'name'=>'totalCash','header'=>'Total Cash Sales',
            'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'($data->state == SESSION_CLOSED || $data->state == SESSION_POSTED)?number_format($data->difference,2):"..."', 
            'name'=>'difference','header'=>'Cash Difference',
        	'htmlOptions'=>array('style'=>'text-align: right')),
		'state',
        'user_id',
		/*
		'oe_id',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete} {view}'
		),
	),
)); ?>

