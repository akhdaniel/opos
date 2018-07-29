<?php
$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	'Manage',
);
?>

<h1>List Sessions</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'session-grid',
    'type'=>'striped bordered',
	'dataProvider'=>$model,
	'columns'=>array(
		array('name'=>'id', 'filter'=>false),
		//'name',
        array('value'=>'CHtml::link( $data->name, Yii::app()->createUrl("/session/waiterSelect/" . $data->id )) ', 
        	'type'=>'raw',
        	'name'=>'name',
        	'header'=>'Name'),
		'open_date',
		//'close_date',
		'state',
	),
)); ?>

