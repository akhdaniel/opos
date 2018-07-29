<?php
/* @var $this PosSessionController */
/* @var $model PosSession */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pos-session-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'create_uid'); ?>
		<?php echo $form->textField($model,'create_uid'); ?>
		<?php echo $form->error($model,'create_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'write_date'); ?>
		<?php echo $form->textField($model,'write_date'); ?>
		<?php echo $form->error($model,'write_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'write_uid'); ?>
		<?php echo $form->textField($model,'write_uid'); ?>
		<?php echo $form->error($model,'write_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'config_id'); ?>
		<?php echo $form->textField($model,'config_id'); ?>
		<?php echo $form->error($model,'config_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cash_journal_id'); ?>
		<?php echo $form->textField($model,'cash_journal_id'); ?>
		<?php echo $form->error($model,'cash_journal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_at'); ?>
		<?php echo $form->textField($model,'start_at'); ?>
		<?php echo $form->error($model,'start_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cash_register_id'); ?>
		<?php echo $form->textField($model,'cash_register_id'); ?>
		<?php echo $form->error($model,'cash_register_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stop_at'); ?>
		<?php echo $form->textField($model,'stop_at'); ?>
		<?php echo $form->error($model,'stop_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->