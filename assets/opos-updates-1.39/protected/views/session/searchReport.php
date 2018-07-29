<h1>Search <?php echo $title;?></h1>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'session-form',
	'enableAjaxValidation'=>false,
    'method'=>'get',
)); ?>

	<?php echo $form->labelEx($model,'start_date'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
        array(
            'model'=>$model,
            'attribute'=>'start_date',
            'language' => 'en-GB',
            'options'=>array(
                'dateFormat'=>'yy-mm-dd ',
                'showAnim'=>'drop',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                'changeMonth'=>true,
                'changeYear'=>true,
                'method'=>'get',

            ),
        	'htmlOptions'=>array('style'=>'height:25px;','id'=>'start_date','value'=>date('Y-m-01'),'class'=>'form-control'),
    ));?>
	
	<?php echo $form->labelEx($model,'end_date'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
        array(
            'model'=>$model,
            'attribute'=>'end_date',
            'language' => 'en-GB',
            'options'=>array(
                'dateFormat'=>'yy-mm-dd ',
                'showAnim'=>'drop',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                'changeMonth'=>true,
                'changeYear'=>true,
                'method'=>'get',
            ),
       		'htmlOptions'=>array('style'=>'height:25px;','id'=>'end_date','value'=>date('Y-m-t'),'class'=>'form-control'),
    ));?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search Report',
		)); ?>
	</div>
<?php $this->endWidget(); ?>