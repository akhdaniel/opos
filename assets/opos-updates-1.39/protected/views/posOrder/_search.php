<?php
/* @var $this PosOrderController */
/* @var $model PosOrder */
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
		<?php echo $form->label($model,'sale_journal'); ?>
		<?php echo $form->textField($model,'sale_journal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pos_reference'); ?>
		<?php echo $form->textField($model,'pos_reference',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_move'); ?>
		<?php echo $form->textField($model,'account_move'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_order'); ?>
		<?php echo $form->textField($model,'date_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'partner_id'); ?>
		<?php echo $form->textField($model,'partner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nb_print'); ?>
		<?php echo $form->textField($model,'nb_print'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_id'); ?>
		<?php echo $form->textField($model,'invoice_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'session_id'); ?>
		<?php echo $form->textField($model,'session_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shop_id'); ?>
		<?php echo $form->textField($model,'shop_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pricelist_id'); ?>
		<?php echo $form->textField($model,'pricelist_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'picking_id'); ?>
		<?php echo $form->textField($model,'picking_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->