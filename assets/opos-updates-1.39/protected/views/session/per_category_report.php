<h1>Summary per Category Report: Session <?php echo $session->name ?></h1>
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
		<?php echo number_format($session->totalListPrice,2) ?>
	</th>
</tr>
<tr>

	<th style="text-align:right" >
		Total Discount
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->totalDiscount ,2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Total Sales Non PPN
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->total,2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Total Sales PPN
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->totalppn,2) ?>
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
		<?php echo number_format($session->totalCash,2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Opening Cash
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->totalCashOpening,2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Total Cash Drawer
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->total_drawer,2) ?>
	</th>
</tr>

<tr>

	<th style="text-align:right" >
		Difference
	</th>
	<th style="text-align:right" >
		<?php echo number_format($session->difference,2) ?>
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
    'url'=>bu('/session/summaryPerCategoryReport/'.$session->id.'?print=true'),
    'htmlOptions'=>array(
        'id'=>'printButton'
    ),
)); ?>