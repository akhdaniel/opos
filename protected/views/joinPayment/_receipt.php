<?php echo $shop_name ?>


Number     : <?php echo $model->join_number ?>

Join Date  : <?php echo $model->join_date ?>

Kasir      : <?php echo Yii::app()->user->name ?>


<?php foreach($model->joinPaymentDetails as $jpd ) :?>
<?php if($pos_mode == 'retail') {?>
<?php echo $jpd->order->notes;?>
<?php }else{ ?>
<?php echo $jpd->order->table->table_name;?>
<?php } ?>
<?php foreach($jpd->order->orderDetails as $od ) :?>

<?php echo $od->product->name ?>

	<?php echo sprintf("%0.2f", number_format($od->qty,2) ) ?> x <?php echo sprintf("%7s",number_format($od->unit_price,0)) ?> = <?php echo sprintf("%10s",number_format($od->amount,0)) ?>
<?php endforeach; ?>

<?php echo sprintf("%15s","SUB TOTAL")?> : <?php echo sprintf("%17s",number_format($jpd->order->total_paid,0)) ?>


<?php endforeach; ?>
<?php echo sprintf("%15s","TOTAL")?> : <?php echo sprintf("%17s",number_format(($model->total_paid - $model->total_change),0)) ?>


<?php foreach($model->joinPaymentPayments as $jpp ) :?>
<?php echo sprintf("%15s",$jpp->paymentType->name) ?> : <?php echo sprintf("%17s",number_format($jpp->amount,0) ) ?>

<?php endforeach; ?>

<?php echo sprintf("%15s","Dibayar")?> : <?php echo sprintf("%17s",number_format($model->total_paid,0)) ?>

<?php echo sprintf("%15s","Kembali")?> : <?php echo sprintf("%17s",number_format($model->total_change,0)) ?>


********** TERIMA KASIH ************







