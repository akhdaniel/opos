<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oe_id')); ?>:</b>
	<?php echo CHtml::encode($data->oe_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oe_debit_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->oe_debit_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oe_credit_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->oe_credit_account_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sorting')); ?>:</b>
	<?php echo CHtml::encode($data->sorting); ?>
	<br />

	*/ ?>

</div>