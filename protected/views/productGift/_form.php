<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-gift-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<h2>Buy</h2>
	<?php echo $form->textFieldRow($model,'buy_qty',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->hiddenField($model,'product_id',array('class'=>'span5')); ?>
	<input type='text' value='<?php echo $model->product->name?>' class='span5' readonly='true'/>
    <?php 
        // $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        // 'name'=>'product',
        // 'id'=>"barcode",
        // 'source'=>'js: function( request, response ) {
        //         $.getJSON( "' . bu('/product/autocomplete') . '", {
        //             term: request.term,
        //         }, response );
        // }',
        // 'value'=>$model->product->name,  
        // 'options'=>array(
        //     'max'=>10,
        //     'minChars'=>2, 
        //     'delay'=>300,
        //     'matchCase'=>true,
        //     'minLength'=>'4',
        //     'search'=>"js: function(event, ui) {
        //     }",             
        //     'select'=>"js: function(event, ui) {
        //         $('#ProductGift_product_id').val(ui.item.id);
        //     }"
        // ),
        // 'htmlOptions'=>array(
        //     'class' => 'span5',
        //     'placeholder'=>'scan or search product here...',
        //     'onKeyPress'=>"return cekBarcode(this, event);" 
        // )
        // ));
    ?>



	<h2>Get</h2>
	<?php echo $form->textFieldRow($model,'get_qty',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->hiddenField($model,'gift_product_id',array('class'=>'span5')); ?>
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
                $('#ProductGift_gift_product_id').val(ui.item.id);
            }"
        ),
        'htmlOptions'=>array(
            'class' => 'span5',
            'placeholder'=>'scan or search product here...',
            'onKeyPress'=>"return cekBarcode(this, event);" 
        )
        ));
    ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
