<?php
/* @var $this PosOrderController */
/* @var $data PosOrder */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_journal')); ?>:</b>
	<?php echo CHtml::encode($data->sale_journal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pos_reference')); ?>:</b>
	<?php echo CHtml::encode($data->pos_reference); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('account_move')); ?>:</b>
	<?php echo CHtml::encode($data->account_move); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_order')); ?>:</b>
	<?php echo CHtml::encode($data->date_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partner_id')); ?>:</b>
	<?php echo CHtml::encode($data->partner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nb_print')); ?>:</b>
	<?php echo CHtml::encode($data->nb_print); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_id')); ?>:</b>
	<?php echo CHtml::encode($data->session_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_id')); ?>:</b>
	<?php echo CHtml::encode($data->shop_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pricelist_id')); ?>:</b>
	<?php echo CHtml::encode($data->pricelist_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picking_id')); ?>:</b>
	<?php echo CHtml::encode($data->picking_id); ?>
	<br />

	*/ ?>

</div>