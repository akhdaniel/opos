<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'partner_id'); ?>
		<?php echo $form->textField($model,'partner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency_id'); ?>
		<?php echo $form->textField($model,'currency_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_uid'); ?>
		<?php echo $form->textField($model,'create_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'write_date'); ?>
		<?php echo $form->textField($model,'write_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'write_uid'); ?>
		<?php echo $form->textField($model,'write_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rml_footer'); ?>
		<?php echo $form->textArea($model,'rml_footer',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rml_header'); ?>
		<?php echo $form->textArea($model,'rml_header',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paper_format'); ?>
		<?php echo $form->textField($model,'paper_format'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'logo_web'); ?>
		<?php echo $form->textField($model,'logo_web'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rml_header2'); ?>
		<?php echo $form->textArea($model,'rml_header2',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rml_header3'); ?>
		<?php echo $form->textArea($model,'rml_header3',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rml_header1'); ?>
		<?php echo $form->textField($model,'rml_header1',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_no'); ?>
		<?php echo $form->textField($model,'account_no',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_registry'); ?>
		<?php echo $form->textField($model,'company_registry',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'custom_footer'); ?>
		<?php echo $form->checkBox($model,'custom_footer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expects_chart_of_accounts'); ?>
		<?php echo $form->checkBox($model,'expects_chart_of_accounts'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paypal_account'); ?>
		<?php echo $form->textField($model,'paypal_account',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'overdue_msg'); ?>
		<?php echo $form->textArea($model,'overdue_msg',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tax_calculation_rounding_method'); ?>
		<?php echo $form->textField($model,'tax_calculation_rounding_method'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expense_currency_exchange_account_id'); ?>
		<?php echo $form->textField($model,'expense_currency_exchange_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'income_currency_exchange_account_id'); ?>
		<?php echo $form->textField($model,'income_currency_exchange_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'schedule_range'); ?>
		<?php echo $form->textField($model,'schedule_range'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'po_lead'); ?>
		<?php echo $form->textField($model,'po_lead'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'security_lead'); ?>
		<?php echo $form->textField($model,'security_lead'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'manufacturing_lead'); ?>
		<?php echo $form->textField($model,'manufacturing_lead'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->