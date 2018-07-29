<div class="row-fluid">
    <!-- untuk bagian sebelah kiri -->
    <div class="span7">
        <div class="row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <?php 
                        $columns=array(
                            'product.name',
                            array(
                                'value'=>'number_format($data->qty,3)', 
                                'header'=>'Qty',
                                'htmlOptions'=>array('style'=>'text-align: right')
                            ),
                            array(
                                'value'=>'number_format($data->unit_price,2)', 
                                'header'=>'Unit Price',
                                'htmlOptions'=>array('style'=>'text-align: right')
                            ),
                            array(
                                'value'=>'number_format($data->list_price - $data->unit_price,2)', 
                                'header'=>'Discount',
                                'visible'=> AppSetting::model()->findOrCreate("show_discount_waiter","1")->val=="1"?true:false,
                                'htmlOptions'=>array('style'=>'text-align: right')
                            ),
                            array(
                                'value'=>'number_format($data->amount,2)', 
                                'header'=>'Amount',
                                'visible'=> AppSetting::model()->findOrCreate("show_amount_waiter","1")->val=="1"?true:false,
                                'htmlOptions'=>array('style'=>'text-align: right')
                            ),
                            array(
                                'class'=>'ButtonColumn',
                                'template'=>'{waiting} {cooking} {ready} {delivered}',
                                'evaluateID'=>true,
                                'buttons'=>array(
                                    'waiting' => array(
                                        'visible'=>'$data->status==ORDER_DETAIL_WAITING? true : false',
                                        'label'=>'<button class="btn btn-warning">Waiting</button>',
                                        'options'=>array('title'=>'Order Waiting'),
                                    ),

                                    'cooking' =>array(
                                        'visible'=>'$data->status==ORDER_DETAIL_ONPROGRESS? true : false',
                                        'label'=>'<button class="btn btn-primary">Cooking</button>',
                                        'options'=>array('title'=>'Orders are being cooked'),
                                    ),

                                    'ready' =>array(
                                        'visible'=>'$data->status==ORDER_DETAIL_DONE? true : false',
                                        'label'=>'<button class="btn btn-success">Ready</button>',
                                        'options'=>array('title'=>'Order ready', 'id'=>'$data->id'),
                                        'click'=>'function(){setDelivered($(this).attr("id"), 1);}',
                                    ),

                                    'delivered' =>array(
                                        'visible'=>'$data->status==ORDER_DETAIL_DELIVERED? true : false',
                                        'label'=>'<button class="btn">Delivered</button>',
                                        'options'=>array('title'=>'Order delivered'),
                                    ),
                                ),
                            ),  
                        );
                    ?>

                    <div class="span12">
                        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                            'id'=>'product-form',
                            'enableAjaxValidation'=>false,
                            'action'=>Yii::app()->createUrl('//restoOrder/confirmOrder'),
                        )); ?>
                        <?php
                            echo $form->hiddenField($model,'id',array('value'=>$model->id));
                            echo $form->dropDownlistRow($model,'table_id', 
                                    (CHtml::listData(Table::model()->findAll('status=1 or id='.$model->table_id),'id','table_name')),
                                    array('prompt'=>'-- Choose table --', 'class'=>'span12')
                                );
                        ?>


                            <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'noteModal')); ?>
                                <div class="modal-header">
                                    <a class="close" data-dismiss="modal">&times;</a>
                                    <h4>Notes</h4>
                                </div>
                                 
                                <div class="modal-body">
                                    <input type="hidden" id="order_detail_note_id"/>
                                    <textarea rows="5" cols="100" style="width:97%;" id="order_detail_note"></textarea> 
                                </div>
                                 
                                <div class="modal-footer">
                                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                                        'type'=>'primary',
                                        'label'=>'Ok',
                                        'url'=>'#',
                                        'htmlOptions'=>array('id'=>'notes_ok'),
                                    )); ?>            
                                </div>
                            <?php $this->endWidget(); ?>

                        <?php $this->endWidget(); ?>

                        <?php $this->widget('bootstrap.widgets.TbGridView', array(
                            'id'=>'order-detail-grid',
                            'type'=>'bordered hover responsive',
                            'dataProvider'=>$modelOrderDetail->search(),
                            'rowCssClassExpression'=>'$data->getCssClass()',
                            'columns'=>$columns,
                            'summaryText'=>'',
                        )); ?>

                        <?php if(AppSetting::model()->findOrCreate("show_sub_total","1")->val == "1") {?>
                            <table style="width:100%" class="table condensed">
                                <tr>
                                    <td>Sub Total: <span id='totalListPrice'><b><?php echo number_format($model->totalListPrice,2)?></b></span></td>
                                    <td>Discount: <span id='totalDiscount'><b><?php echo number_format($model->totalDiscount,2)?></b></span></td>
                                    <td>Total: <span id='total' style="font-size:20px;"><b><?php echo number_format($model->total,2)?></b></span></td>
                                </tr>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="row-fluid pad">
            <div class="span6">
                <div class="numeric-keypad">
                    <div class="row-fluid">
                        <button class="btn span12 btn-success" id="confirm-order">Confirm Order</button>
                    </div>
                    <div class="row-fluid">
                        <button class="btn span12 btn-primary" id="print-bill">Print Bill</button>
                    </div>
                    <div class="row-fluid">
                        <button class="btn btn-danger span12" data-value="backspace" id="deleteBtn">Delete</button>
                    </div>
                    <div class="row-fluid">
                        <button class="btn btn-primary span12" data-value="delivered" id="deliverBtn">Deliver All</button>
                    </div>
                     <div class="row-fluid">
                        <button class="btn btn-success span12" data-value="ok" id="okBtn">Ok</button>
                    </div>
                </div>
            </div>

            <div class="span6">
                <div class="numeric-keypad keypad">
                    <div class="row-fluid">
                        <button class="btn span4" data-value="1" onclick="numericTouch('1');">1</button>
                        <button class="btn span4" data-value="2" onclick="numericTouch('2');">2</button>
                        <button class="btn span4" data-value="3" onclick="numericTouch('3');">3</button>
                    </div>
                    <div class="row-fluid">
                        <button class="btn span4" data-value="4" onclick="numericTouch('4');">4</button>
                        <button class="btn span4" data-value="5" onclick="numericTouch('5');">5</button>
                        <button class="btn span4" data-value="6" onclick="numericTouch('6');">6</button>
                    </div>
                    <div class="row-fluid">
                        <button class="btn span4" data-value="7" onclick="numericTouch('7');">7</button>
                        <button class="btn span4" data-value="8" onclick="numericTouch('8');">8</button>
                        <button class="btn span4" data-value="9" onclick="numericTouch('9');">9</button>
                    </div>
                    <div class="row-fluid">
                        <button class="btn span4 btn-success" data-value="qty" id="qty_button" >Qty</button>
                        <button class="btn span4" data-value="0" onclick="numericTouch('0');">0</button>
                        <button class="btn span4 btn-primary" data-value="qty" id="notes_button" >Notes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- untuk bagian product dan kategory -->
    <div class="span5 product_div">
            <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'action'=>Yii::app()->createUrl($this->route),
                'method'=>'get',
                'htmlOptions'=>array(
                    'id'=>'category-search'
                )
            )); ?>
                <?php echo $form->hiddenField($modelProduct,'category'); ?>
                <?php echo $form->hiddenField($modelProduct,'name'); ?>
            <?php $this->endWidget(); ?>

        <div class="row-fluid">
            <div class="bootstrap-widget span12">
                <div class="bootstrap-widget-header">
                    <h3>Product Category</h3>
                </div>
                <div class="bootstrap-widget-content">
                   <div class="row-fluid">
                        <ul class="thumbnails">
                           <li class="span6" onclick="filterProduct('1')">
                                <div class="thumbnail">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/default.png"/>
                                    <div class="caption">
                                        <p align="center">Food</p>
                                    </div>
                                </div>
                           </li>
                           <li class="span6" onclick="filterProduct('2')">
                                <div class="thumbnail">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/default.png"/>
                                    <div class="caption">
                                        <p align="center">Drink</p>
                                    </div>
                                </div>
                           </li>
                        </ul>
                    </div>
                </div>
                <br/>
                <div class="navbar">
                  <div class="navbar-inner">
                    <div class="navbar-search pull-left searchbar">
                      <input type="text" class="search-query span12" placeholder="Search Product Name" id="product_search" size="100">
                    </div>
                  </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <?php
                    if(AppSetting::model()->findOrCreate("product_view_type","grid")->val == "grid"){
                        $this->widget('bootstrap.widgets.TbListView',array(
                            'dataProvider'=>$modelProduct->searchGrid(),
                            'id'=>'product-grid',
                            'itemView'=>'_view_grid',
                            'template'=>'{items} {pager}',
                            'itemsCssClass'=>'thumbnails',
                            'itemsTagName'=>'ul',
                            'cssFile'=>false,
                            'summaryText'=>false,
                            'pager'=>array(
                                'header'=>'',
                                'cssFile'=>false,
                                'maxButtonCount'=>0,
                                'selectedPageCssClass'=>'active',
                                'hiddenPageCssClass'=>'disabled',
                                'prevPageLabel'=>'Previous',
                                'nextPageLabel'=>'Next',
                            ),
                        ));
                    }else{
                        $this->widget('bootstrap.widgets.TbListView',array(
                            'dataProvider'=>$modelProduct->searchGrid(),
                            'id'=>'product-grid',
                            'itemView'=>'_view_list',
                            'template'=>'{items} {pager}',
                            'itemsCssClass'=>'nav nav-tabs nav-stacked',
                            'itemsTagName'=>'ul',
                            'cssFile'=>false,
                            'summaryText'=>false,
                            'pager'=>array(
                                'header'=>'',
                                'cssFile'=>false,
                                'maxButtonCount'=>0,
                                'selectedPageCssClass'=>'active',
                                'hiddenPageCssClass'=>'disabled',
                                'prevPageLabel'=>'Previous',
                                'nextPageLabel'=>'Next',
                            ),
                        ));
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    var mode = 0;
    var qtyEdited = "";
    var idOrderDetail = null;
    /***************************************************************
    * for insert order detail, when product touch*
    ***************************************************************/
    function insertOrder(productId){
        var row = {
            order_id : <?php echo $model->id?>,
            product_id : productId,
            qty: 1,
        };

        $.ajax({
            type: "POST",
            url: "<?php echo serverName().bu('/orderDetail/jcreate') ?>",
            data: row,
            success: function(data){ 
                if(!data.success){
                    alert(data.message);
                }else{
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
    function updateOrderDetails(){
        if(idOrderDetail != null){
            var row = {
                id : idOrderDetail,
                qty: numeral().unformat(qtyEdited),
                unit_price : "",
            };

            $.ajax({
              type: "POST",
              url: "<?php echo serverName().bu('/orderDetail/jupdate') ?>",
              data: row,
              success: function(data){ 
                    if(!data.success){
                        alert(data.message);
                    }else{
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
    }

    /***************************************************************
    * update qty from virtual button
    ***************************************************************/
    function numericTouch(val){
        if(mode == 0){
            alert("please select qty button first")
        }else{
            idOrderDetail = $.fn.yiiGridView.getSelection("order-detail-grid")[0];
            
            if(typeof idOrderDetail === 'undefined'){
                alert("Please select order detail first");
            }else{
                var qtyCol      = $(".selected").find('td:nth-child(2)');
                var discountCol = $(".selected").find('td:nth-child(4)');
                
                
                if(mode == 1){
                    qtyEdited += val;
                    qtyCol.text(qtyEdited + ".000");
                } 
            }
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
                if(!data.success){
                    alert('error order/jview');
                }else{
                    var total = numeral( parseFloat(data.total) ).format('0,0.00');
                    $('#total').html( '<b>' + total + '</b>');

                    var totalListPrice = numeral( parseFloat(data.totalListPrice) ).format('0,0.00');
                    $('#totalListPrice').html( '<b>' + totalListPrice + '</b>' );

                    var totalDiscount = numeral( parseFloat(data.totalDiscount) ).format('0,0.00');
                    $('#totalDiscount').html( '<b>' + totalDiscount + '</b>');
                }
            },
          
            error: function(data){
                alert(data.statusText);
            },
            dataType: 'json'
        });  
    }

    /*set mode to qty when qty button click*/
    $('#qty_button').click(function(){
        mode = 1;
    });

    /*set update when ok button click*/
    $('#okBtn').click(function(){
        updateOrderDetails();

        /*reset mode*/
        qtyEdited     = "";
        mode          = 0;
        idOrderDetail = null;
    });

    /*delte order detail when delete click*/
    $('#deleteBtn').click(function(){
        idOrderDetail = $.fn.yiiGridView.getSelection("order-detail-grid")[0];
        
        if(typeof idOrderDetail === 'undefined'){
            alert("Please select order detail for delete");
        }else{
            var row = {
                id : idOrderDetail,
            };

            $.ajax({
              type: "POST",
              url: "<?php echo serverName().bu('/orderDetail/jdelete') ?>",
              data: row,
              success: function(data){ 
                    if(!data.success){
                        alert(data.message);
                    }else{
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
    });

    /*when deliver btn all click*/
    $('#deliverBtn').click(function(){
        idOrderDetail = <?php echo $model->id?>;

        var row = {
            id : idOrderDetail,
        };

        $.ajax({
          type: "POST",
          url: "<?php echo serverName().bu('/orderDetail/deliverAll') ?>",
          data: row,
          success: function(data){ 
                if(!data.success){
                    alert(data.message);
                }else{
                    alert('All orders ready has been delivered');
                    $.fn.yiiGridView.update("order-detail-grid");
                    updateTotals();
                }
          },
          error: function(data){
            alert(data.statusText);
          },
          dataType: 'json'
        });  
    });

    function setDelivered(id){
        idOrderDetail = id;
        
        if(typeof idOrderDetail === 'undefined'){
            alert("Please select order detail for set to deliver");
        }else{
            var row = {
                id : idOrderDetail,
            };

            $.ajax({
              type: "POST",
              url: "<?php echo serverName().bu('/orderDetail/deliver') ?>",
              data: row,
              success: function(data){ 
                    if(!data.success){
                        alert(data.message);
                    }else{
                        alert('Order has been delivered');
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
    }

    /*confirm order click*/
    $('#confirm-order').click(function(){
        if($('#Order_table_id').val() == ""){
            alert("Please select table number");
        }else{
            $('#product-form').submit();
        }
    });

    /*note click*/
    $('#notes_button').click(function(){
        idOrderDetail = $.fn.yiiGridView.getSelection("order-detail-grid")[0];
        
        if(typeof idOrderDetail === 'undefined'){
            alert("Please select order detail to add a note");
        }else{
            var row = {
                id : idOrderDetail,
            }
            $.ajax({
                type: "GET",
                url: "<?php echo serverName().bu('/orderDetail/searchNote') ?>",
                data: row,
                success: function(data){ 
                    $('#order_detail_note_id').val(idOrderDetail);
                    $('#order_detail_note').val(data.note);
                },
                error: function(data){
                    alert(data.statusText);
                },
                dataType: 'json'
            });

            $('#noteModal').modal('show');
        }
    });

    $('#notes_ok').click(function(){
        var row = {
            id : $('#order_detail_note_id').val(),
            note : $('#order_detail_note').val()
        }

        console.log(row);
        $.ajax({
            type: "POST",
            url: "<?php echo serverName().bu('/orderDetail/saveNote') ?>",
            data: row,
            success: function(data){ 
                if(!data.response){
                    alert('Error when saving note, please try again')
                }
                $('#order_detail_note').val('');
                $('#noteModal').modal('hide');
            },
            error: function(data){
                alert(data.statusText);
            },
            dataType: 'json'
        });
    });

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
                if(data.status){
                    alert("Print bill success");
                }
            },
            error: function(data){
                alert(data.statusText);
            },
            dataType: 'json'
        });  
    });

    /*filter product*/
    function filterProduct(id){
        $('#Product_name').val('');
        $("#product_search").val('');

        if(id == '1'){
            $('#Product_category').val('Persediaan Makanan');
        }else if(id == '2'){
            $('#Product_category').val('Persediaan Minuman');
        }else{
            $('#Product_category').val('Persediaan Rokok');
        }   
        
        $.fn.yiiListView.update("product-grid",{data: $('#category-search').serialize()});
    }

    $("#product_search").keyup(function(){
        $('#Product_category').val('');
        $('#Product_name').val($(this).val());

        $.fn.yiiListView.update("product-grid",{data: $('#category-search').serialize()});
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
                location.href = '" . bu('/order/create') . "';
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