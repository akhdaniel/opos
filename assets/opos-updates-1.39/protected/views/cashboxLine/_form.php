<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cashbox-line-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'session_payment_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'number_opening',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'number_closing',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pieces',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'oe_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
