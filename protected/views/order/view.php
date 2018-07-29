<?php
/* @var $this OrderController */
/* @var $model Order */
?>

<h1>View Order #<?php echo $model->id; ?></h1>
<table class="table">
    <tr>
        <th>Number</th><td><?php echo $model->number?></td>
        <th>Order Date</th><td><?php echo $model->order_date?></td>
        <th>Salesman</th><td><?php echo $model->salesman_id?> [<?php echo Yii::app()->user->name?>]</td>
    </tr>
    <tr>
        <th>State</th><td><?php echo $model->state?></td>
        <th>Session</th><td><?php echo $model->session_id?></td>
        <th>No Struk</th><td><?php echo $model->notes?></td>
    </tr>

    <tr>
        <?php if($model->state == ORDER_NEW OR $model->state == ORDER_CONFIRM){ ?>
        <th>Customer Type</th><td><?php echo $model->customer->name;?> <a class="label label-success" onclick="$('#confirmPassword').modal('show');">Change type</a></td>
        <?php }else{?>
        <th>Customer Type</th><td><?php echo $model->customer->name;?></td>
        <?php } ?>
        
        <?php if(AppSetting::model()->findOrCreate("pos_mode","retail")->val == "retail"){?>
        <th>&nbsp;</th><td>&nbsp;</td>
        <?php }else{?>
        <th>No Meja</th><td><?php echo $model->table->table_name;?></td>
        <?php } ?>
        <th>Order Notes</th><td><?php echo $model->order_notes?></td>
    </tr>
</table>

<h1>Order Detail</h1>
<?php if($model->state == ORDER_NEW OR $model->state == ORDER_CONFIRM) : ?>
    <div>

        <?php if(stristr($model->notes, 'return')===false): ?>
        <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'product',
            'id'=>"barcode",
            'source'=>'js: function( request, response ) {
                    $.getJSON( "' . bu('/product/autocomplete') . '", {
                        term: request.term,
                    }, response );
            }',
            'options'=>array(
                'max'=>10,
                'minChars'=>2, 
                'delay'=>300,
                'matchCase'=>true,
                'minLength'=>'4',
                'search'=>"js: function(event, ui) {
                    //$('#barcode').val('');
                }",             
                'select'=>"js: function(event, ui) {
                    $('#barcode').val(ui.item.id);
                }"
            ),
            'htmlOptions'=>array(
                'style' => 'width:99%;height:60px;font-size:20pt',
                'placeholder'=>'scan or search product here...',
                'onKeyPress'=>"return cekBarcode(this, event);" 
            )
            ));
        ?>
        <?php endif; ?>


        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'[F1] Payment',
            'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'large', // null, 'large', 'small' or 'mini'
            'htmlOptions'=>array(
                'id'=>'paymentButton',
                //'data-toggle'=>'modal',
                //'data-target'=>'#paymentModal',
            ),        
        )); ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'[F2] Split Items',
            'type'=>'warning', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'large', // null, 'large', 'small' or 'mini'
            'url'=>bu('/order/splitPayment/'.$model->id),
        )); ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Join Payment',
            'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'large', // null, 'large', 'small' or 'mini'
            'url'=>bu('/order/createJoinPayment'),
        )); ?>

        <?php if($model->state == ORDER_CONFIRM ) : ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'[F5] Print Bill',
                'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'large', // null, 'large', 'small' or 'mini'
                'htmlOptions'=>array(
                    'id'=>'print-bill'
                ),
            )); ?>
        <?php endif; ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'[F7] Edit Qty/Price',
            'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'large', // null, 'large', 'small' or 'mini'
            'htmlOptions'=>array(
                'id'=>'editDetailButton',
                // 'data-toggle'=>'modal',
                // 'data-target'=>'#editDetail',
            ),        
        )); ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'[F9] Cancel Order',
            'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'large', // null, 'large', 'small' or 'mini'
            'htmlOptions'=>array(
                'id'=>'cancelOrderButton',
                'data-toggle'=>'modal',
                'data-target'=>'#cancelOrder',
            ),        
        )); ?>

        <!-- modal confirm change customer -->
        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'confirmPassword')); ?>
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Enter admin password</h4>
            </div>
             
            <div class="modal-body">
                <p>
                    Please enter admin password to continue
                <p>
                    <input type="password" name="confirm_pwd" id="confirm_pwd" />
                </p>

                <p id="passwordError" style="color: red; display:none;">Wrong admin password. please try again</p>
            </div>
             
            <div class="modal-footer">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'primary',
                    'label'=>'Ok',
                    'buttonType'=>'button',
                    'htmlOptions'=>array(
                        'id'=>'confirmButton',
                    ),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'danger',
                    'label'=>'Cancel',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); ?>            
            </div>
        <?php $this->endWidget(); ?>

        <!-- change customer type list -->
        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'customerTypeModal')); ?>
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Select Customer Type</h4>
            </div>
             
            <div class="modal-body">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'customer-type-form',
                    'enableAjaxValidation'=>false,
                    'action' => Yii::app()->createUrl('order/changeCustomer'),
                )); ?>
                    <?php echo $form->hiddenField($model, 'id');?>
                    <?php echo $form->labelEx($model,'customer_type'); ?>
                    <?php echo $form->dropDownlist($model,'customer_type', 
                        (CHtml::listData(CustomerType::model()->findAll(),'id','name')),
                            array('prompt'=>'-- Choose customer type --')
                        );
                    ?>
                
                <?php $this->endWidget(); ?>
            </div>
             
            <div class="modal-footer">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'primary',
                    'label'=>'Change',
                    'buttonType'=>'button',
                    'htmlOptions'=>array(
                        'id'=>'confirmCustomer',
                    ),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'danger',
                    'label'=>'Cancel',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); ?>            
            </div>
        <?php $this->endWidget(); ?>

        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'cancelOrder')); ?>
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Confirmation</h4>
            </div>
             
            <div class="modal-body">
                <p> Are you sure to cancel the current Order? </p>         
            </div>
             
            <div class="modal-footer">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'primary',
                    'label'=>'Yes',
                    'url'=>$this->createUrl("/order/delete", array("id"=>$model->id )),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'No',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); ?>            
            </div>
        <?php $this->endWidget(); ?>


        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'editDetail')); ?>
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Edit: <span id="order_detail_product_name"></span></h4>
            </div>
             
            <form>
                <div class="modal-body">
                    <input type="hidden" name="order_detail_id" id="order_detail_id"/>    
                    <table width="100%">
                        <tr><td>Qty</td><td><input type="text" name="qty" id="qty"/> </td></tr>
                        <tr><td>Unit Price</td><td><input type="text" readonly="true" name="unit_price" id="unit_price" /></td></tr>
                    </table>
                </div>
                 
                <div class="modal-footer">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'type'=>'primary',
                        'label'=>'Yes',
                        'url'=>'#',
                        'htmlOptions'=>array(
                            'id'=>'confirmUpdateDetail',
                            'onclick'=>"js:updateOrderDetails();",
                        ),
                    )); ?>
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label'=>'No',
                        'url'=>'#',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                    )); ?>            
                </div>
            </form>
        <?php $this->endWidget(); ?>

    </div>
<?php endif; // unpaid ?>



<?php if($model->state != ORDER_NEW && $model->state != ORDER_CONFIRM) : ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'[F2] New Order',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/order/create'),
        'htmlOptions'=>array(
            'id'=>'newOrderButton',
        ),
    )); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'[F3] Re-Print Recipt',
        'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/order/printReceipt/'.$model->id.'?reprint=true'),
        'htmlOptions'=>array(
            'id'=>'reprintOrderButton'
        ),
    )); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'[F4] Return Product',
        'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'buttonType'=>'button',
        'htmlOptions'=>array(
            'data-toggle'=>'modal',
            'data-target'=>'#returnOrder',
        ),  
    )); ?>

    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'returnOrder')); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Return Confirmation</h4>
        </div>
         
        <div class="modal-body">
            <p> Are you sure to return the current Order ?  
                Please enter admin password to continue
            <p>
                <input type="password" name="admin_pwd" id="admin_pwd" />
            </p>
        </div>
         
        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'primary',
                'label'=>'Yes',
                'buttonType'=>'button',
                'htmlOptions'=>array(
                    'id'=>'returnOrderButton',
                ),
            )); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'No',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>            
        </div>
    <?php $this->endWidget(); ?>

<?php endif; ?>

<?php if ($oe_summary_mode==0): ?>
<?php if($model->oe_id == 0 && $model->state != ORDER_NEW) : ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Post OpenERP Order',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/order/recreateOeOrder/'.$model->id ),
        'htmlOptions'=>array(
            'onclick'=>"$('#modalProgress').modal('show')"
        ),  
    )); ?>
<?php endif; ?>
<?php endif; ?>



<?php if(Yii::app()->user->id == 1 && $model->state != ORDER_POSTED  && $model->state != ORDER_NEW && $model->state !=ORDER_CONFIRM) : ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'[F9] Cancel Order',
        'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>$this->createUrl("/order/delete", array("id"=>$model->id )),
        'htmlOptions'=>array(
            'onclick'=>'return confirm("Cancel this order?")'
        ),        
    )); ?>
<?php endif; ?>

<?php $this->renderPartial('_progress', array() ); ?>

<?php 
$columns=array(
    array('value'=>'$data->product->default_code', 'header'=>'Item Code' ),
    //array(
        //'name'=>'Name',
        // 'type'=>'raw',
        // 'value' => 'CHtml::link($data->product->name,
        //     Yii::app()->createUrl("/product/view",
        //         array("id"=>$data->product->id)),array("target"=>"_blank"))',
    //),
    'product.name',
    //array('value'=>'$data->product->name', 'header'=>'Item Name' ),
    array('value'=>'number_format($data->qty,3)', /*'name'=>'qty',*/ 'header'=>'Qty','htmlOptions'=>array('style'=>'text-align: right')),
    array('value'=>'number_format($data->list_price,2)', /*'name'=>'list_price',*/'header'=>'List Price','htmlOptions'=>array('style'=>'text-align: right')),
    array('value'=>'number_format($data->list_price - $data->unit_price,2)', 'header'=>'Discount','htmlOptions'=>array('style'=>'text-align: right')),
    array('value'=>'number_format($data->unit_price,2)', /*'name'=>'unit_price',*/ 'header'=>'Unit Price','htmlOptions'=>array('style'=>'text-align: right')),
    array('value'=>'number_format($data->amount,2)', /*'name'=>'amount',*/ 'header'=>'Amount','htmlOptions'=>array('style'=>'text-align: right')),
);





if($model->state == ORDER_NEW || $model->state == ORDER_CONFIRM){
    $columns[] = array(
        'class'=>'CButtonColumn',
        'template'=>'{update} {delete}',   
        'htmlOptions'=>array('width'=>'70px'),
        'buttons'=>array(
            'update' => array(
                'url'=>'$data->primaryKey',
                'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
                'click'=>'js:function(){ 
                    $("#qty").val($(this).parent().parent().children(":nth-child(3)").text());
                    $("#unit_price").val($(this).parent().parent().children(":nth-child(4)").text());
                    $("#order_detail_id").val($(this).attr("href"));
                    $("#order_detail_product_name").text($(this).parent().parent().children(":nth-child(2)").text() );
                    $("#qty").focus();
                    $("#editDetail").modal();
                    return false; }',
                'visible'=>'$data->unit_price==0?false:true',

            ),
            'delete' => array(
                'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                'url'=>'$data->primaryKey',
                'click'=>'js:function(){
                    if (confirm("Are you sure to delete this?")){
                        $.ajax({
                            type: "POST",
                            url: "'.Yii::app()->controller->createUrl("/orderDetail/delete", array('ajax'=>true)).'&id="+$(this).attr("href"),
                            success: function(){
                                $("#order-detail-grid").yiiGridView.update("order-detail-grid");
                                updateTotals();
                            }
                        });                    
                    }
                    return false;
                }', 
                'visible'=>'$data->unit_price==0?false:true',
      
            ),
        ), 
    );
}
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'order-detail-grid',
    'type'=>'striped bordered hover',
	'dataProvider'=>$modelOrderDetail->search(),
	'columns'=>$columns,
)); ?>
<?php
/*    var_dump($model);die;*/
?>
<table style="width:100%" class="table condensed">
    <tr>
        <td style="width:90%" ><div align="right">Sub Total:</div></td>
        <td><input style="text-align:right" type="text" 
            id="totalListPrice"
            size=13 readonly=true 
            value="<?php echo number_format($model->totalListPrice,2)?>"> </td>
    </tr>

    <?php if($model->customer->name == "reguler"){?>
    <tr>
        <td style="width:90%" ><div align="right">Discount:</div></td>
        <td><input style="text-align:right" type="text" 
            id="totalDiscount"
            size=13 readonly=true 
            value="<?php echo number_format($model->totalDiscount,2)?>"> </td>
    </tr>
    <?php }?>

    <?php if($model->state == ORDER_PAID || $model->state == ORDER_POSTED || $model->state == ORDER_CANCEL || $model->customer->name != "reguler" || $model->discount_special > 0){?>
    <tr>
        <td style="width:90%" ><div align="right">Discount Special:</div></td>
        <td><input style="text-align:right" type="text" 
            id="discountSpcl"
            size=13 readonly=true 
            value="<?php echo number_format($model->discount_special,2)?>"> </td>
    </tr>
    <?php }?>

    <?php if(($model->state == ORDER_NEW || $model->state == ORDER_CONFIRM) && $model->customer->name == "reguler" && $discount_enable==1){?>
    <tr>
        <td style="width:90%" ><div align="right">Discount Special:</div></td>
        <td><input style="text-align:right" type="text" 
            id="discountSpcl"
            size=13
            value="<?php echo number_format($model->discount_special,2)?>"> </td>
    </tr>
    <?php }?>

    <tr>
        <td style="width:90%" ><div align="right">Total:</div></td>
        <td><input style="text-align:right; font-size:30px; height:50px" type="text" 
            id="total"
            size=20
            readonly=true 
            value="<?php echo number_format($model->total-$model->discount_special,2)?>"> </td>
    </tr>


    <tr>
        <td style="width:90%" ><div align="right">Paid:</div></td>
        <td><input style="text-align:right" type="text" 
            size=13 readonly=true 
            value="<?php echo number_format($model->total_paid,2)?>"> </td>
    </tr>
    <tr>
        <td style="width:90%" ><div align="right">Change:</div></td>
        <td><input style="text-align:right" type="text" 
            size=13 readonly=true 
            value="<?php echo number_format($model->total_change,2)?>"> </td>
    </tr>

</table>






<h1>Order Payment</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'order-payment-grid',
    'type'=>'striped bordered hover',
    'dataProvider'=>$modelOrderPayment->search(),
    'columns'=>array(
        array('value'=>'$data->paymentType->name', 'header'=>'Payment Type' ),
        array('value'=>'$data->card_no', 'header'=>'Card No' ),
        array('value'=>'number_format($data->amount,2)', 'name'=>'amount','header'=>'Amount','htmlOptions'=>array('style'=>'text-align: right')),
    ),
)); ?>
<table style="width:100%" class="table condensed">
    <tr>
        <td style="width:90%" ><div align="right">Paid:</div></td>
        <td><input style="text-align:right" type="text" 
            size=13 readonly=true 
            value="<?php echo number_format($model->total_paid,2)?>"> </td>
    </tr>
</table>



<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'paymentModal')); ?>
    <form action="<?php echo $this->createUrl('/orderPayment/validate')?>" method="POST" id="paymentForm">
        <input type='hidden' name='order_id' value="<?php echo $model->id ?>" />
        <input type='hidden' name='discount_special' id="discount_special" value="<?php echo $model->discount_special ?>" />
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Total Due : <span id="total_due2"><?php echo number_format($model->total-$model->discount_special,2) ?></span></h4>
        </div>
         
        <div class="modal-body" style="height:200px">
            <table class="table table-striped table-condensed">
                <?php foreach($modelPaymentType as $i => $payment): ?>
                    <tr>
                        <td>
                            <?php echo $payment['name'] ?>
                        </td>

                        <td>
                            <input type="text" style="text-align:right;width:120px" 
                            class="amount_paid"
                            data-index="<?php echo $i*2?>"
                            id="amount_paids<?php echo $payment->id ?>" 
                            name="amount_paids[<?php echo $payment->id ?>]" />
                        </td>

                        <td>
                            <input type="text" style = "" 
                            data-index="<?php echo ($i*2 +1)?>"
                            class="card_no"
                            id="card_nos<?php echo $payment->id ?>" 
                            name="card_nos[<?php echo $payment->id ?>]" />
                        </td>

                    </tr>
                <?php endforeach; ?>
            </table>            
        </div>
         
        <div class="modal-footer">
            <table style="width:100%" class="table striped">
                <tr>
                    <td style="width:90%" ><div align="right">Due Total:</div></td>
                    <td><input style = "text-align:right; font-size:20pt" type="textField" 
                        id="total_due"
                        size="13" readonly="true" 
                        value="<?php echo number_format($model->total-$model->discount_special,2)?>"> </td>
                </tr>
                <tr>
                    <td style="width:90%" ><div align="right">Paid Total :</div></td>
                    <td><input style = "text-align:right; font-size:20pt" type="textField" 
                        id="total_paid"
                        size=13 readonly=true 
                        value="<?php echo number_format($model->total_paid,2)?>"> </td>
                </tr>
                <tr>
                    <td style="width:90%" ><div align="right">Split :</div></td>
                    <td><input style = "text-align:right; font-size:20pt" type="textField" 
                        id="split_num" name="split_num"
                        size=13 
                        value="1"> </td>
                </tr>
                <tr>
                    <input type="hidden" name="split_due" id="split_due">
                    <td style="width:90%" ><div align="right">Due Split :</div></td>
                    <td><input style = "text-align:right; font-size:20pt" type="textField" 
                        id="split_due_text" readonly=true
                        size=13 
                        value="<?php echo number_format($model->total-$model->discount_special,2)?>"> </td>
                </tr>
                <tr>
                    <td style="width:90%" ><div align="right">Change :</div></td>
                    <td><input style = "text-align:right; font-size:20pt" type="textField" 
                        id="total_change"
                        size=13 readonly=true 
                        value="<?php echo number_format($model->total_change,2)?>"> </td>
                </tr>
            </table>

            <button type="button" class="btn btn-primary btn-lg" 
                id="nextOrder"
                data-index="<?php echo sizeof($modelPaymentType)*2 ?>"
                disabled="true" >Next Order</button>

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Close',
                'url'=>'#',
                'htmlOptions'=>array(
                    'data-dismiss'=>'modal', 
                    'id'=>'closePayment'),
            )); ?>
        </div>
    </form>
<?php $this->endWidget(); ?>


<script>

/***************************************************************
* focus field barcode 
***************************************************************/
$('#barcode').focus();

/***************************************************************
* field amount_paid dan card_nos di modal payment
* kalau dienter , focus ke next field 
* kalau blur, update total payment dan changes
***************************************************************/
$('.amount_paid').autoNumeric('init', {vMin:-99999999});
$('.amount_paid').keyup(function(event){
    if(event.keyCode == 13){
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('data-index'));
        $('[data-index="' + (index + 1).toString() + '"]').focus();

        return false;
    }
});
$('.amount_paid').blur(function(event){
    calculatePayments();
});
$('.card_no').keyup(function(event){
    if(event.keyCode == 13){
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('data-index'));
        $('[data-index="' + (index + 1).toString() + '"]').focus();

        return false;
    }
});

/***************************************************************
* tombol next order . klik to submit form
***************************************************************/
$('#nextOrder').click(function(){
    var max_total_change = 500000;
    var total_change= numeral().unformat( $('#total_change').val() );

    if( total_change > max_total_change ){
        alert('Total change is bigger than ' + numeral( max_total_change ).format('0,0.00')  + '. Please check the Cash Amount !');
    }
    else{
        $('#nextOrder').attr('disabled',true);
        $('#closePayment').attr('disabled',true);
        $('#paymentForm').submit();        
    }
});

/***************************************************************
* initialisasi auto numeric 
***************************************************************/
$('#unit_price').autoNumeric('init');
$('#qty').autoNumeric('init', {vMin:-100, mDec: '3'});

/***************************************************************
* form EditDetail, field qty dienter masuk ke unit-price
* unit_price dienter, masuk ke confirmUpdateDetail button
***************************************************************/
$('#qty').keyup(function(event){
    if(event.keyCode == 13){
        event.preventDefault();
        $('#unit_price').focus();
    }
});
$('#unit_price').keyup(function(event){
    if(event.keyCode == 13){
        event.preventDefault();
        $('#confirmUpdateDetail').focus();
    }
});

/***************************************************************
* hitung total payment
***************************************************************/
function calculatePayments(){
    var total_paid = 0;
    var total_due = numeral().unformat($('#total_due').val());

    $('.amount_paid').each(function(i,obj){
        if (obj.value){
            var x = numeral().unformat(obj.value);
            total_paid += x;
        }
    });    
    
    var total_change = total_paid-total_due;

    $('#total_paid').val(   numeral( total_paid ).format('0,0.00') );
    $('#total_change').val( numeral( total_change ).format('0,0.00') );

    $(this).next('[type="text"]').focus();

    if (total_change >= 0) {
        $('#nextOrder').attr('disabled', false);
        $('#total_change').css('color', 'green');
    }
    else{
        $('#nextOrder').attr('disabled', true);            
        $('#total_change').css('color', 'red');
    }    
}

/***************************************************************
* check barcode waktu enter field barcode
***************************************************************/
function cekBarcode(myfield,e) 
{
    var keycode;
    if (window.event) keycode = window.event.keyCode;
    else if (e) keycode = e.which;
    else return true;

    if (keycode == 13)
    {
        var code = myfield.value;
        console.log(code);
        if(code==''){
            return false;
        }

        //if(code.length < 2 && parseInt(code) ){
        if( parseInt(code) <= 10){
            findFirstOrderDetail();
            $('#qty').val( code );
            updateOrderDetails();
        }
        else
        {
            $.ajax({
              type: "GET",
              url: "<?php echo serverName().bu('/product/findbycode?code=')?>" + encodeURIComponent(code),
              success: function(data){ 
                if(data.success){
                    var product = data.product;   
                    insertOrderDetail(product);
                    $('#barcode').val('');
                    $('#barcode').focus();

                }
                else{
                    alert(data.message);
                    $('#barcode').val('');
                    $('#barcode').focus();
                }
              },
              error : function(data){
                alert(data.statusText);
              },
              dataType: 'json'
            });            
        }

        return false;
    }
    else
        return true;
}

/***************************************************************
* ajax untuk insert order detail baru
***************************************************************/
function insertOrderDetail(product){
    var row = {
        order_id : <?php echo $model->id?>,
        product_id : product.id,
        qty: 1,
        list_price :product.list_price,
        unit_price :product.discount_price,
        amount :product.list_price,
    };

   $.ajax({
      type: "POST",
      url: "<?php echo serverName().bu('/orderDetail/jcreate') ?>",
      data: row,
      success: function(data){ 
            if(!data.success)
            {
                alert(data.message);
            }
            else
            {
                //isikan modal utk edit qty
                // $('#order_detail_id').val(data.orderDetail.id);
                // $('#qty').val(data.orderDetail.qty);
                // $('#unit_price').val(data.orderDetail.unit_price);

                //reload grid , update total
                $.fn.yiiGridView.update("order-detail-grid");
                updateTotals();
            }
      },
      error: function(data){
        alert(data.statusText);
      },
      dataType: 'json'
    });   
}

/***************************************************************
* ajax untuk update OrderDetail
***************************************************************/
function updateOrderDetails(  ){
    var row = {
        id : $('#order_detail_id').val(),
        qty: numeral().unformat( $('#qty').val() ),
        unit_price : numeral().unformat( $('#unit_price').val() ),
    };

   $.ajax({
      type: "POST",
      url: "<?php echo serverName().bu('/orderDetail/jupdate') ?>",
      data: row,
      success: function(data){ 
            if(!data.success)
            {
                alert(data.message);
            }
            else
            {
                $.fn.yiiGridView.update("order-detail-grid");
                updateTotals();
                $("#editDetail").modal('hide');
                $('#barcode').val('');
            }
      },
      error: function(data){
        alert(data.statusText);
      },
      dataType: 'json'
    });  
}

/***************************************************************
* update total , total paid, change 
***************************************************************/
function updateTotals(){
   $.ajax({
      type: "POST",
      url: "<?php echo serverName().bu('/order/jview?id=' . $model->id ) ?>",
      success: function(data){ 
            if(!data.success)
            {
                alert('error order/jview');
            }
            else
            {
                //var total = numeral( parseFloat(data.total) ).format('0,0.00');
                totalHistory = data.total;
                $('#total').val( total );
                $('#total_due').val(total);
                $('#total_due2').text(total);
                $('#split_due_text').val(total);

                /*totalHistory = data.total;
                discspcl = numeral().unformat($('#discountSpcl').val());
                var total = data.total - discspcl;
                total = numeral( parseFloat(total) ).format('0,0.00');

                $('#total').val( total );
                $('#total_due').val(total);
                $('#total_due2').text(total);
                $('#split_due_text').val(total);
                $('#discount_special').val(discspcl);*/

                var totalListPrice = numeral( parseFloat(data.totalListPrice) ).format('0,0.00');
                $('#totalListPrice').val( totalListPrice );

                var totalDiscount = numeral( parseFloat(data.totalDiscount) ).format('0,0.00');
                $('#totalDiscount').val( totalDiscount );

                updateDiscount();
            }
      },
      error: function(data){
        alert(data.statusText);
      },
      dataType: 'json'
    });  

   $('#barcode').focus();
}

/***************************************************************
* reset/siapkan field-field payment modal
***************************************************************/
function prepareModal()
{
    $('.amount_paid').each(function(i,obj){
        obj.value='';
    }); 
    $('#total_paid').val('0.00');
    $('#total_change').val('0.00');
    $('#total_change').css('color','red');
}

$('#paymentButton').click(function(){
    if($('#total').val() == 0 ){
        alert('Total Order cannot be Zero!');
    }
    else{
        $('#paymentModal').modal('show');
    }
});

/***************************************************************
* waktu form modal payment showed
***************************************************************/
$('#paymentModal').on('shown.bs.modal', function () {
    $('.amount_paid').each(function(i,obj){
        if (i==0){
            obj.focus();
        }
    }); 
    prepareModal();
})

/***************************************************************
* waktu form modal editDetail showed
***************************************************************/
$('#editDetail').on('shown.bs.modal', function () {
    $('#qty').focus();
    $('#qty').select();

})

/***************************************************************
* waktu F7, cari orderDetail terakhir, masukkan ke form modal
* editDetail
***************************************************************/

$('#editDetailButton').click(function(){
    findFirstOrderDetail();
    if($('#order_detail_id').val()){
        $('#editDetail').modal();
    }
    else
    {
        alert('no item to edit');
    }
});

function findFirstOrderDetail(){ //<<< first Order krn ganti sortir nya
    var c   = 0;
    var l   = false;
    var ri  = 0;

    for ( var i = 0; i <= 100; i++) {
        trs = $('#order-detail-grid tr').eq(i) ;
        if(trs.children(':nth-child(6)').text() != 0.00){
            c = i;
            if(c>0 && l==false){
                ri = c;
                l = true;
            }
        }
    }

    trs = $('#order-detail-grid tr').eq(ri);
    
    $('#order_detail_product_name').text( trs.children(':nth-child(2)').text() );
    $('#qty').val( trs.children(':nth-child(3)').text() );
    $('#unit_price').val( trs.children(':nth-child(6)').text() );
    var order_detail_id = trs.children(':nth-child(8)').children(':nth-child(1)').attr('href') ;
    $('#order_detail_id').val( order_detail_id  );
}

/*function findFirstOrderDetail(){ //<<< first Order krn ganti sortir nya
    var trs = $('#order-detail-grid table tbody tr:nth-child(1)') ;
    alert(trs.children(':nth-child(6)').text());
    $('#order_detail_product_name').text( trs.children(':nth-child(2)').text() );
    $('#qty').val( trs.children(':nth-child(3)').text() );
    $('#unit_price').val( trs.children(':nth-child(6)').text() );
    var order_detail_id = trs.children(':nth-child(8)').children(':nth-child(1)').attr('href') ;
    $('#order_detail_id').val( order_detail_id  );
}*/

/***************************************************************
* waktu button Yes di return modal click
***************************************************************/
$('#returnOrderButton').click(function(){
    var admin_pwd =  $("#admin_pwd").val() ;
    if(admin_pwd){
        location.href="<?php echo bu('/order/return?id=' . $model->id . '&admin_pwd=') ?>" + admin_pwd;
    }

});
/***************************************************************
* waktu form modal return product showed
***************************************************************/
$('#returnOrder').on('shown.bs.modal', function () {
    $('#admin_pwd').focus();
})


/*for print bill*/
/*print bill click*/
$('#print-bill').click(function(){
    var row = {
        id : <?php echo $model->id?>,
    }

    $.ajax({
        type: "GET",
        url: "<?php echo serverName().bu('/restoOrder/printBill') ?>",
        data: row,
        success: function(data){ 
            if(!data.success){
                alert(data.message);
            }else{
                alert("Print bill success");
            }
        },
        error: function(data){
            alert(data.statusText);
        },
        dataType: 'json'
    });  
});

var totalHistory = "<?php echo $model->total;?>";
function updateDiscount(){
    var row = {
        id : <?php echo $model->id;?>,
    };

    $.ajax({
        type: "POST",
        url: "<?php echo serverName().bu('/order/checkDiscount') ?>",
        data: row,
        success: function(data){ 
            var total = totalHistory - data;
            total = numeral( parseFloat(total) ).format('0,0.00');

            $('#total').val( total );
            $('#total_due').val(total);
            $('#total_due2').text(total);
            $('#split_due_text').val(total);
            $('#discount_special').val(data);
            $('#discountSpcl').val(data);
        },
        dataType: 'json'
    });  
}

$("#discountSpcl").autoNumeric('init', {vMin:-99999999});
$('#discountSpcl').keyup(function(){
    var discspcl = numeral().unformat($(this).val());

    var total = totalHistory - discspcl;
    total = numeral( parseFloat(total) ).format('0,0.00');

    $('#total').val( total );
    $('#total_due').val(total);
    $('#total_due2').text(total);
    $('#split_due_text').val(total);
    $('#discount_special').val(discspcl);
});

/*on key up split payment*/
$("#split_num").autoNumeric('init', {vMin:-99999999});
$('#split_num').keyup(function(event){
    var total_due = numeral().unformat($('#total_due').val());
    var split_due = total_due / $(this).val();

    $('#split_due').val(split_due);
    $('#split_due_text').val(numeral(split_due).format('0,0.00'));
});

$("#confirmButton").click(function(){
    var row = {
        password : $('#confirm_pwd').val(),
    }

    $.ajax({
        type: "POST",
        url: "<?php echo bu('/order/cekAdminPwd') ?>",
        data: row,
        success: function(data){
            $('#confirm_pwd').val("");
            if(data){
                $("#passwordError").hide();
                $("#confirmPassword").modal("hide");

                $("#customerTypeModal").modal("show");
            }else{
                $("#passwordError").show();
            }
        },
        dataType: 'json'
    });  
});

$("#confirmCustomer").click(function(){
    $("#customer-type-form").submit();
});
</script>


<?php
cs()->registerScriptFile(bu() . '/js/numeral/numeral.js');    
cs()->registerScriptFile(bu() . '/js/autoNumeric/autoNumeric.js');    
cs()->registerScript('ku',"
    function disableFunctionKeys(e) {
        var functionKeys = new Array(112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 123);
        if (functionKeys.indexOf(e.keyCode) > -1 || functionKeys.indexOf(e.which) > -1) {
            e.preventDefault();
        }
    };

    $(document).ready(function() {
        $(document).on('keydown', disableFunctionKeys);
    });

    $(document).bind('keyup', function(event){
    event.preventDefault();
    var kc = event.keyCode;
    if (kc>= 112 && kc<=120){
        switch(kc){
            case 113:
                location.href = '" . bu('/order/splitPayment/'.$model->id) . "';
                break;
            case 112:
                console.log('f1');
                $('#paymentButton').click();
                break;
            case 114:
                location.href = '" . bu('/order/printReceipt?reprint=true&id=' . $model->id) . "';
                break;
            case 115:
                location.href = '" . bu('/order/return?id=' . $model->id) . "';
                break;
            case 116:
                $('#print-bill').click();
                console.log('f5');
                break;
            case 117:
                console.log('f6');
                break;
            case 118:
                console.log('f7');
                findFirstOrderDetail();
                $('#editDetailButton').click();
                break;
            case 119:
                console.log('f8');
                break;
            case 120:
                console.log('f9');
                $('#cancelOrderButton').click();
                break;
        }
    }
})");
?>