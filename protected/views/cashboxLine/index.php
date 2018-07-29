<?php
$this->breadcrumbs=array(
	'Cashbox Lines',
);

$this->menu=array(
	array('label'=>'Create CashboxLine','url'=>array('create')),
	array('label'=>'Manage CashboxLine','url'=>array('admin')),
);
?>

<h1>Cashbox Lines</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
