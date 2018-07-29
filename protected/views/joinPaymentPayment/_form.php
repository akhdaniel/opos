<?php
/* @var $this JoinPaymentPaymentController */
/* @var $model JoinPaymentPayment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'join-payment-payment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'join_payment_id'); ?>
		<?php echo $form->textField($model,'join_payment_id'); ?>
		<?php echo $form->error($model,'join_payment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_type_id'); ?>
		<?php echo $form->textField($model,'payment_type_id'); ?>
		<?php echo $form->error($model,'payment_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'card_no'); ?>
		<?php echo $form->textField($model,'card_no',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'card_no'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->