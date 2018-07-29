<?php echo $shop_name ?>

Order per Payment Report
Session <?php echo $session->name ?>
		
<?php 
$total=0;
$n=1;
$old_row='';
?>

<?php echo sprintf("%-3s","No")?><?php echo sprintf("%-17s","Payment Type")?><?php echo sprintf("%20s","Number/ Amount") ?>

----------------------------------------
<?php foreach($payments as $i=>$row):?>
<?php if( $old_row != $row['name'] && $i!=0) : ?>

<?php echo sprintf("%20s",'Total '.$old_row) ?>
<?php echo sprintf("%20s",number_format($total,2)) ?>

<?php $n=1 ; $total = 0?>

<?php endif; ?>
<?php echo sprintf("%-3s",$n) ?><?php echo sprintf("%-17s",$row['name']) ?><?php echo sprintf("%-20s",$row['notes']) ?>

<?php echo sprintf("%40s",number_format($row['amount'],2)) ?>

<?php 
	$total   += $row['amount'];
	$old_row  = $row['name'];
	$n++;
?>
<?php endforeach;?>

<?php echo sprintf("%20s",'Total '.$old_row) ?>
<?php echo sprintf("%20s",number_format($total,2)) ?>

----------------------------------------

<?php echo sprintf("%-20s","Total Non Discount")?><?php echo sprintf("%20s",number_format($session->totalListPrice,2)) ?>

<?php echo sprintf("%-20s","Total Discount")?><?php echo sprintf("%20s",number_format($session->totalDiscount,2)) ?>

<?php echo sprintf("%-20s","Total Sales Non PPN")?><?php echo sprintf("%20s",number_format($session->total,2)) ?>

<?php echo sprintf("%-20s","Total Sales PPN")?><?php echo sprintf("%20s",number_format($session->totalppn,2)) ?>










