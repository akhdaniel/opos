<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'session-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100, 'readonly'=>true)); ?>

	<?php echo $form->textFieldRow($model,'open_date',array('class'=>'span5', 'readonly'=>true)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5', 'readonly'=>true)); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
