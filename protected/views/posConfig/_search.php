<?php
/* @var $this PosConfigController */
/* @var $model PosConfig */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_uid'); ?>
		<?php echo $form->textField($model,'create_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'write_date'); ?>
		<?php echo $form->textField($model,'write_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'write_uid'); ?>
		<?php echo $form->textField($model,'write_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iface_vkeyboard'); ?>
		<?php echo $form->checkBox($model,'iface_vkeyboard'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iface_cashdrawer'); ?>
		<?php echo $form->checkBox($model,'iface_cashdrawer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'journal_id'); ?>
		<?php echo $form->textField($model,'journal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iface_self_checkout'); ?>
		<?php echo $form->checkBox($model,'iface_self_checkout'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iface_electronic_scale'); ?>
		<?php echo $form->checkBox($model,'iface_electronic_scale'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shop_id'); ?>
		<?php echo $form->textField($model,'shop_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'group_by'); ?>
		<?php echo $form->checkBox($model,'group_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iface_payment_terminal'); ?>
		<?php echo $form->checkBox($model,'iface_payment_terminal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sequence_id'); ?>
		<?php echo $form->textField($model,'sequence_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iface_print_via_proxy'); ?>
		<?php echo $form->checkBox($model,'iface_print_via_proxy'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->