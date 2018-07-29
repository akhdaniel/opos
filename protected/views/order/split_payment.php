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
</table>

<h1>Order Detail</h1>
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
    'label'=>'[F2] Cancel Split',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>bu('/order/'.$model->id),
)); ?>

<?php $this->renderPartial('wait', array() ); ?>

<form action="<?php echo $this->createUrl('/orderPayment/validateSplit')?>" method="POST" id="paymentForm">
<?php 
$columns=array(
    array('header'=>'<input type="checkbox" id="checkall"/>', 'value'=>'CHtml::checkBox("odi[]",null,array("value"=>$data[id]."_".$data[order_detail_id],"id"=>"odi_".$data[id], "class"=>"checkbox_id"))', 'type'=>'raw'),
    array('value'=>'$data["item_code"]', 'header'=>'Item Code' ),
    array('value'=>'$data["product_name"]', 'header'=>'Product Name' ),
    //array('value'=>'number_format(1,3)', /*'name'=>'qty',*/ 'header'=>'Qty','htmlOptions'=>array('style'=>'text-align: right')),
    array('value'=>'number_format($data["list_price"],2)', /*'name'=>'list_price',*/'header'=>'List Price','htmlOptions'=>array('style'=>'text-align: right')),
    array('value'=>'number_format($data["list_price"] - $data["unit_price"],2)', 'header'=>'Discount','htmlOptions'=>array('style'=>'text-align: right')),
    array('value'=>'number_format($data["unit_price"],2)', /*'name'=>'unit_price',*/ 'header'=>'Unit Price','htmlOptions'=>array('style'=>'text-align: right')),
    //array('value'=>'number_format($data["amount"],2)', /*'name'=>'amount',*/ 'header'=>'Amount','htmlOptions'=>array('style'=>'text-align: right')),
);?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'order-detail-grid',
    'type'=>'striped bordered hover',
	'dataProvider'=>$modelOrderDetail,
	'columns'=>$columns,
)); ?>

<table style="width:100%" class="table condensed">
    <tr>
        <td style="width:90%" ><div align="right">Sub Total:</div></td>
        <td><input style="text-align:right" type="text" 
            id="totalListPrice"
            size=13 readonly=true 
            value="0"> </td>
    </tr>

    <tr>
        <td style="width:90%" ><div align="right">Discount:</div></td>
        <td><input style="text-align:right" type="text" 
            id="totalDiscount"
            size=13 readonly=true 
            value="0"> </td>
    </tr>
    <tr>
        <td style="width:90%" ><div align="right">Total:</div></td>
        <td><input style="text-align:right; font-size:30px; height:50px" type="text" 
            id="total"
            size=20
            readonly=true 
            value="0"> </td>
    </tr>
</table>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'paymentModal')); ?>
        <input type='hidden' name='order_id' value="<?php echo $model->id ?>" />
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Total Due : <span id="total_due2"><?php echo number_format($model->total,2) ?></span></h4>
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
                <input type="hidden" id="split_num" name="split_num" value="1">
                <input type="hidden" id="split_due" name="split_due" value="0">
                <tr>
                    <td style="width:90%" ><div align="right">Due Total:</div></td>
                    <td><input style = "text-align:right; font-size:20pt" type="textField" 
                        id="total_due"
                        size="13" readonly="true" 
                        value="0"> </td>
                </tr>
                <tr>
                    <td style="width:90%" ><div align="right">Paid Total :</div></td>
                    <td><input style = "text-align:right; font-size:20pt" type="textField" 
                        id="total_paid"
                        size=13 readonly=true 
                        value="0"></td>
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
                disabled="true" >Submit Payment</button>

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
                var total = numeral( parseFloat(data.total) ).format('0,0.00');
                $('#total').val( total );
                $('#total_due').val(total);
                $('#total_due2').text(total);

                var totalListPrice = numeral( parseFloat(data.totalListPrice) ).format('0,0.00');
                $('#totalListPrice').val( totalListPrice );

                var totalDiscount = numeral( parseFloat(data.totalDiscount) ).format('0,0.00');
                $('#totalDiscount').val( totalDiscount );
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
});

/***************************************************************
* waktu form modal editDetail showed
***************************************************************/
$('#editDetail').on('shown.bs.modal', function () {
    $('#qty').focus();
    $('#qty').select();

});

/***************************************************************
* waktu form modal editDetail showed
***************************************************************/
$('#checkall').change (function(){
    if($(this).is(':checked')){
        totallistprice= 0;
        totaldiscount = 0;

        $('.checkbox_id').each(function(){
            $(this).attr('checked', true).triggerHandler('click');
        });
    }else{
        $('.checkbox_id').each(function(){
            $(this).attr('checked', false).triggerHandler('click');
        });
    }
});

/***************************************************************
* waktu checkob di klik, hitung total sum order
***************************************************************/
$(".checkbox_id").click(function(){
    var row = {
        id : $(this).val(),
    }

    $('#modalProgress').modal('show');
    $.ajax({
        type: "GET",
        url: "<?php echo serverName().bu('/orderDetail/check') ?>",
        data: row,
        success: function(data){
            if($("#odi_"+data.id).is(':checked')){
                calculateTotal(data, 'add');
            }else{
                calculateTotal(data, 'minus');
            }

            $('#modalProgress').modal('hide');
        },
        dataType: 'json'
    });

    /*jika semua di klik, maka parent checked*/
    cekCheckAll();
});

function cekCheckAll(){
    var checked = true;
    $('.checkbox_id').each(function(){
        if($(this).prop('checked') == false){
            checked = false;
        }
    });

    if(checked == false){
        $('#checkall').attr('checked', false);
    }else{
        $('#checkall').attr('checked', true);
    }
}

var totallistprice= 0;
var totaldiscount = 0;

function calculateTotal(data, type){
    if(type == 'add'){
        totallistprice= totallistprice + parseFloat(data.list_price);
        totaldiscount = totaldiscount + (parseFloat(data.list_price) - parseFloat(data.unit_price));
    }else{
        totallistprice= totallistprice - parseFloat(data.list_price);
        totaldiscount = totaldiscount - (parseFloat(data.list_price) - parseFloat(data.unit_price));
    }

    var total = totallistprice - totaldiscount;

    $('#totalListPrice').val(numeral(totallistprice).format('0,0.00'));
    $('#totalDiscount').val(numeral(totaldiscount).format('0,0.00'));
    $('#total').val(numeral(total).format('0,0.00'));
   
    $('#total_due').val(numeral(total).format('0,0.00'));
    $('#total_due2').text(numeral(total).format('0,0.00'));

    $('#split_due').val(total);
}

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
            case 112:
                $('#paymentButton').click();
                break;

            case 113:
                location.href = '" . bu('/order/view/'.$model->id) . "';
                break;
        }
    }
})");
?>