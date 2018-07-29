<h1>Join Payment</h1>
<table class="table">
    <tr>
        <th>Join Number</th><td><?php echo $model->join_number?></td>
        <th>Join Date</th><td><?php echo $model->join_date?></td>
        <th>Salesman</th><td><?php echo $model->salesman_id?> [<?php echo Yii::app()->user->name?>]</td>
    </tr>
    <tr>
        <th>State</th><td><?php echo $model->state?></td>
        <th>Session</th><td><?php echo $model->session_id?></td>
        <th>&nbsp;</th><td>&nbsp;</td>
    </tr>
</table>

<h1>Join Payment Detail</h1>
<?php if($model->state == JOIN_UNPAID) : ?>
    <div>
        <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'product',
            'id'=>"barcode",
            'source'=>'js: function( request, response ) {
                    $.getJSON( "' . bu('/joinPayment/autocomplete') . '", {
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
                'placeholder'=>'search order here...',
                'onKeyPress'=>"return cekOrder(this, event);" 
            )
            ));
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Payment',
            'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'large', // null, 'large', 'small' or 'mini'
            'htmlOptions'=>array(
                'id'=>'paymentButton',
                //'data-toggle'=>'modal',
                //'data-target'=>'#paymentModal',
            ),        
        )); ?>
    </div>
<?php endif; // unpaid ?>

<?php 
    $columns=array(
        array(
            'value'=>'CHtml::link( $data->order->number, Yii::app()->createUrl("/Order/view/" . $data->order_id )) ', 
            'type'=>'raw',
            'header'=>'Order Number',
        ),
        array('value'=>'$data->order->table->table_name', 'header'=>'Table Number', 'visible'=> AppSetting::model()->findOrCreate("pos_mode","retail")->val == "resto"?true:false,),
        array('value'=>'number_format($data->amount,2)', /*'name'=>'amount',*/ 'header'=>'Amount','htmlOptions'=>array('style'=>'text-align: right')),
    );

    if($model->state == JOIN_UNPAID){
        $columns[] = array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',   
            'htmlOptions'=>array('width'=>'70px'),
            'buttons'=>array(
                'delete' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                    'url'=>'$data->primaryKey',
                    'click'=>'js:function(){
                        if (confirm("Are you sure to delete this?")){
                            $.ajax({
                                type: "POST",
                                url: "'.Yii::app()->controller->createUrl("/joinPaymentDetail/delete", array('ajax'=>true)).'&id="+$(this).attr("href"),
                                success: function(){
                                    $("#order-detail-grid").yiiGridView.update("join-payment-detail-grid");
                                    updateTotals();
                                }
                            });                    
                        }
                        return false;
                    }',
                ),
            ),
        );
    }

    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'join-payment-detail-grid',
        'type'=>'striped bordered hover',
        'dataProvider'=>$joinPaymentDetail->search(),
        'columns'=>$columns,
    )); 
?>

<table style="width:100%" class="table condensed">
    <tr>
        <td style="width:90%" ><div align="right">Total:</div></td>
        <td><input style="text-align:right; font-size:30px; height:50px" type="text" 
            id="total"
            size=20
            readonly=true 
            value="<?php echo number_format($total,2)?>"> </td>
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

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'paymentModal')); ?>
    <form action="<?php echo $this->createUrl('/joinPayment/validate')?>" method="POST" id="paymentForm">
        <input type='hidden' name='join_payment_id' value="<?php echo $model->id ?>" />
        <input type='hidden' name='total_due' id='total_due_text' value="<?php echo $total ?>" />
        <input type='hidden' name='total_paid' id='total_paid_text' value="<?php echo $model->total_paid ?>" />
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Total Due : <span id="total_due_header"><?php echo number_format($total,2) ?></span></h4>
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
                    <td>
                        <input style = "text-align:right; font-size:20pt" type="textField" 
                        id="total_due"
                        size="13" readonly="true" 
                        value="<?php echo number_format($total,2)?>">
                    </td>
                </tr>
                <tr>
                    <td style="width:90%" ><div align="right">Paid Total :</div></td>
                    <td><input style = "text-align:right; font-size:20pt" type="textField" 
                        id="total_paid"
                        size=13 readonly=true 
                        value="<?php echo number_format($model->total_paid,2)?>"> </td>
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
                disabled="true" >Proccess</button>

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

<h1>Detail Payment</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'order-payment-grid',
    'type'=>'striped bordered hover',
    'dataProvider'=>$modelJoinPaymentPayment->search(),
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

<script>
/***************************************************************
* check order waktu enter field autocomplete order
***************************************************************/
function cekOrder(myfield,e) 
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
              url: "<?php echo serverName().bu('/joinPayment/findbycode?code=')?>" + encodeURIComponent(code) + "&join_payment_id=<?php echo $model->id?>",
              success: function(data){ 
                if(data.success){   
                    updateTotals();
                    $.fn.yiiGridView.update("join-payment-detail-grid");

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
* update total
***************************************************************/
function updateTotals(){
    $.ajax({
        type: "POST",
        url: "<?php echo serverName().bu('/joinPayment/getTotal?id=' . $model->id ) ?>",
        success: function(data){ 
            if(!data.success){
                alert('error order/jview');
            }else{
                var total = numeral( parseFloat(data.total) ).format('0,0.00');
                $('#total').val( total );

                $('#total_due_text').val(parseFloat(data.total));
                $('#total_due').val(total);
                $('#total_due_header').text(total);

                /*var totalListPrice = numeral( parseFloat(data.totalListPrice) ).format('0,0.00');
                $('#totalListPrice').val( totalListPrice );

                var totalDiscount = numeral( parseFloat(data.totalDiscount) ).format('0,0.00');
                $('#totalDiscount').val( totalDiscount );*/
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
* ketika tombol payment di klik
***************************************************************/
$('#paymentButton').click(function(){
    if($('#total').val() == 0 ){
        alert('Total Order cannot be Zero!');
    }
    else{
        $('#paymentModal').modal('show');
    }
});


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

    $('#total_paid_text').val(total_paid);
    $('#total_paid').val(numeral(total_paid ).format('0,0.00') );
    $('#total_change').val(numeral(total_change).format('0,0.00') );

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
* tombol next order . klik to submit form
***************************************************************/
$('#nextOrder').click(function(){
    var max_total_change = 500000;
    var total_change= numeral().unformat( $('#total_change').val() );

    if( total_change > max_total_change ){
        alert('Total change is bigger than ' + numeral( max_total_change ).format('0,0.00')  + '. Please check the Cash Amount !');
    }else{
        $('#nextOrder').attr('disabled',true);
        $('#closePayment').attr('disabled',true);
        $('#paymentForm').submit();        
    }
});
</script>

<?php
    cs()->registerScriptFile(bu() . '/js/numeral/numeral.js');
    cs()->registerScriptFile(bu() . '/js/autoNumeric/autoNumeric.js');    
?>

