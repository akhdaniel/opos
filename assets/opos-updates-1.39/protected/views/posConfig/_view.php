<?php
/* @var $this PosConfigController */
/* @var $data PosConfig */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_uid')); ?>:</b>
	<?php echo CHtml::encode($data->create_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('write_date')); ?>:</b>
	<?php echo CHtml::encode($data->write_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('write_uid')); ?>:</b>
	<?php echo CHtml::encode($data->write_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iface_vkeyboard')); ?>:</b>
	<?php echo CHtml::encode($data->iface_vkeyboard); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iface_cashdrawer')); ?>:</b>
	<?php echo CHtml::encode($data->iface_cashdrawer); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('journal_id')); ?>:</b>
	<?php echo CHtml::encode($data->journal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iface_self_checkout')); ?>:</b>
	<?php echo CHtml::encode($data->iface_self_checkout); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iface_electronic_scale')); ?>:</b>
	<?php echo CHtml::encode($data->iface_electronic_scale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_id')); ?>:</b>
	<?php echo CHtml::encode($data->shop_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_by')); ?>:</b>
	<?php echo CHtml::encode($data->group_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iface_payment_terminal')); ?>:</b>
	<?php echo CHtml::encode($data->iface_payment_terminal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sequence_id')); ?>:</b>
	<?php echo CHtml::encode($data->sequence_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iface_print_via_proxy')); ?>:</b>
	<?php echo CHtml::encode($data->iface_print_via_proxy); ?>
	<br />

	*/ ?>

</div>