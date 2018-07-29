<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_payment_id')); ?>:</b>
	<?php echo CHtml::encode($data->session_payment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_opening')); ?>:</b>
	<?php echo CHtml::encode($data->number_opening); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_closing')); ?>:</b>
	<?php echo CHtml::encode($data->number_closing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pieces')); ?>:</b>
	<?php echo CHtml::encode($data->pieces); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oe_id')); ?>:</b>
	<?php echo CHtml::encode($data->oe_id); ?>
	<br />


</div>