<?php
/* @var $this SaleShopController */
/* @var $model SaleShop */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sale-shop-form',
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
		<?php echo $form->labelEx($model,'pricelist_id'); ?>
		<?php echo $form->textField($model,'pricelist_id'); ?>
		<?php echo $form->error($model,'pricelist_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_id'); ?>
		<?php echo $form->textField($model,'project_id'); ?>
		<?php echo $form->error($model,'project_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_default_id'); ?>
		<?php echo $form->textField($model,'payment_default_id'); ?>
		<?php echo $form->error($model,'payment_default_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'warehouse_id'); ?>
		<?php echo $form->textField($model,'warehouse_id'); ?>
		<?php echo $form->error($model,'warehouse_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->