<?php echo $shop_name ?>


Number     : <?php echo $model->notes ?>

Order Date : <?php echo $model->order_date ?>

Kasir      : <?php echo Yii::app()->user->name ?>


<?php foreach($model->orderDetails as $i=>$od ) :?>
<?php if($od->paid_status == 'PAID') :?>
<?php echo $od->product->name ?>

	<?php echo sprintf("%0.2f", number_format($od->qty,2) ) ?> x <?php echo sprintf("%7s",number_format($od->unit_price,0)) ?> = <?php echo sprintf("%10s",number_format($od->amount,0)) ?>

<?php endif; ?>
<?php endforeach; ?>

<?php echo sprintf("%16s","SUB TOTAL")?> : <?php echo sprintf("%16s",number_format($model->totalListPrice,0)) ?>

<?php echo sprintf("%16s","DISCOUNT")?> : <?php echo sprintf("%16s",number_format($model->totalDiscount,0)) ?>

<?php
if($model->discount_special > 0){
	echo sprintf("%16s","DISCOUNT SPECIAL")?> : <?php echo sprintf("%16s",number_format($model->discount_special,0));
}
?>

<?php echo sprintf("%16s","TOTAL")?> : <?php echo sprintf("%16s",number_format($model->total,0)) ?>


<?php foreach($model->orderPayments as $i=>$op ) :?>
<?php echo sprintf("%16s",$op->paymentType->name) ?> : <?php echo sprintf("%16s",number_format($op->amount,0) ) ?>

<?php endforeach; ?>

<?php echo sprintf("%16s","Dibayar")?> : <?php echo sprintf("%16s",number_format($model->total_paid,0)) ?>

<?php echo sprintf("%16s","Kembali")?> : <?php echo sprintf("%16s",number_format($model->total_change,0)) ?>


<?php 
	if($split_num > 1){
?>
<?php echo sprintf("%15s","Split Number") ?> : <?php echo sprintf("%17s",number_format($split_num)) ?>

<?php echo sprintf("%15s","Split Due") ?> : <?php echo sprintf("%17s",number_format($split_due,0)) ?>
<?php		
	}
?>

********** TERIMA KASIH ************







