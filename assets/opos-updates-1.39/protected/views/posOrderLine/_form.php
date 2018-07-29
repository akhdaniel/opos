<?php
/* @var $this PosOrderLineController */
/* @var $model PosOrderLine */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pos-order-line-form',
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
		<?php echo $form->labelEx($model,'notice'); ?>
		<?php echo $form->textField($model,'notice',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'notice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_id'); ?>
		<?php echo $form->textField($model,'order_id'); ?>
		<?php echo $form->error($model,'order_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_unit'); ?>
		<?php echo $form->textField($model,'price_unit'); ?>
		<?php echo $form->error($model,'price_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_subtotal'); ?>
		<?php echo $form->textField($model,'price_subtotal'); ?>
		<?php echo $form->error($model,'price_subtotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_subtotal_incl'); ?>
		<?php echo $form->textField($model,'price_subtotal_incl'); ?>
		<?php echo $form->error($model,'price_subtotal_incl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qty'); ?>
		<?php echo $form->textField($model,'qty'); ?>
		<?php echo $form->error($model,'qty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discount'); ?>
		<?php echo $form->textField($model,'discount'); ?>
		<?php echo $form->error($model,'discount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->