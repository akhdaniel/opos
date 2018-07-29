<?php
$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Session','url'=>array('index')),
	array('label'=>'View Session','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Closing Control Session <?php echo $model->name; ?></h1>

<form action="<?php echo bu('/session/closeCashbox')?>" method="POST" id="cashform">
<?php echo CHtml::hiddenField('session_payment_id', $casboxLines[0]['session_payment_id'])?>
<?php echo CHtml::hiddenField('session_id', $model->id)?>
<table class="table table-condensed table-striped">
	<tr><th>Pieces</th><th>Number</th><th>Amount</th></tr>
<?php foreach($casboxLines as $i=>$cb):?>
	<tr>
		<td><input type="text" class="cash-control" 
			id="pieces_<?php echo $cb['id']?>" 
			value="<?php echo $cb['pieces'] ?>" 
			readonly="true" disabled="true"/> 
		</td>
		<td><input type="text" class="cash-control" 
            data-index="<?php echo $i?>"			
			id="number_<?php echo $cb['id']?>" 
			onblur="calculateCash(<?php echo $cb['id']?>)" 
			name="number_closings[<?php echo $cb['id'] ?>]" 
			value="<?php echo $cb['number_closing'] ?>" />
		</td>
		<td><input type="text" class="cash-control amount" 
			id="amount_<?php echo $cb['id']?>"readonly="true" 
			disabled="true"/>
		</td>
	</tr>
<?php endforeach;?>
	<tr><th></th><th>TOTAL</th><th><input type="text" id="total" class="cash-control" readonly="true" /></th></tr>
</table>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'type'=>'primary',
		'label'=>'Continue',
        'htmlOptions'=>array(
        	'data-index'=>$i+1,
        	'id'=>'confirmClose'
	))); ?>
</div>
</form>

<?php $this->renderPartial('//order/_progress', array() ); ?>


<?php
cs()->registerScriptFile(bu() . '/js/numeral/numeral.js');    
cs()->registerScriptFile(bu() . '/js/autoNumeric/autoNumeric.js');    
cs()->registerScriptFile(bu() . '/js/cashControl.js');   
cs()->registerScript('init',"
$('.cash-control').autoNumeric('init');
$('[data-index=0]').focus().select();

$('.cash-control').blur(function(){
		if (this.value==''){
			this.value='0.00';
		}
});


$('.cash-control').keyup(function(event){
    if(event.keyCode == 13){
        event.preventDefault();
		if (this.value==''){
			this.value='0.00';
		}

        var \$this = \$(event.target);
        var index = parseFloat(\$this.attr('data-index'));
        \$('[data-index=\"' + (index + 1).toString() + '\"]').focus().select();

        return false;
    }	
});

$('#confirmClose').click(function(){
	if (confirm(\"Confirm Close Session?\")){
		\$('#modalProgress').modal('show');
		\$('#cashform').submit();
	}
	return false;
});
"); 
?>