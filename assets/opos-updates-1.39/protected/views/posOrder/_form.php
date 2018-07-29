<?php
/* @var $this PosOrderController */
/* @var $model PosOrder */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pos-order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'create_uid'); ?>
	<?php echo $form->hiddenField($model,'create_date'); ?>
	<?php echo $form->hiddenField($model,'write_date'); ?>
	<?php echo $form->hiddenField($model,'write_uid'); ?>
	<?php echo $form->hiddenField($model,'sale_journal'); ?>
	<?php echo $form->hiddenField($model,'account_move'); ?>
	<?php echo $form->hiddenField($model,'partner_id'); ?>
	<?php echo $form->hiddenField($model,'nb_print'); ?>
	<?php echo $form->hiddenField($model,'user_id'); ?>
	<?php echo $form->hiddenField($model,'invoice_id'); ?>
	<?php echo $form->hiddenField($model,'company_id'); ?>
	<?php echo $form->hiddenField($model,'session_id'); ?>
	<?php echo $form->hiddenField($model,'shop_id'); ?>
	<?php echo $form->hiddenField($model,'pricelist_id'); ?>
	<?php echo $form->hiddenField($model,'picking_id'); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'pos_reference'); ?>
		<?php echo $form->textField($model,'pos_reference',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'pos_reference'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_order'); ?>
		<?php echo $form->textField($model,'date_order'); ?>
		<?php echo $form->error($model,'date_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
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