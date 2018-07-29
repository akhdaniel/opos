<?php
	if($data->status == 1){
?>
	<li onclick="insertOrder('<?php echo $data->id?>');return false;">
		<a href="#">
			<span id="product_name"><?php echo CHtml::encode($data->name); ?></span><br/>
			<span id="product_price"><?php echo CHtml::encode($data->list_price); ?></span>
		</a>
	</li>	
<?php
	}else{
?>
	<li class="stock_none" onclick="return false;">
		<a href="#">
			<span id="product_name"><?php echo CHtml::encode($data->name); ?></span><br/>
			<span id="product_price"><?php echo CHtml::encode($data->list_price); ?></span>
		</a>
	</li>
<?php
	}
?>

