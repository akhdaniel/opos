<?php
$this->breadcrumbs=array(
	'Prepare Barcodes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PrepareBarcode','url'=>array('index')),
	array('label'=>'Create PrepareBarcode','url'=>array('create')),
);
?>

<h1>Manage Prepare Barcodes</h1>


<p>Search and add products to print</p>

<br/>
<?php echo $this->renderPartial('_form', array('model'=>$newModel)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'prepare-barcode-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'filter'=>false),
		array('name'=>'product_id', 'value'=>'$data->product->name', 'filter'=>false),
		array('header'=>'Default Code', 'value'=>'$data->product->default_code'),
		array('header'=>'EAN13', 'value'=>'$data->product->ean13'),
		array('name'=>'qty', 'filter'=>false, 
            'footer'=>$model->getTotals($model->search()->getKeys()),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Reset Data',
    'buttonType'=>'link',
    'url'=>bu('/prepareBarcode/reset'),
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'htmlOptions'=>array(
    	'onclick'=>'return confirm("Are you sure?")'
    )
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Barcode (Printer)',
    'htmlOptions'=>array(
	    'name'=>'direct',
	    'value'=>'direct'
   	),
    'buttonType'=>'link',
    'url'=>bu('/prepareBarcode/directPrint'),
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Barcode (PDF)',
    'htmlOptions'=>array(
	    'name'=>'pdf',
	    'value'=>'pdf'
   	),
    'buttonType'=>'link',
    'url'=>bu('/prepareBarcode/pdf'),
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>

