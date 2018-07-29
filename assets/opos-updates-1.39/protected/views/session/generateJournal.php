<h1>Preview Journal</h1>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Post Journal to OE',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'buttonType'=>'button',
    'htmlOptions'=>array(
    	'id'=>'confirmClose'	    	
    )
)); ?>


<?php
cs()->registerScript('init',"
$('#confirmClose').click(function(){
	\$('#modalProgress').modal('show');
	location.href='" . bu('/session/postJournal/' . $model->id) . "';
	return false;
});
"); 
?>

<?php $this->renderPartial('//order/_progress', array() ); ?>
