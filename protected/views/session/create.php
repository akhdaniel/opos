<?php
$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Session','url'=>array('index')),
	array('label'=>'Manage Session','url'=>array('admin')),
);
?>

<h1>Create Session</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>