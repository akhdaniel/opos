<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>Activate Your Software</h1>

<h4>
<p>Please Enter your <b>Activation Key</b> here. We have sent it to your email, please also check on the <b>Spam folder</b> 
	if you can't find it.</p>
<p>Or <?php echo CHtml::link('Click Here',bu('regkey/default/regform')) ?> if you need us to resend your <b>Activation Key</b></p>
</h4>

<div class="form" style="margin:auto;margin-top:100px; width:300px">
<?php echo CHtml::form();?>

<div class="row">
<?php echo CHtml::label('Activation Key','act_key');?>
<?php echo CHtml::textField('act_key','', array('size'=>40));?>
</div>

<div class="row buttons">
<?php echo CHtml::submitButton('Save Activation Key'); ?>
</div>

<?php echo CHtml::endForm();?>

</div>