<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'app-setting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>50, 'readonly'=>true)); ?>

	<?php echo $form->textFieldRow($model,'val',array('class'=>'span5','maxlength'=>200)); ?>

	<button type="button" id="md5">md5</button>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<?php
cs()->registerScriptFile(bu() . '/js/md5.js');    
cs()->registerScript('md5',"
$('#md5').click(function(){
	var old = $('#AppSetting_val').val();
	$('#AppSetting_val').val( md5( old ) );
});
");
?>