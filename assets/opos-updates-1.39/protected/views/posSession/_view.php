<?php
/* @var $this PosSessionController */
/* @var $data PosSession */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('config_id')); ?>:</b>
	<?php echo CHtml::encode($data->config_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cash_journal_id')); ?>:</b>
	<?php echo CHtml::encode($data->cash_journal_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('start_at')); ?>:</b>
	<?php echo CHtml::encode($data->start_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cash_register_id')); ?>:</b>
	<?php echo CHtml::encode($data->cash_register_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stop_at')); ?>:</b>
	<?php echo CHtml::encode($data->stop_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	*/ ?>

</div>