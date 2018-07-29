<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id'); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'partner_id'); ?>
		<?php echo $form->textField($model,'partner_id'); ?>
		<?php echo $form->error($model,'partner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency_id'); ?>
		<?php echo $form->textField($model,'currency_id'); ?>
		<?php echo $form->error($model,'currency_id'); ?>
	</div>

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
		<?php echo $form->labelEx($model,'rml_footer'); ?>
		<?php echo $form->textArea($model,'rml_footer',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'rml_footer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rml_header'); ?>
		<?php echo $form->textArea($model,'rml_header',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'rml_header'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paper_format'); ?>
		<?php echo $form->textField($model,'paper_format'); ?>
		<?php echo $form->error($model,'paper_format'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo_web'); ?>
		<?php echo $form->textField($model,'logo_web'); ?>
		<?php echo $form->error($model,'logo_web'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rml_header2'); ?>
		<?php echo $form->textArea($model,'rml_header2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'rml_header2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rml_header3'); ?>
		<?php echo $form->textArea($model,'rml_header3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'rml_header3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rml_header1'); ?>
		<?php echo $form->textField($model,'rml_header1',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'rml_header1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_no'); ?>
		<?php echo $form->textField($model,'account_no',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'account_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_registry'); ?>
		<?php echo $form->textField($model,'company_registry',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'company_registry'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'custom_footer'); ?>
		<?php echo $form->checkBox($model,'custom_footer'); ?>
		<?php echo $form->error($model,'custom_footer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expects_chart_of_accounts'); ?>
		<?php echo $form->checkBox($model,'expects_chart_of_accounts'); ?>
		<?php echo $form->error($model,'expects_chart_of_accounts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paypal_account'); ?>
		<?php echo $form->textField($model,'paypal_account',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'paypal_account'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'overdue_msg'); ?>
		<?php echo $form->textArea($model,'overdue_msg',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'overdue_msg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tax_calculation_rounding_method'); ?>
		<?php echo $form->textField($model,'tax_calculation_rounding_method'); ?>
		<?php echo $form->error($model,'tax_calculation_rounding_method'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expense_currency_exchange_account_id'); ?>
		<?php echo $form->textField($model,'expense_currency_exchange_account_id'); ?>
		<?php echo $form->error($model,'expense_currency_exchange_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'income_currency_exchange_account_id'); ?>
		<?php echo $form->textField($model,'income_currency_exchange_account_id'); ?>
		<?php echo $form->error($model,'income_currency_exchange_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'schedule_range'); ?>
		<?php echo $form->textField($model,'schedule_range'); ?>
		<?php echo $form->error($model,'schedule_range'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'po_lead'); ?>
		<?php echo $form->textField($model,'po_lead'); ?>
		<?php echo $form->error($model,'po_lead'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'security_lead'); ?>
		<?php echo $form->textField($model,'security_lead'); ?>
		<?php echo $form->error($model,'security_lead'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manufacturing_lead'); ?>
		<?php echo $form->textField($model,'manufacturing_lead'); ?>
		<?php echo $form->error($model,'manufacturing_lead'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->