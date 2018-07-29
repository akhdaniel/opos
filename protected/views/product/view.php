<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Product','url'=>array('create')),
	array('label'=>'Update Product','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'list_price',
		'default_code',
		'ean13',
		'oe_id',
		'category',
        'oe_stock_account_id',
        'oe_expense_account_id',
		'oe_income_account_id',
		'uom',
        array('name'=>'tax', 'value'=>$model->tax==1?"True":"False"),
        array('name'=>'is_active', 'value'=>$model->is_active==1?"True":"False"),
	),
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Back to Product List',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/product/admin' )
)); ?>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Sync this Product',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/product/syncSingle?ids=' . $model->oe_id)
)); ?>



<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Discounts',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/productDiscount/admin')
)); ?>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Gifts',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/productGift/admin')
)); ?>



<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Update',
    'type'=>'warning', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/product/update/' . $model->id),
    'htmlOptions'=>array('style'=>'display:' . (Yii::app()->user->id==1 ? 'inline-block':'none') )
)); ?>
