<?php
  if($data->status == 1){
?>
  <li class="product_screen" onclick="insertOrder('<?php echo $data->id?>');">
  	<div class="thumbnail">
  		<?php if($data->image_url != null):?>
      	<img src="<?php echo $data->image_url?>" width="72" height="72">
      	<?php else: ?>
      	<img src="<?php echo Yii::app()->baseUrl?>/images/default.png" width="72" height="72">
      	<?php endif;?>
      	<div class="caption">
        		<p><?php echo CHtml::encode($data->name); ?></p>
      	</div>
    	</div>
  </li>
<?php
  }else{
?>
  <li class="product_screen">
    <div class="thumbnail stock_none">
      <?php if($data->image_url != null):?>
        <img src="<?php echo $data->image_url?>" width="72" height="72">
        <?php else: ?>
        <img src="<?php echo Yii::app()->baseUrl?>/images/default.png" width="72" height="72">
        <?php endif;?>
        <div class="caption">
            <p><?php echo CHtml::encode($data->name); ?></p>
        </div>
      </div>
  </li>
<?php
  }
?>