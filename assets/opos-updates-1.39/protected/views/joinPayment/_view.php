<?php
/* @var $this JoinPaymentController */
/* @var $data JoinPayment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('join_number')); ?>:</b>
	<?php echo CHtml::encode($data->join_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('join_date')); ?>:</b>
	<?php echo CHtml::encode($data->join_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_paid')); ?>:</b>
	<?php echo CHtml::encode($data->total_paid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_change')); ?>:</b>
	<?php echo CHtml::encode($data->total_change); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salesman_id')); ?>:</b>
	<?php echo CHtml::encode($data->salesman_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('session_id')); ?>:</b>
	<?php echo CHtml::encode($data->session_id); ?>
	<br />

	*/ ?>

</div>