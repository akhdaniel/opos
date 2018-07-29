<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('list_price')); ?>:</b>
	<?php echo CHtml::encode($data->list_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default_code')); ?>:</b>
	<?php echo CHtml::encode($data->default_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ean13')); ?>:</b>
	<?php echo CHtml::encode($data->ean13); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oe_id')); ?>:</b>
	<?php echo CHtml::encode($data->oe_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />


</div>