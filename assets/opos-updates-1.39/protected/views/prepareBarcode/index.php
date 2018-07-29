<?php
$this->breadcrumbs=array(
	'Prepare Barcodes',
);

$this->menu=array(
	array('label'=>'Create PrepareBarcode','url'=>array('create')),
	array('label'=>'Manage PrepareBarcode','url'=>array('admin')),
);
?>

<h1>Prepare Barcodes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
