<?php
$this->breadcrumbs=array(
	'Journals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Journal','url'=>array('index')),
	array('label'=>'Create Journal','url'=>array('create')),
);

?>


<h2>Session Name: <?php echo $session->name ?></h2>
<h1>State : <?php echo $session->state ?></h1>
<hr>
<h1>Journals</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'journal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'filter'=>false),
		//array('name'=>'session_id', 'filter'=>false),
		array('name'=>'name', 'filter'=>false),
		array('name'=>'datetime', 'filter'=>false),
		//'account.oe_id',
		array('name'=>'account.code', 'header'=>'Code'),
		array('name'=>'account.name', 'header'=>'COA'),
        array('value'=>'number_format($data->debit,2)', 'header'=>'Debit',
            'footer'=>number_format($model->getTotalFooterDebit($model->search()->getKeys()),2),
        	'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'number_format($data->credit,2)', 'header'=>'Credit',
            'footer'=>number_format($model->getTotalFooterCredit($model->search()->getKeys()) ,2),
        	'htmlOptions'=>array('style'=>'text-align: right')),        
		array('name'=>'reference', 'filter'=>false),
		array('name'=>'state', 'filter'=>false),
		// array(
		// 	'class'=>'bootstrap.widgets.TbButtonColumn',
		// ),
	),
)); ?>

<?php $total_debit = Journal::model()->getTotalDebit($session_id) ?>
<?php $total_credit = Journal::model()->getTotalCredit($session_id) ?>
<?php $balance =$total_debit-$total_credit ?>

<h1 align="right">Total Unposted Debit: <?php echo number_format($total_debit ,2)?> </h1>
<h1 align="right">Total Unposted Credit: <?php echo number_format($total_credit ,2)?> </h1>
<h1 align="right">Balance: <?php echo number_format($balance,2)?> </h1>


<h1>Stock Moves</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'stock-move-grid',
	'dataProvider'=>$modelStockMove->search(),
	'filter'=>$modelStockMove,
	'columns'=>array(
		array('name'=>'id', 'filter'=>false),
		//array('name'=>'session_id', 'filter'=>false),
		'name',
		'datetime',
		'product.name',
		'product.uom',
        array('value'=>'number_format($data->qty,2)', 'header'=>'Qty',
        	'htmlOptions'=>array('style'=>'text-align: right')),
		array('name'=>'source_location_id', 'filter'=>false),
		array('name'=>'dest_location_id', 'filter'=>false),
		'state',
		array('name'=>'is_active', 'value'=>'$data->is_active==1?"True":"False"')
	),
)); ?>


<?php 

	$can_post =  $total_debit==$total_credit && $session->state == SESSION_CLOSED;

	$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Post to OE',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'disabled'=> !$can_post,
    'htmlOptions'=>array(
    	'id'=> $can_post?'confirmJournal':'',	    	
    )
)); ?>


<?php
cs()->registerScript('init',"
$('#confirmJournal').click(function(){
	\$('#modalProgress').modal('show');
	location.href='" . bu('/journal/post?session_id=' . $session->id ) . "';
	return false;
});

"); 
?>

<?php $this->renderPartial('//order/_progress', array() ); ?>
