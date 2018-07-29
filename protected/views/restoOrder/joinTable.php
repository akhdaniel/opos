<?php
	$this->breadcrumbs=array(
		'Orders'=>array('index'),
		'Join Table',
	);
?>

<h1>Join Table</h1>

<form action="<?php echo Yii::app()->createUrl('//restoOrder/joinTable') ?>" method="post" class="form-vertical">
	<div class="row">
		<div class="span2">
			<label><b>Select table want to join</b></label>
		</div>

		<div class="span8">
			<select name="Order[source][]" size="3" multiple="multiple" tabindex="1">
				<option value="empty">- Select source table -</option>
		        <?php 
		        	foreach($model as $m){
		        ?>
		        	<option value="<?php echo $m->id?>"><?php echo $m->table->table_name;?></option>
		        <?php		
		        	}
		        ?>
	      </select>
		</div>
     </div>

     <div class="row">
		<div class="span2">
			<label><b>Select destination table</b></label>
		</div>

		<div class="span8">
			<select name="Order[destination]">
				<option value="empty">- Select destination table -</option>
		        <?php 
		        	foreach($model as $m){
		        ?>
		        	<option value="<?php echo $m->id?>"><?php echo $m->table->table_name;?></option>
		        <?php		
		        	}
		        ?>
	      </select>
		</div>
     </div>

     <div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Procces',
		)); ?>
	</div>
</form>