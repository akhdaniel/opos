<?php
/* @var $this PosSessionController */
/* @var $model PosSession */
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
		<?php echo $form->label($model,'config_id'); ?>
		<?php echo $form->textField($model,'config_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cash_journal_id'); ?>
		<?php echo $form->textField($model,'cash_journal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_at'); ?>
		<?php echo $form->textField($model,'start_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cash_register_id'); ?>
		<?php echo $form->textField($model,'cash_register_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stop_at'); ?>
		<?php echo $form->textField($model,'stop_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->