<?php echo $shop_name ?>


Number     : <?php echo $model->notes ?>

Order Date : <?php echo $model->order_date ?>

Kasir      : <?php echo Yii::app()->user->name ?>


<?php foreach($model->orderDetails as $i=>$od ) :?>
<?php if($od->paid_status == 'PAID' and in_array($od->id, $od_ids)) :?>
<?php echo $od->product->name ?>

	<?php echo sprintf("%0.2f", number_format($od->qty,2) ) ?> x <?php echo sprintf("%7s",number_format($od->unit_price,0)) ?> = <?php echo sprintf("%10s",number_format($od->amount,0)) ?>

<?php endif; ?>
<?php endforeach; ?>

<?php echo sprintf("%15s","SUB TOTAL")?> : <?php echo sprintf("%17s",number_format($sub_total,0)) ?>

<?php echo sprintf("%15s","DISCOUNT")?> : <?php echo sprintf("%17s",number_format($disc_total,0)) ?>

<?php echo sprintf("%15s","TOTAL")?> : <?php echo sprintf("%17s",number_format($total,0)) ?>


<?php foreach($payments as $i=>$op ) :?>
<?php if($op != ""):?>
<?php echo sprintf("%15s",PaymentType::model()->findByPk($i)->name) ?> : <?php echo sprintf("%17s",substr($op, 0, -3) ) ?>
<?php endif;?>

<?php endforeach; ?>
<?php echo sprintf("%15s", "Cash")?> : <?php echo sprintf("%17s","-".number_format($change,0) ) ?>



<?php echo sprintf("%15s","Dibayar")?> : <?php echo sprintf("%17s",number_format($total_paid,0)) ?>

<?php echo sprintf("%15s","Kembali")?> : <?php echo sprintf("%17s",number_format($change,0)) ?>

********** TERIMA KASIH ************







