<h1>Summary per Category Report: from <?php echo $start;?> to <?php echo $end;?></h1>
<?php $total=0 ?>
<table width="50%" class="table stripped">
<tr>
	<th>
		Category
	</th>
	<th style="text-align:right" >
		Total
	</th>
</tr>

<?php foreach($rows as $row):?>
<tr>
	<td>
		<?php echo $row['category'] ?>
	</td>
	<td style="text-align:right" >
		<span ><?php echo number_format($row['s'],2) ?></span>
	</td>
</tr>
<?php $total += $row['s'] ; ?>
<?php endforeach;?>

<tr>

	<th style="text-align:right" >
		Total Sales
	</th>
	<th style="text-align:right" >
		<?php echo number_format($total,2) ?>
	</th>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr>

	<th style="text-align:right" >
		Total Sales Non Discount
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->getTotalListPrice($start, $end) ,2) ?>
	</th>
</tr>
<tr>

	<th style="text-align:right" >
		Total Discount
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->getTotalDiscount($start, $end) ,2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Total Sales Non PPN
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->getTotal($start, $end),2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Total Sales PPN
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->getTotalppn($start, $end),2) ?>
	</th>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr>

	<th style="text-align:right" >
		Total Cash Sales
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->getTotalCash($start, $end),2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Opening Cash
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->getTotalCashOpening($start, $end),2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Total Cash Drawer
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session['tdrawer'],2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Difference
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session['tdifference'],2) ?>
	</th>
</tr>

</table>



<h1>Payment</h1>
<?php $total=0 ?>
<table width="50%" class="table stripped">
<tr>
	<th>
		Payment Type
	</th>
	<th style="text-align:right" >
		Total
	</th>
</tr>

<?php foreach($payments as $row):?>
<tr>
	<td>
		<?php echo $row['name'] ?>
	</td>
	<td style="text-align:right" >
		<span ><?php echo number_format($row['s'],2) ?></span>
	</td>
</tr>
<?php $total += $row['s'] ; ?>
<?php endforeach;?>



<tr>

	<th style="text-align:right" >
		Total
	</th>
	<th style="text-align:right" >
		<?php echo number_format($total,2) ?>
	</th>
</tr>
</table>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Print Report',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>bu('/session/reportCategory/?Session[start_date]='.$_GET['Session']['start_date'] .'&Session[end_date]='.$_GET['Session']['end_date'].'&print=true'),
    'htmlOptions'=>array(
        'id'=>'printButton'
    ),
)); ?>