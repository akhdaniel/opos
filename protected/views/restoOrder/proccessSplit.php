<h1>Split Table</h1>

<table class="table">
	<tbody>
		<tr>
			<th style="width:20%;">Source Table</th>
			<td><?php echo $order->table->table_name;?></td>
		</tr>
		<tr>
			<th>Destination Table</th>
			<td><?php echo $destination->table_name;?></td>
		</tr>
	</tbody>
</table>

<hr/>
<?php $this->widget("bootstrap.widgets.TbTabs", array(
    "type" => "tabs",
    "tabs" => array(
        array("label" => "Order List", "content" => $this->renderPartial('_order_detail', array('od'=>$orderDetailModel, 'destination'=>$destination->id),true), "active" => true),
    ),
 
)); ?>