<?php
/* @var $this JoinPaymentPaymentController */
/* @var $data JoinPaymentPayment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('join_payment_id')); ?>:</b>
	<?php echo CHtml::encode($data->join_payment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->payment_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('card_no')); ?>:</b>
	<?php echo CHtml::encode($data->card_no); ?>
	<br />


</div>