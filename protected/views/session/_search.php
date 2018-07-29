<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'open_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'close_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'total_sales',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'total_drawer',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'difference',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'oe_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'state',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
