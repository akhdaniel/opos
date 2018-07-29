<?php
$this->breadcrumbs=array(
	'Session Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SessionPayment','url'=>array('index')),
	array('label'=>'Manage SessionPayment','url'=>array('admin')),
);
?>

<h1>Create SessionPayment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>