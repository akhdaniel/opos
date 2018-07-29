<?php
$this->breadcrumbs=array(
	'Sessions',
);

$this->menu=array(
	array('label'=>'Create Session','url'=>array('create')),
	array('label'=>'Manage Session','url'=>array('admin')),
);
?>

<h1>Sessions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
