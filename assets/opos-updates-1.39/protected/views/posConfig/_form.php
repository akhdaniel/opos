<?php
/* @var $this PosConfigController */
/* @var $model PosConfig */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pos-config-form',
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
		<?php echo $form->labelEx($model,'iface_vkeyboard'); ?>
		<?php echo $form->checkBox($model,'iface_vkeyboard'); ?>
		<?php echo $form->error($model,'iface_vkeyboard'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iface_cashdrawer'); ?>
		<?php echo $form->checkBox($model,'iface_cashdrawer'); ?>
		<?php echo $form->error($model,'iface_cashdrawer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'journal_id'); ?>
		<?php echo $form->textField($model,'journal_id'); ?>
		<?php echo $form->error($model,'journal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iface_self_checkout'); ?>
		<?php echo $form->checkBox($model,'iface_self_checkout'); ?>
		<?php echo $form->error($model,'iface_self_checkout'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iface_electronic_scale'); ?>
		<?php echo $form->checkBox($model,'iface_electronic_scale'); ?>
		<?php echo $form->error($model,'iface_electronic_scale'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_id'); ?>
		<?php echo $form->textField($model,'shop_id'); ?>
		<?php echo $form->error($model,'shop_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_by'); ?>
		<?php echo $form->checkBox($model,'group_by'); ?>
		<?php echo $form->error($model,'group_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iface_payment_terminal'); ?>
		<?php echo $form->checkBox($model,'iface_payment_terminal'); ?>
		<?php echo $form->error($model,'iface_payment_terminal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sequence_id'); ?>
		<?php echo $form->textField($model,'sequence_id'); ?>
		<?php echo $form->error($model,'sequence_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iface_print_via_proxy'); ?>
		<?php echo $form->checkBox($model,'iface_print_via_proxy'); ?>
		<?php echo $form->error($model,'iface_print_via_proxy'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->