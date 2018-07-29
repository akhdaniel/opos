<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('buy_qty')); ?>:</b>
	<?php echo CHtml::encode($data->buy_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gift_product_id')); ?>:</b>
	<?php echo CHtml::encode($data->gift_product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('get_qty')); ?>:</b>
	<?php echo CHtml::encode($data->get_qty); ?>
	<br />


</div>