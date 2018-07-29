<?php
$this->breadcrumbs=array(
	'Session Payments',
);

$this->menu=array(
	array('label'=>'Create SessionPayment','url'=>array('create')),
	array('label'=>'Manage SessionPayment','url'=>array('admin')),
);
?>

<h1>Session Payments</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
