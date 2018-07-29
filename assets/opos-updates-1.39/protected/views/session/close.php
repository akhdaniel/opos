<?php
$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Close Session <?php echo $model->name; ?></h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'session-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'open_date',array('class'=>'span5', 'readonly'=>true)); ?>
	<?php echo $form->textFieldRow($model,'close_date',array('class'=>'span5', 'readonly'=>true)); ?>
	<?php echo $form->textFieldRow($model,'total_drawer',array('class'=>'span5')); ?>

	<?php echo $form->hiddenField($model,'user_id',array('class'=>'span5', 'readonly'=>true)); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>


<script>
$('#Session_total_drawer').autoNumeric('init');

</script>

<?php
cs()->registerScriptFile(bu() . '/js/numeral/numeral.js');    
cs()->registerScriptFile(bu() . '/js/autoNumeric/autoNumeric.js');    
?>