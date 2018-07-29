<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
'id'=>'modalProgress',
'htmlOptions'=>array('width'=>'220',
'data-keyboard'=>'false',
'data-backdrop'=>'static'
)
)); 

$title = isset($title)?$title:'Uploading';
?>
 
    <div class="modal-header">
        <h4><?php echo $title ?> data. Please wait... Don't Press ESC Key </h4>
    </div>
     
    <div class="modal-body">
        <center>
            <?php echo CHtml::image( bu().'/images/progressbar.gif', '', array(
            ) ) ?>
        </center>
    </div>

<?php $this->endWidget(); ?>
