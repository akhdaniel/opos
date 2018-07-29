<?php
/* @var $this CompanyController */
/* @var $data Company */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partner_id')); ?>:</b>
	<?php echo CHtml::encode($data->partner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?>:</b>
	<?php echo CHtml::encode($data->currency_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_uid')); ?>:</b>
	<?php echo CHtml::encode($data->create_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('write_date')); ?>:</b>
	<?php echo CHtml::encode($data->write_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('write_uid')); ?>:</b>
	<?php echo CHtml::encode($data->write_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rml_footer')); ?>:</b>
	<?php echo CHtml::encode($data->rml_footer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rml_header')); ?>:</b>
	<?php echo CHtml::encode($data->rml_header); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paper_format')); ?>:</b>
	<?php echo CHtml::encode($data->paper_format); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo_web')); ?>:</b>
	<?php echo CHtml::encode($data->logo_web); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rml_header2')); ?>:</b>
	<?php echo CHtml::encode($data->rml_header2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rml_header3')); ?>:</b>
	<?php echo CHtml::encode($data->rml_header3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rml_header1')); ?>:</b>
	<?php echo CHtml::encode($data->rml_header1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_no')); ?>:</b>
	<?php echo CHtml::encode($data->account_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_registry')); ?>:</b>
	<?php echo CHtml::encode($data->company_registry); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('custom_footer')); ?>:</b>
	<?php echo CHtml::encode($data->custom_footer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expects_chart_of_accounts')); ?>:</b>
	<?php echo CHtml::encode($data->expects_chart_of_accounts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paypal_account')); ?>:</b>
	<?php echo CHtml::encode($data->paypal_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('overdue_msg')); ?>:</b>
	<?php echo CHtml::encode($data->overdue_msg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_calculation_rounding_method')); ?>:</b>
	<?php echo CHtml::encode($data->tax_calculation_rounding_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expense_currency_exchange_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->expense_currency_exchange_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('income_currency_exchange_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->income_currency_exchange_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('schedule_range')); ?>:</b>
	<?php echo CHtml::encode($data->schedule_range); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_lead')); ?>:</b>
	<?php echo CHtml::encode($data->po_lead); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('security_lead')); ?>:</b>
	<?php echo CHtml::encode($data->security_lead); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manufacturing_lead')); ?>:</b>
	<?php echo CHtml::encode($data->manufacturing_lead); ?>
	<br />

	*/ ?>

</div>