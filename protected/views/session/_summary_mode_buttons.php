
<?php if($model->state == SESSION_OPEN) : ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>'New Order',
		    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'large', // null, 'large', 'small' or 'mini'
		    'url'=>bu('/order/create')
		)); ?>

	    <?php $this->widget('bootstrap.widgets.TbButton', array(
	        'label'=>'Close Session ' . $model->name  ,
	        'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	        'size'=>'large', // null, 'large', 'small' or 'mini'
	        'htmlOptions'=>array('onclick'=>'return confirm("Close current session?")'),
	        //'url'=>bu('/session/close')
	        'url'=>bu('/session/closingControl/'.$model->id)
	    )); ?>	

<?php endif;?>

<?php if($model->state == SESSION_CLOSING_CONTROL) : ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Close Cashbox',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'large', // null, 'large', 'small' or 'mini'
	    'url'=>bu('/session/closingControl/' . $model->id)
	)); ?>
<?php endif;?>


<?php if($model->state == SESSION_CLOSED || $model->state == SESSION_POSTED) : ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Summary per Category',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'large', // null, 'large', 'small' or 'mini'
	    'url'=>bu('/session/summaryPerCategoryReport?id=' . $model->id)
	)); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Summary per Product',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'large', // null, 'large', 'small' or 'mini'
	    'url'=>bu('/session/summaryPerProductReport?id=' . $model->id)
	)); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Order per Payment',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'large', // null, 'large', 'small' or 'mini'
	    'url'=>bu('/session/orderPerPaymentReport?id=' . $model->id)
	)); ?>	
<?php endif;?>


<?php if (!$model->oe_id && $model->state == SESSION_CLOSED) : ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Post Session to OE',
	    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'large', // null, 'large', 'small' or 'mini'
	    'buttonType'=>'button',
	    'htmlOptions'=>array(
        	'id'=>'confirmClose'	    	
	    )
	)); ?>
<?php endif;?>


<?php if ($model->state == SESSION_POSTED) : ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'View Journal',
	    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'large', // null, 'large', 'small' or 'mini'
	    'buttonType'=>'link',
	    'url'=>bu('/journal/admin?session_id=' . $model->id . '&state=POSTED')

	)); ?>
<?php endif;?>