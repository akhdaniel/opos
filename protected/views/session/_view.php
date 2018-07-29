<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('open_date')); ?>:</b>
	<?php echo CHtml::encode($data->open_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('close_date')); ?>:</b>
	<?php echo CHtml::encode($data->close_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_sales')); ?>:</b>
	<?php echo CHtml::encode($data->total_sales); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_drawer')); ?>:</b>
	<?php echo CHtml::encode($data->total_drawer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('difference')); ?>:</b>
	<?php echo CHtml::encode($data->difference); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oe_id')); ?>:</b>
	<?php echo CHtml::encode($data->oe_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	*/ ?>

</div>