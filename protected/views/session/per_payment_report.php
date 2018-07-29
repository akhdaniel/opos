<h1>Order per Payment Report: 
<?php if ($session): ?>
	Session <?php echo $session->name ?>
<?php else:?>
	From <?php echo $start_date?> to <?php echo $end_date?>
<?php endif;?>
</h1>


<?php $total=0 ?>


<table width="50%" class="table stripped">

	<?php $total=0 ?>
	<table width="50%" class="table stripped">
	<tr>
		<th>
			No
		</th>
		<th>
			Payment Type
		</th>
		<th>
			Order No
		</th>
		<th style="text-align:right" >
			Amount
		</th>
	</tr>

	<?php $old_row=''; $n=1; ?>
	<?php foreach($payments[0] as $i=>$row):?>

		<?php if( $old_row != $row['name'] && $i!=0) : ?>
			<tr>
				<td colspan="3" style="text-align:right">
					<b>Total <?php echo $old_row ?></b>
				</td>
				<td style="text-align:right" >
					<span><b><?php echo number_format($total,2) ?></b></span>
				</td>

			</tr>
			<?php $n=1 ; $total = 0?>
		<?php endif; ?>

		<tr>
			<td>
				<?php echo $n ?>
			</td>
			<td>
				<?php echo $row['name'] ?>
			</td>
			<td>
				<?php echo $row['number'] ?>
				<?php echo $row['notes'] ?>
			</td>
			<td style="text-align:right" >
				<span ><?php echo number_format($row['amount'],2) ?></span>
			</td>
		</tr>

		<?php 
			$total   += $row['amount'];
			$old_row  = $row['name'];
			$n++;
		?>
	<?php endforeach;?>
	<tr>
		<td colspan="3" style="text-align:right">
			<b>Total <?php echo $old_row ?></b>
		</td>
		<td style="text-align:right" >
			<span><b><?php echo number_format($total,2) ?></b></span>
		</td>

	</tr>

	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>

	<?php $total=0 ?>
	<table width="50%" class="table stripped">
	<tr>
		<th>
			No
		</th>
		<th>
			Payment Type
		</th>
		<th>
			Join Payment No
		</th>
		<th style="text-align:right" >
			Amount
		</th>
	</tr>

	<?php $old_row=''; $n=1; ?>
	<?php foreach($payments[1] as $i=>$row):?>

		<?php if( $old_row != $row['name'] && $i!=0) : ?>
			<tr>
				<td colspan="3" style="text-align:right">
					<b>Total <?php echo $old_row ?></b>
				</td>
				<td style="text-align:right" >
					<span><b><?php echo number_format($total,2) ?></b></span>
				</td>

			</tr>
			<?php $n=1 ; $total = 0?>
		<?php endif; ?>

		<tr>
			<td>
				<?php echo $n ?>
			</td>
			<td>
				<?php echo $row['name'] ?>
			</td>
			<td>
				<?php echo $row['join_number'] ?>
			</td>
			<td style="text-align:right" >
				<span ><?php echo number_format($row['amount'],2) ?></span>
			</td>
		</tr>

		<?php 
			$total   += $row['amount'];
			$old_row  = $row['name'];
			$n++;
		?>
	<?php endforeach;?>
	<tr>
		<td colspan="3" style="text-align:right">
			<b>Total <?php echo $old_row ?></b>
		</td>
		<td style="text-align:right" >
			<span><b><?php echo number_format($total,2) ?></b></span>
		</td>

	</tr>

	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>

	<tr>
		<th></th>
		<th></th>
		<th style="text-align:right" >
			Total Sales Non Discount
		</th>
		<th style="text-align:right" >
			<?php echo number_format($session->totalListPrice,2) ?>
		</th>
	</tr>
	<tr>
		<th></th>
		<th></th>
		<th style="text-align:right" >
			Total Discount
		</th>
		<th style="text-align:right" >
			<?php echo number_format($session->totalDiscount ,2) ?>
		</th>
	</tr>

	<tr>
		<th></th>
		<th></th>
		<th style="text-align:right" >
			Total Discount Special
		</th>
		<th style="text-align:right" >
			<?php echo number_format($session->totalDiscountSpecial ,2) ?>
		</th>
	</tr>

	<tr>
		<th></th>
		<th></th>
		<th style="text-align:right" >
			Total Sales Non PPN
		</th>
		<th style="text-align:right" >
			<?php echo number_format($session->total,2) ?>
		</th>
	</tr>

	<tr>
		<th></th>
		<th></th>
		<th style="text-align:right" >
			Total Sales PPN
		</th>
		<th style="text-align:right" >
			<?php echo number_format($session->totalppn,2) ?>
		</th>
	</tr>

</table>





<?php 
if($session)
{
	$print_url = bu('/session/orderPerPaymentReport?id='.$session->id.'&print=true');
}	
else{
	$print_url = bu('/session/orderPerPaymentReport?start_date='.$start_date.'&end_date='.$end_date.'&print=true');	
}

$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Print Report',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>$print_url,
    'htmlOptions'=>array(
        'id'=>'printButton'
    ),
)); ?>
