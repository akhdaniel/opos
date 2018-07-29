<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_id')); ?>:</b>
	<?php echo CHtml::encode($data->session_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->payment_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oe_statement_id')); ?>:</b>
	<?php echo CHtml::encode($data->oe_statement_id); ?>
	<br />


</div>