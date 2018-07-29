<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
'id'=>'modalProgress',
'htmlOptions'=>array('width'=>'220',
'data-keyboard'=>'false',
'data-backdrop'=>'static'
)
)); ?>
     
    <div class="modal-body">
        <center>
           <div class="inner-circles-loader">
			  Loading…
			</div>

			<h2>Please Wait</h2>
        </center>
    </div>

<?php $this->endWidget(); ?>
