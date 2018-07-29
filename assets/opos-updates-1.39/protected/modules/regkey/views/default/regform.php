<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>Register Your Software</h1>

<h4>
<p>Your software is not registered yet or Activation Key was Invalid or Inactive.</p>
<p>To Register, please enter your details here, including Receipt to get the Activation Key needed to activate this software.</p>
<p>Once submitted, the Activation Key will be sent to your email.</p>
</h4>
<br/>
<h4>
<p>OR you can enter your activation key in <?php echo CHtml::link('here',bu('regkey/default/actform')) ?>.</p>
</h4>

<div class="form" style="margin:auto;margin-top:70px; width:300px">
<?php echo CHtml::form();?>

<div class="row">
<?php echo CHtml::label('Order Receipt Number','cb_receipt');?>
<?php echo CHtml::textField('Registration[cb_receipt]',$this->cbReceipt?$this->cbReceipt:'your Order Receipt Number', array('size'=>40));?>
</div>

<div class="row">
<?php echo CHtml::label('Name','customer_name');?>
<?php echo CHtml::textField('Registration[customer_name]',$this->customerName?$this->customerName:'your name', array('size'=>40));?>
</div>

<div class="row">
<?php echo CHtml::label('Address','customer_address');?>
<?php echo CHtml::textarea('Registration[customer_address]',$this->customerAddress?$this->customerAddress:'your address', array('cols'=>40,'rows'=>4));?>
</div>

<div class="row">
<?php echo CHtml::label('Email','email');?>
<?php echo CHtml::textField('Registration[email]',$this->email?$this->email:'your@email', array('size'=>40));	?>
</div>
		
<div class="row buttons">
<?php echo CHtml::hiddenField('Registration[reg_key]', $this->regKey);?>
<?php echo CHtml::hiddenField('Registration[product_id]', $this->productId);?>
<?php echo CHtml::hiddenField('Registration[reg_date]', date("Y-m-d H:i:s"));?>
<?php echo CHtml::hiddenField('Registration[is_active]', 0);?>
<?php echo CHtml::hiddenField('Registration[return_url]', Yii::app()->request->getHostInfo() . Yii::app()->baseUrl. '/regkey/default/actForm');?>
<?php echo CHtml::submitButton('Submit Registration'); ?>
</div>


<?php echo CHtml::endForm();?>

</div>