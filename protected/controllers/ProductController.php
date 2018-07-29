<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','sync',
					'syncSingle', 'syncZeroUom',
					'findByCode','autocomplete','syncRemoved'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','barcode','preparePrintBarcode','setStatus',
					'admin','delete'),
				'users'=>array('@'),
			),
			// array('allow', // allow admin user to perform 'admin' and 'delete' actions
			// 	'actions'=>array('admin','delete'),
			// 	'users'=>array('admin'),
			// ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		Yii::app()->user->setState('product_id', $id);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=new Product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$this->layout='//layouts/column1';
		Yii::app()->user->setState('product_id',false);

		if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }		
        
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionSync()
	{
		$result = '';

		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$start = time();
		$cron = isset($_GET['cron']);

		list($oe, $user_id) = oeLogin();
		

		$as = AppSetting::model()->findOrCreate('product_last_sync','1970-01-01 00:00:00');
		$product_last_sync = $as->val;

		$ov = AppSetting::model()->findOrCreate('odoo_version','8');
		$odoo_version = $ov->val;

		//search dulu yang berubah aja, write_date >= product_last_sync_date
		$model = "product.product";
		$ids = $oe->search('write_date','>', $product_last_sync,$model);

		if ($ids == -1){
			$msg= 'No newer product found than ' . $product_last_sync;
			if($cron){
				$a = array(
					'status'=>'error',
					'msg'=>$msg,
				);
				echo CJSON::encode($a);
				Yii::app()->end();
			}
			else{
				Yii::app()->user->setFlash('warning',$msg);
				$this->redirect(array('/product/index'));

			}
			return;
		}

		$fields = array('id',
					'name',
					'list_price', 
					'standard_price', 
					'default_code', 
					'ean13', 
					'barcode',
					'categ_id',
					'property_stock_valuation_account_id',
					'property_expense_account_id',
					'property_income_account_id',
					'uom_id',
					'active',
					'x_ppn'
		); 

		$chunks = array_chunk($ids, 1000);

		$i=0;
		$maxchunk = sizeof($chunks);
		for( $ch = 0; $ch < $maxchunk ; $ch++ )
		{
			$products = $oe->read($chunks[$ch], $fields, $model);
			$result .= $this->processProduct($products,$cron);
			unset($products);
			$i += sizeof($chunks[$ch]);			
		}

		/*update app setting */
		$as->val = gmdate('Y-m-d H:i:s');
		$as->save();

		$end = time();
		$delta = ($end-$start) / 60;

		$result .= sprintf("Done sync $i products in %03d min(s).", $delta);


		$msg = $result;
		if($cron){
			$a = array(
				'status'=>'success',
				'msg'=>$msg,
			);
			echo CJSON::encode($a);
			Yii::app()->end();
		}
		else
		{
			Yii::app()->user->setFlash('success', $msg);
			$this->redirect(array('/product/admin'));
		}

	}

	protected function processProduct($products, $cron){
		$result=  '';
		if(!$products){
			$msg = 'no product found';
			if($cron){
				$a = array(
					'status'=>'error',
					'msg'=>$msg,
				);
				echo CJSON::encode($a);
				Yii::app()->end();
			}
			else{
				Yii::app()->user->setFlash('error',$msg  );
				$this->redirect(array('/product/admin'));
			}
			return;
		}
		$i=0;
		$result = '';

		if ($products == -1){
			$msg= 'no product found';
			Yii::app()->user->setFlash('warning',$msg);
			$this->redirect(array('/product/index'));
		}
		else
		{
			if(is_array($products)){
				foreach ($products as $p){
					// $product = Product::model()->find('name=:name',array('name'=>$p['name']) );
					$product = Product::model()->find('default_code=:default_code',array('default_code'=>$p['default_code']) );
					if(!$p['default_code'])
						continue;

					if (!$product){
						$product 				= new Product();
						$product->name 					= $p['name'];
						$product->list_price 			= $p['list_price'];
						$product->cost_price 			= $p['standard_price'];
						$product->default_code 			= $p['default_code'];
						$product->ean13 				= $p['barcode'];
						$product->oe_id 				= $p['id'];
						$product->uom 					= $p['uom_id'];
						$product->category 				= $p['categ_id'][1];
						$product->oe_stock_account_id 	= $p['property_stock_valuation_account_id'][0];
						$product->tax 					= $p['x_ppn']==true?1:0;
						$product->oe_expense_account_id = $p['property_expense_account_id'][0];
						$product->oe_income_account_id 	= $p['property_income_account_id'][0];
						$product->active 				= $p['active'];
						$product->is_active 			= $p['active'] ? 1 : 0;

						if (!$product->save())
						{
							$result .="**** error insert ". $p['name'] . "<br>";
						}
						$result .= "insert ". $p['name'] . "<br>";
					}
					else  
					{
						$product->name 					= $p['name'];
						$product->list_price 			= $p['list_price'];
						$product->cost_price 			= $p['standard_price'];
						$product->default_code 			= $p['default_code'];
						$product->ean13 				= $p['barcode'];
						$product->oe_id 				= $p['id'];
						$product->uom 					= $p['uom_id'];
						$product->category 				= $p['categ_id'][1];
						$product->oe_stock_account_id 	= $p['property_stock_valuation_account_id'][0];
						$product->tax 					= $p['x_ppn']==true?1:0;
						$product->oe_expense_account_id = $p['property_expense_account_id'][0];
						$product->oe_income_account_id 	= $p['property_income_account_id'][0];
						$product->active 				= $p['active'];
						$product->is_active 			= $p['active'] ? 1 : 0;

						if(!$product->save()){
							$result .= "**** error update ". $p['name'] . "<br>";
							$result .= json_encode( $product->getErrors() );
						}
						$result .= "update " . $p['name'] . "<br>";
					}
					$i++;
				}
			}
			else
			{
				$msg= 'product is not an array';
				Yii::app()->user->setFlash('warning',$msg);
				$this->redirect(array('/product/index'));
			}
		}
		return $result;

	}

	public function actionSyncSingle()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$ids  = $_GET['ids']; ///1,2,3,4.. array of oe_ids 
		if (!$ids)
			return;
		$ids  = explode(',', $ids); // array(1,2,3,4,..)

		$cron = isset($_GET['cron']); //from cron ?

		list($oe, $user_id) = oeLogin();

		$fields = array('id','name','list_price', 'standard_price', 
					'default_code', 'ean13', 'barcode',
					'categ_id',
					'property_stock_valuation_account_id',
					'uom_id',
					'property_expense_account_id',
					'property_income_account_id',
					'active','x_ppn'
				); 
	
		$products = $oe->read( $ids , $fields, "product.product");

		if($products==-1){

			$msg = 'no product found';
			if($cron){
				echo $msg;
			}
			else{
				Yii::app()->user->setFlash('error',$msg  );
				$this->redirect(array('/product/admin'));				
			}
			return;
		}
		$i=0;
		$result = '';

		foreach ($products as $p){

			$product = Product::model()->find('oe_id=:o', array('o'=>$p['id']));

			$product->list_price 			= $p['list_price'];
			$product->cost_price 			= $p['standard_price'];
			$product->default_code 			= $p['default_code'];
			$product->ean13 				= $p['barcode'];
			$product->oe_id 				= $p['id'];
			$product->uom 					= $p['uom_id'];
			$product->category 				= $p['categ_id'][1];
			$product->oe_stock_account_id 	= $p['property_stock_valuation_account_id'][0];
			$product->tax 					= $p['x_ppn']==true?1:0;
			$product->oe_expense_account_id = $p['property_expense_account_id'][0];
			$product->oe_income_account_id 	= $p['property_income_account_id'][0];			

			if(!$product->save()){
				$result .= "**** error update ". $p['name'] . "<br>";
			}
			$result .= "update " . $p['name'] . "<br>";
			$result .= var_export($product->attributes, true) . '<br>';
		
			$i++;
		}

		$result .= "done sync $i products.<br>";

		$msg = $result;

		if($cron){
			echo CJSON::encode( array('status'=>'success', 'msg'=>$msg));
			Yii::app()->end();
		}
		else{
			Yii::app()->user->setFlash('success', $msg);
			$this->redirect(array('/product/view', 'id'=>$product->id));

		}

	}

	public function actionSyncZeroUom(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$crit = new CDbCriteria;
		$crit->addCondition('oe_stock_account_id = 0 OR uom=0');
		$crit->limit = 5;
		$products = Product::model()->findAll($crit);
		if(!$products)
		{
			$msg =  'no more product with zero uom and stock valuation account ';
			echo CJSON::encode( array('status'=>'success', 'msg'=>$msg));
			die;			
		}

		$ids = array();
		foreach ($products as $i => $p) {
			$ids[] = $p->oe_id;
		}

		$_GET['ids'] = implode(',', $ids) ;
		$_GET['cron'] = 1 ;
		
		$this->actionSyncSingle();
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Product the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Product $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionFindByCode()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$code 	= $_GET['code'];
		$model = Product::model()->find('(ean13=:ean13 or default_code=:code or name=:name) and uom<>0 and oe_stock_account_id<>0', 
			array('ean13'=>$code, 'code'=>$code , 'name'=>$code ));

		if (!$model) {
			echo CJSON::encode(array('success'=>false, 
				'message'=>'Product not found, please Sync from Server. '."\n\n".'Make sure it exists, active and has the Property [Stock Valuation Account], [Expense Account], 	
[Income Account] and [Unit of Measure] value are set.' , 'product'=>''));
		}
		else{
			$model->discount_price = $model->calcDiscount(1); 
			echo CJSON::encode(array('success'=>true, 'message'=>'', 'product'=>$model));			
		}
		Yii::app()->end();
	}

	public function actionAutocomplete(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$arr = array();

		if (isset($_GET['term']))
		{
			$term = $_GET['term'];
		
			$crit = new CDbCriteria;
			$crit->addSearchCondition('name', $term, true, 'OR', 'LIKE' );
			$crit->addSearchCondition('default_code', $term, true, 'OR', 'LIKE' );
			$crit->addSearchCondition('ean13', $term, true, 'OR', 'LIKE' );
			$crit->addCondition('oe_stock_account_id <> 0 and uom<>0');
			$crit->addCondition('is_active = 1');
			$models = Product::model()->findAll($crit);
			foreach($models as $model)
			{
				$arr[] = array(
			          'label'=> $model->name . '  Rp ' . number_format($model->list_price,2) . ' [' . $model->default_code . ']' ,  // label for dropdown list
			          'value'=>$model->name,  // value for input field
			          'id'=>$model->id,       // return value from autocomplete
				);
			}
		}
		echo CJSON::encode($arr);
		Yii::app()->end();	
	}


	public function actionBarcode(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$ids = $_POST['selectedItems'];
		$criteria = new CDbCriteria();
		$criteria->addInCondition("id", $ids );
		$products = Product::model()->findAll($criteria);		

		if(!$products){
			Yii::app()->user->setFlash('warning','No product found or selected.');
			$this->redirect(array('/product/index'));
			return;
		}

		// if(isset($_POST['pdf'])){
		// 	$this->createPdf($products);
		// }
		if (isset($_POST['csv'])){
			$this->createCsv($products);
		}
		// else if (isset($_POST['direct'])){
		// 	$this->directPrint($products);
		// }
	}

	public function createCsv($products){
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=products.csv");
		header("Content-Type: application/octet-stream");
		header("Content-Transfer-Encoding: binary");		

		echo '"name",' ;
		echo '"list_price",' ;
		echo '"ean13",' ;
		echo '"default_code"' ;
		echo "\n";

		foreach($products as $i=>$p){
			echo '"' . $p->name . '",' ;
			echo '"' . $p->list_price . '",' ;
			echo '"' . $p->ean13 . '",' ;
			echo '"' . $p->default_code . '"' ;
			echo "\n";
		}
	}

	public function actionSyncRemoved()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT(); 
		$start = time();
		$i=0;
		$result = '';

		$idproduk = array();

		/*Login with xml rpc*/
		list($oe, $user_id) = oeLogin();

		$ids = $oe->search('write_date','>', '1970-01-01 00:00:00','product.product');
		
		if ($ids == -1){
			$msg= 'No product was removed or mergered';
			
			Yii::app()->user->setFlash('warning',$msg);
			$this->redirect(array('/product/index'));
			
			return;
		}else{
			$product = Product::model()->findAll();
			foreach ($product as $p) {
				if(!in_array($p->oe_id, $ids)) {
				    /*Set status to inactive(0)*/
				    $p->is_active = 0;
				    $p->save();

				    /*Search in stock move with product_id and set to inactive*/
				    $stockmove = StockMove::model()->findAllByAttributes(array('product_id'=>$p->oe_id));
				    if($stockmove){
				    	foreach($stockmove as $sm){
					    	$sm->is_active = 0;
					    	$sm->save();
					    }
				    }
				    $result .= "product ". $p['name'] . " was removed or mergered <br>";
				    $i++;
				}
			}
		}

		if($i == 0){
			$result = "No product was removed or mergered";
		}

		$end = time();
		$delta = ($end-$start) / 60;

		$result .= sprintf("Done sync $i products in %03d min(s).", $delta);

		$msg = $result;
		Yii::app()->user->setFlash('success', $msg);
		$this->redirect(array('/product/admin'));
	}

	public function actionSetStatus(){
		if(isset($_POST['id'])){
			$model = Product::model()->findByPk($_POST['id']);
			
			if($model->status == 1){
				$model->status = 0;
			}else{
				$model->status = 1;
			}

			if($model->save()){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('success'=>false));
			}
		}
	}
}
