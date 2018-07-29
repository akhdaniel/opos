<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
);


?>

<h1>Manage Products</h1>


<form action="<?php echo bu('/product/barcode')?>" method="post" id="product-form" style="">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Sync Products',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    // 'url'=>bu('/product/sync')
    'htmlOptions'=>array(
        'id'=> 'confirmSync' ,           
    )    
)); ?>

<?php
cs()->registerScript('init',"
$('#confirmSync').click(function(){
    \$('#modalProgress').modal('show');
    location.href='" . bu('/product/sync') . "';
    return false;
});
"); 
?>

<?php $this->renderPartial('//order/_progress', array('title'=>'Syncing') ); ?>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Sync Removed Products',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>bu('/product/syncRemoved')
)); ?>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Barcode Label',
    'htmlOptions'=>array(
	    'name'=>'direct',
	    'value'=>'direct'
   	),
    'buttonType'=>'link',
    'url'=>bu('/prepareBarcode/admin'),
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Export CSV',
    'buttonType'=>'submit',
    'htmlOptions'=>array(
	    'name'=>'csv',
	    'value'=>'csv'
   	),
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Product Discount',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/productDiscount/admin' )
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Product Gift',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'url'=>bu('/productGift/admin' )
)); ?>

<!--select name="pageSize" id="pageSize">
	<option value="10">10</option>
	<option value="25">25</option>
	<option value="50">50</option>
	<option value="100">100</option>
	<option value="0">all</option>
</select-->
<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		   array(
                    'id'=>'selectedItems',
                    'class'=>'CCheckBoxColumn',
                    'selectableRows'=>2,
                    'value'=> '$data->id',
                ),
		array('name'=>'id', 'filter'=>false
		),
        array('value'=>'CHtml::link( $data->name, Yii::app()->createUrl("/product/view/" . $data->id )) ', 
        	'type'=>'raw',
        	'name'=>'name',
        	'header'=>'Name'),
        array('value'=>'number_format($data->list_price,2)', 'header'=>'List Price',
            'htmlOptions'=>array('style'=>'text-align: right')),
		'default_code',
        'ean13',
		'oe_id',
		'category',
        'oe_stock_account_id',
        'oe_expense_account_id',
        'oe_income_account_id',
        'uom',
        array('name'=>'tax', 'value'=>'$data->tax==1?"True":"False"'),
        array('name'=>'is_active', 'value'=>'$data->is_active==1?"True":"False"'),
        // array('name'=>'active', 'value'=>'$data->active==1?"True":"False"'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete} {view} {update}',
            'buttons'=>array
            (
                'update' => array
                (
                    'visible'=>'Yii::app()->user->id==1? true : false',
                    // 'label'=>'Send an e-mail to this user',
                    // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                    // 'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                ),
            ),            
            'header'=>CHtml::dropDownList('pageSize',
            	$pageSize,
            	array(10=>10,20=>20,50=>50,100=>100,1000=>1000,2000=>2000),
            	array(
                    'style'=>'width:50px',
                	'onchange'=>"$.fn.yiiGridView.update('product-grid',{ data:{pageSize: $(this).val() }})",
        		)),
        ),		
),
)); ?>
</form>


