<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'prepare-barcode-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'product_id',array('class'=>'span5')); ?>
    <?php 
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name'=>'product',
        'id'=>"barcode",
        'source'=>'js: function( request, response ) {
                $.getJSON( "' . bu('/product/autocomplete') . '", {
                    term: request.term,
                }, response );
        }',
        'value'=>$model->product->name,  
        'options'=>array(
            'max'=>10,
            'minChars'=>2, 
            'delay'=>300,
            'matchCase'=>true,
            'minLength'=>'4',
            'search'=>"js: function(event, ui) {
            }",             
            'select'=>"js: function(event, ui) {
                $('#PrepareBarcode_product_id').val(ui.item.id);
            }"
        ),
        'htmlOptions'=>array(
            'class' => 'span5',
            'placeholder'=>'scan or search product here...',
            'onKeyPress'=>"return cekBarcode(this, event);" 
        )
        ));
    ?>

	<?php echo $form->textFieldRow($model,'qty',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>



<script>

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

        if(code.length < 2 && parseInt(code) ){
            findLastOrderDetail();
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


</script>