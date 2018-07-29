<?php
$this->breadcrumbs=array(
	'Cashbox Lines'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CashboxLine','url'=>array('index')),
	array('label'=>'Manage CashboxLine','url'=>array('admin')),
);
?>

<h1>Create CashboxLine</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>