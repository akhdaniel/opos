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
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'notifModal')); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Order Ready</h4>
        </div>
         
        <div class="modal-body">
            
        </div>
         
        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'success',
                'label'=> 'Ok',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>            
        </div>
    <?php $this->endWidget(); ?>

<?php if(Yii::app()->session['session_id']): ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'New Order',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/restoOrder/create')
    )); ?>
<?php endif;?>

<?php if(Yii::app()->session['session_id']): ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Join Table',
        'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/restoOrder/joinTable')
    )); ?>
<?php endif;?>

<?php if(Yii::app()->session['session_id']): ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Split Table',
        'type'=>'warning', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/restoOrder/splitTable')
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
	'dataProvider'=>$model->searchWaiter(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'value'=>'CHtml::link( $data->table->table_name, Yii::app()->createUrl("/restoOrder/view/" . $data->id )) ', 
            'type'=>'raw',
            'name'=>'table_id',
        ),

        array(
            'value'=>'CHtml::link( $data->number, Yii::app()->createUrl("/restoOrder/view/" . $data->id )) ', 
            'type'=>'raw',
            'name'=>'number',
        ),
		'notes',
		'order_date',

       /* array('value'=>'number_format($data->total,2)', 'name'=>'total','header'=>'Total',
        	'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'number_format($data->total_paid,2)', 'name'=>'total','header'=>'Total Paid',
        	'htmlOptions'=>array('style'=>'text-align: right')),
        array('value'=>'number_format($data->total_change,2)', 'name'=>'total','header'=>'Total Change',
        	'htmlOptions'=>array('style'=>'text-align: right')),
		'salesman_id',*/
		'state',
		'session_id',
		// array(
		// 	'class'=>'CButtonColumn',
		// ),
	),
)); ?>

<?php
cs()->registerScript('ku',"
    var check = true;
    $('#notifModal').on('shown.bs.modal', function(){
       check = false;
    });
    
    $('#notifModal').on('hidden.bs.modal', function(){
       check = true;
    });

    function notif(){
        if(check){
            var url = '".bu('/notification/checkReady')."';
            $.ajax({
                type: 'POST',
                url: url,
                success: function(data){
                    if(data.count > 0){
                        var table_notif = '<table class=table table-hover table-bordered table-striped><tr><th>Table No</th><th>Product Name</th><th>Qty</th></tr>';
                        $.each(data.data, function (table,isi) {
                            for(var i=0; i<=isi.product.length-1; i++){
                                if(i==0){
                                    table_notif += '<tr><td><b><a href=".bu('/restoOrder/view/')."'+isi.order_id+'>'+table+'</a></b></td><td>'+isi.product[i][0]+'</td><td>'+isi.product[i][1]+'</td></tr>';
                                }else{
                                    table_notif += '<tr><td>&nbsp;</td><td>'+isi.product[i][0]+'</td><td>'+isi.product[i][1]+'</td></tr>';
                                }   
                            }
                        });
                        table_notif += '</table>';
                        $('.modal-body').html(table_notif);
                        $('#notifModal').modal('show');
                    }
                },
                dataType: 'json'
            });
        }        
        
       setTimeout(notif, 20000);
    }

    notif();

");
?>

