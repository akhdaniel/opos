<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
);

?>

<h1>Manage Users</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'filter'=>false),
		'name',
		'login',
		//'password',
		'oe_id',
        'group_name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>



<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'disabled'=> false,
    'url'=> Yii::app()->createUrl('/user/create'),
    'htmlOptions'=>array(
    	'id'=> 'create',	    	
    )
)); ?>


<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Sync User',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'link',
    'disabled'=> false,
    'url'=> Yii::app()->createUrl('/user/sync'),
    'htmlOptions'=>array(
    	'id'=> 'sync',	    	
    )
)); ?>