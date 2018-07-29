<?php echo $shop_name ?>


Summary per Category Report
Session <?php echo $session->name ?>

<?php $total=0 ?>

		
<?php echo sprintf("%-20s","Category")?><?php echo sprintf("%20s","Total") ?>

----------------------------------------
<?php foreach($rows as $row):?>
<?php echo sprintf("%-40s",$row['category']) ?>

<?php echo sprintf("%40s",number_format($row['s'],2)) ?>

<?php $total += $row['s'] ; ?>
<?php endforeach;?>
----------------------------------------
<?php echo sprintf("%-20s","Total Sales Non PPN")?><?php echo sprintf("%20s",number_format($session->total,2)) ?>
<?php echo sprintf("%-20s","Total Sales PPN")?><?php echo sprintf("%20s",number_format($session->totalppn,2)) ?>

<?php echo sprintf("%-20s","Total Non Discount")?><?php echo sprintf("%20s",number_format($session->totalListPrice,2)) ?>

<?php echo sprintf("%-20s","Total Discount")?><?php echo sprintf("%20s",number_format($session->totalDiscount,2)) ?>



<?php echo sprintf("%-20s","Total Cash Sales")?><?php echo sprintf("%20s",number_format($session->totalCash,2)) ?>

<?php echo sprintf("%-20s","Opening Cash")?><?php echo sprintf("%20s",number_format($session->totalCashOpening,2)) ?>

<?php echo sprintf("%-20s","Total Cash Drawer")?><?php echo sprintf("%20s",number_format($session->total_drawer,2)) ?>

<?php echo sprintf("%-20s","Difference")?><?php echo sprintf("%20s",number_format($session->difference,2)) ?>



<?php $total=0 ?>
Payments

<?php echo sprintf("%-20s","Payment Type")?><?php echo sprintf("%20s","Total") ?>

----------------------------------------
<?php foreach($payments as $row):?>
<?php echo sprintf("%-40s",$row['name']) ?>

<?php echo sprintf("%40s",number_format($row['s'],2)) ?>

<?php $total += $row['s'] ; ?>
<?php endforeach;?>
----------------------------------------
<?php echo sprintf("%-20s","Total")?><?php echo sprintf("%20s",number_format($total,2)) ?>











