<?php
$this->breadcrumbs=array(
	'Product Discounts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductDiscount','url'=>array('index')),
	array('label'=>'Create ProductDiscount','url'=>array('create')),
);

?>

<h1>Manage Product Discounts </h1>

<?php if (Yii::app()->user->getState('product_id')) : ?>
<h2><?php echo $product->name?></h2>
<p>List Price : <?php echo number_format($product->list_price) ?></P>
<?php endif ;?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-discount-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//array('name'=> 'id', 'filter'=>false),
		array(
            'id'=>'selectedItems',
            'class'=>'CCheckBoxColumn',
            'selectableRows'=>2,
            'value'=> '$data->id',
        ),
		array('name'=> 'product.name', 'visible'=> !Yii::app()->user->getState('product_id') ),
		array('name'=> 'qty', 'filter'=>false),
		array('name'=> 'nominal', 'filter'=>false),
		array('name'=> 'percent', 'filter'=>false),
		array('name'=> 'enable', 'filter'=>false, 'value'=>'$data->enable==1?"True":"False"'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>


<?php if (Yii::app()->user->getState('product_id')) : ?>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Back to Product',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/product/view/' . Yii::app()->user->getState('product_id') )
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Add Product Discount',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/productDiscount/create' )
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Enable/Disable',
    'type'=>'warning', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType' => 'ajaxLink',
    'url'=>bu('/productDiscount/enable'),
    'ajaxOptions' => array(
	    'type' => 'post',
	    'data'=>'js:{ids : $.fn.yiiGridView.getChecked("product-discount-grid","selectedItems")}',
	    'success'=> "js:function() { $.fn.yiiGridView.update('product-discount-grid') }"
    )
)); ?>

<?php else: ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Back to Product List',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/product/admin' )
)); ?>


<?php endif ;?>
