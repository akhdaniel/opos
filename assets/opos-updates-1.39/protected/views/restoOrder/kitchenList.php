<h2 align="center">Order List</h2>
<?php
	$this->widget('ext.groupgridview.BootGroupGridView', array(
		'id' => 'kitchen-grid',
		'itemsCssClass'=>'table table-hover table-bordered',
		'dataProvider' => $model,
		'mergeColumns' => array('order_id'),
		'rowCssClassExpression'=>'$data->getCssClass()',
		'columns' => array(
			array('name'=>'order_id', 'header'=>'Table Name', 'value'=>'$data->order->table->table_name'),
			array('name'=>'product_id', 'header'=>'Product Name', 'value'=>'$data->product->name'),
			'qty',
			array('name'=>'notes','header'=>'Notes', 'value'=>'$data->note','htmlOptions'=>array('id'=>'notes-order')),
			array('name'=>'status', 'value'=>'status_kitchen($data->status)'),
			array('header'=>'Time Elapsed', 'value'=>'time_elapsed($data->insert_date)'),
			array(
				'class'=>'ButtonColumn',
				'template'=>'{onprogress} {done}',
				'evaluateID'=>true,
	            'buttons'=>array(
	                'onprogress' => array(
	                    'visible'=>'$data->status==ORDER_DETAIL_WAITING? true : false',
	                    'label'=>'<button class="btn btn-primary"><span class="icon-refresh icon-white"></span></button>',
	                    'options'=>array('title'=>'Set order to on progress', 'id'=>'$data->id'),
	                   	'click'=>'function(){setProgress($(this).attr("id"), 1);}', 
                               
	                    // 'label'=>'Send an e-mail to this user',
	                    // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
	                    // 'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
	                ),

	                'done' =>array(
	                    'visible'=>'$data->status==ORDER_DETAIL_ONPROGRESS? true : false',
	                    'label'=>'<button class="btn btn-success"><span class="icon-ok-sign icon-white"></span></button>',
	                    'options'=>array('title'=>'Set order to done', 'id'=>'$data->id'),
	                    'click'=>'function(){setProgress($(this).attr("id"), 2);}', 
	                    // 'label'=>'Send an e-mail to this user',
	                    // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
	                    // 'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
	                ),
	            ),
	        ),	
      	),
	));
?>

<?php 
	cs()->registerScript('kithcenList',"
		function setProgress(id, type){
			var row = {
                id : id,
                type : type
            	
            };
        	
        	var url = '".bu('/restoOrder/setProgress')."';
			$.ajax({
				type: 'POST',
				url: url,
				data: row,
				success: function(data){ 
				    if(!data.success){
				        alert(data.message);
				    }else{
				        $.fn.yiiGridView.update('kitchen-grid');
				    }
				},

				error: function(data){
				alert(data.statusText);
				},
				dataType: 'json'
			});  
		}

		function updateList(){
			$.fn.yiiGridView.update('kitchen-grid');
			setTimeout(updateList, 5000);
		}
		updateList();
	");
?>