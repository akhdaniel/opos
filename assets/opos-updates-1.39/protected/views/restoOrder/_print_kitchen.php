
Number 		: <?php echo $model->notes ?>

Order Date 	: <?php echo $model->order_date ?>

Table Number 	: <?php echo $model->table->table_name ?>


<?php foreach($model->orderDetails as $i=>$od ) :?>

<?php echo $od->product->name ?> 
	<?php echo sprintf("%4s","QTY")?> : <?php echo sprintf("%28s", number_format($od->qty,2) ) ?>

	<?php echo sprintf("%4s","NOTE")?> : <?php echo sprintf("%28s",number_format($model->totalListPrice,0)) ?>

<?php endforeach; ?>




