<?php
$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Session','url'=>array('index')),
	array('label'=>'Create Session','url'=>array('create')),
	array('label'=>'Update Session','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Session','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Session','url'=>array('admin')),
);
?>

<h1>View Session #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'open_date',
		'close_date',
		array('name'=>'Total Sales Non PPN', 
			'type'=>'raw', 
			'value'=>number_format($model->total,2),
			'visible'=> $model->state != SESSION_OPEN 
			),
		array('name'=>'Total Sales PPN', 
			'type'=>'raw', 
			'value'=>number_format($model->totalppn,2),
			'visible'=> $model->state != SESSION_OPEN 
			),
		array('name'=>'Total Cash Sales',
			'type'=>'raw', 
			'value'=>number_format($model->totalCash,2),
			'visible'=> $model->state != SESSION_OPEN 
			),
		array('name'=>'Opening Cash',
			'type'=>'raw', 
			'value'=>number_format($model->totalCashOpening,2),
			),
		array('name'=>'total cash drawer', 
			'type'=>'raw', 
			'value'=>number_format($model->total_drawer,2),
			'visible'=> $model->state != SESSION_OPEN 
			),
		array('name'=>'difference', 
			'type'=>'raw', 
			'value'=>number_format($model->difference,2),
			'visible'=> $model->state != SESSION_OPEN 
			),
		'user_id',
		'oe_id',
		'state',
	),
)); ?>

<?php if($oe_summary_mode==0) :?>
	<?php echo $this->renderPartial('_online_mode_buttons', array('model'=>$model)); ?>	
	<?php
	cs()->registerScript('init',"
	$('#confirmClose').click(function(){
		\$('#modalProgress').modal('show');
		location.href='" . bu('/session/recloseOeSession/' . $model->id) . "';
		return false;
	});
	"); 
	?>
<?php else: ?>
	<?php echo $this->renderPartial('_summary_mode_buttons', array('model'=>$model)); ?>	
	<?php
	cs()->registerScript('init',"
	$('#confirmClose').click(function(){
		\$('#modalProgress').modal('show');
		location.href='" . bu('/session/generateJournal/' . $model->id) . "';
		return false;
	});
	"); 
	?>
<?php endif; ?>


<?php $this->renderPartial('//order/_progress', array() ); ?>


