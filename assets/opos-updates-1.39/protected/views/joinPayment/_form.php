<?php
/* @var $this JoinPaymentController */
/* @var $model JoinPayment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'join-payment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'join_number'); ?>
		<?php echo $form->textField($model,'join_number',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'join_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'join_date'); ?>
		<?php echo $form->textField($model,'join_date'); ?>
		<?php echo $form->error($model,'join_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_paid'); ?>
		<?php echo $form->textField($model,'total_paid',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'total_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_change'); ?>
		<?php echo $form->textField($model,'total_change',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'total_change'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salesman_id'); ?>
		<?php echo $form->textField($model,'salesman_id'); ?>
		<?php echo $form->error($model,'salesman_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'session_id'); ?>
		<?php echo $form->textField($model,'session_id'); ?>
		<?php echo $form->error($model,'session_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->