<h1>Product List</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions'=>array(
        'id'=>'product-search'
    )
)); ?>
    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>200,'placeholder'=>'Search product')); ?>
<?php $this->endWidget(); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'product-grid',
	'itemsCssClass'=>'table table-bordered',
	'dataProvider' => $model->search(),
	'rowCssClassExpression'=>'$data->getCssClass()',
	'columns'=>array(
        array(
        	'value'=>'$data->name', 
        	'header'=>'Product Name'
        ),
        array(
        	'header'=>'Status', 
        	'value'=>'$data->status==1?"Available":"Out of stock"'
        ),
		array(
			'class'=>'ButtonColumn',
			'template'=>'{enable} {disable}',
			'evaluateID'=>true,
            'buttons'=>array
            (
                'enable' => array(
                    'visible'=>'$data->status==0? true : false',
                    'label'=>'<button class="btn btn-success"><span class="icon-ok-sign icon-white"></span></button>',
                    'options'=>array('title'=>'Set status to out of stock', 'id'=>'$data->id'),
                   	'click'=>'function(){setProgress($(this).attr("id"));}', 
                           
                    // 'label'=>'Send an e-mail to this user',
                    // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                    // 'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                ),

                'disable' =>array(
                    'visible'=>'$data->status==1? true : false',
                    'label'=>'<button class="btn btn-danger"><span class="icon-ok-sign icon-white"></span></button>',
                    'options'=>array('title'=>'Set order to available', 'id'=>'$data->id'),
                    'click'=>'function(){setProgress($(this).attr("id"));}', 
                    // 'label'=>'Send an e-mail to this user',
                    // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                    // 'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                ),
            ),            
        ),		
),
)); ?>

<?php 
	cs()->registerScript('productList',"
		function setProgress(id){
			var row = {
                id : id,
            };
        	
        	var url = '".bu('/product/setStatus')."';
			$.ajax({
				type: 'POST',
				url: url,
				data: row,
				success: function(data){ 
				    if(!data.success){
				        alert(data.message);
				    }else{
				        $.fn.yiiGridView.update('product-grid');
				    }
				},

				error: function(data){
					alert(data.statusText);
				},
				dataType: 'json'
			});  
		}

        $('#Product_name').keyup(function(){
            $.fn.yiiGridView.update('product-grid',{data: $('#product-search').serialize()});
        });
	");
?>