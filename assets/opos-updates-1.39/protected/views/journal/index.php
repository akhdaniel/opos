<?php
$this->breadcrumbs=array(
	'Journals',
);

$this->menu=array(
	array('label'=>'Create Journal','url'=>array('create')),
	array('label'=>'Manage Journal','url'=>array('admin')),
);
?>

<h1>Journals</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
