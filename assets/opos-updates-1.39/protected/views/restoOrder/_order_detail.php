<form action="#" method="post" id="order-list-form">
	<input type="hidden" name="Od[destination_table]" value="<?php echo $destination;?>">
	<div class="pull-right">
		<a href="#" class="btn btn-primary proccess"> Proccess split</a>
	</div>
	<br/>

	<?php
		$this->widget('zii.widgets.grid.CGridView', array(
	    'id' => 'order-list-grid',
	    'dataProvider' => $od,
	    'itemsCssClass'=>'table table-striped units',
	    'summaryText'=>'',
	    'columns'=>array(
	    	array('id'=>'Od[orderdetailIds]','class'=>'CCheckBoxColumn','selectableRows'=>2,'value'=> '$data->id'),
	    	array('header'=>'No', 'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'),
			array('header'=>'Product Name', 'value'=>'$data->product->name'),
			array('header'=>'Qty', 'value'=>'$data->qty'),
			array('header'=>'Unit Price', 'value'=>'$data->unit_price'),
			array('header'=>'Amount', 'value'=>'$data->amount'),
		),
	));
	?>

	<div class="pull-right">
		<a href="#" class="btn btn-primary proccess"> Proccess split</a>
	</div>
</form>

<script>
	$(document).ready(function() { 
	    $('.proccess').click(function(e) {
	    	e.preventDefault();
	        $('#order-list-form').submit();
	    });
	});
</script>