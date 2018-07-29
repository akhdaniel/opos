<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Account','url'=>array('index')),
	array('label'=>'Create Account','url'=>array('create')),
);


?>

<h1>Manage Accounts</h1>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Sync Accounts',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>bu('/account/sync')
)); ?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'account-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=> 'id', 'filter'=>false),
		'code',
		'name',
		'oe_id',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

