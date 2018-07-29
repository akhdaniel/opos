<?php

class OrderDetailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','delete', 'update','jcreate', 'jupdate', 'jdelete','deliver','searchNote','saveNote','check','deliverAll'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
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
		Yii::app()->regkey->cekReg();
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
		Yii::app()->regkey->cekReg();
		$model=new OrderDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrderDetail']))
		{
			$model->attributes=$_POST['OrderDetail'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionJcreate(){
		Yii::app()->regkey->cekReg();
		$product_id = $_POST['product_id'] ;
		$model = OrderDetail::model()->find('product_id=:p and order_id=:o and unit_price<>0', array('p'=>$product_id, 'o'=>$_POST['order_id']));

		$orderModel = Order::model()->findByPk($_POST['order_id']);
		if($model){

			$model->qty++;			
			$model->amount = $model->qty * $model->unit_price;
			$model->tax = $model->product->tax;

			if($orderModel->customer->name == "reguler"){
				$this->checkGifts($product_id,  $model->qty, $_POST['order_id']);
			}
		}else{
			$product = Product::model()->findByPk($product_id);
			$discount_price = $product->calcDiscount(1);

			$model=new OrderDetail;
			$model->attributes=$_POST;
			$model->list_price = $product->list_price;
			
			/*discount di nolkan jika cusotmer bukan reguler*/
			if($orderModel->customer->name == "reguler"){			
				$model->unit_price = $discount_price;
			}else{
				$model->unit_price = $model->list_price;
			}

			$model->amount = $model->qty * $model->unit_price;
			$model->tax = $model->product->tax;
			$model->insert_date = date('Y-m-d H:i:s');

			if($orderModel->customer->name == "reguler"){
				$this->checkGifts($product_id, 1,$_POST['order_id']);
			}
		}

		if($model->save()){
			//Yii::app()->session['order_id_sess'] = $model->id;
			echo CJSON::encode(array('success'=>true, 'message'=>'', 'orderDetail'=>$model));
		}else{
			echo CJSON::encode(array('success'=>false, 'message'=>$model->getErrors() ));			
		}			

		Yii::app()->end();
	}

	public function actionJdelete(){
		Yii::app()->regkey->cekReg();

		$id = $_POST['id'];
		$model = $this->loadModel($id);

		if($model->delete()){
			echo CJSON::encode(array('success'=>true));
		}else{
			echo CJSON::encode(array('success'=>failed));
		}

		Yii::app()->end();
	}

	public function checkGifts($product_id, $qty, $order_id){

		$product = Product::model()->findByPk($product_id);

		if ($product->productGifts)
		{
			foreach ($product->productGifts as $i => $productGift) 
			{
				//var_dump($qty%$productGift->buy_qty==0);die;
				if ($qty >= $productGift->buy_qty  && $productGift->enable==1)
				{
					/***************************************************************
					kalkulasi qty gift: kelipatan buy_qty
					***************************************************************/
					$gift_qty = floor($qty /  $productGift->buy_qty );
					$gift_product_id =  $productGift->gift_product_id;
					$gift_product  	 = Product::model()->findByPk($gift_product_id);

					/***************************************************************
					cek udah ada gift??
					***************************************************************/
					$model = OrderDetail::model()->find('product_id=:p and order_id=:o and unit_price=0', 
						array('p'=>$gift_product_id, 'o'=>$order_id));

					/***************************************************************
					kalau belum  :insert gift 
					***************************************************************/
					if(!$model){
						$model=new OrderDetail;
						$data = array(
							'order_id'   => $order_id,
							'product_id' => $gift_product_id ,
							'qty'        => $gift_qty ,
							'list_price' => $gift_product->list_price,
							'unit_price' => 0,
							'amount'     => 0
						);
					}
					/***************************************************************
					kalau udah ada: update qty gift
					***************************************************************/
					else{
						$data = array(
							'qty'        => $gift_qty ,
						);
					}

					$model->attributes=$data;
					if(! $model->save()){
						echo 'failed:';
						die(var_dump($model->getErrors()) );
					}
				}else{
					/***************************************************************
					cek udah ada gift?? kalo ada delete
					***************************************************************/
					$model = OrderDetail::model()->find('product_id=:p and order_id=:o and unit_price=0', 
						array('p'=>$productGift->gift_product_id, 'o'=>$order_id));
					if($model){
						if(!$model->delete()){
							echo 'failed:';
							die(var_dump($model->getErrors()) );
						}
					}
				}
			}
		}
		return true ;

	}

	public function actionJupdate(){
		Yii::app()->regkey->cekReg();

		$id = $_POST['id'];
		$qty = $_POST['qty'];
		$unit_price = $_POST['unit_price'];


		$model = $this->loadModel($id);
		$product = Product::model()->findByPk($model->product_id);
		$discount_price = $product->calcDiscount($qty);

		if($model){
			$model->qty = $qty;
			$model->list_price = $product->list_price;			
			$model->unit_price = $discount_price;
			$model->amount = $model->qty * $model->unit_price;
			if($model->save()){
				$this->checkGifts($model->product_id, $qty, $model->order_id);
				echo CJSON::encode(array('success'=>true, 'message'=>'', 'orderDetail'=>$model));
			}else{
				echo CJSON::encode(array('success'=>false, 'message'=>$model->getErrors() ));			
			}			
		}

		Yii::app()->end();
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		Yii::app()->regkey->cekReg();
		$model=$this->loadModel($id);

		if(isset($_POST['OrderDetail']))
		{
			$model->attributes=$_POST['OrderDetail'];
			$model->amount = $model->qty * $model->unit_price;
			if($model->save()){
				$this->redirect(array(
					'/order/view',
					'id'=>Yii::app()->session['order_id'])
				);
			}
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
		Yii::app()->regkey->cekReg();
		$model = $this->loadModel($id);

		/***************************************************************
		cek apakah punya gift?? kalo ada delete
		***************************************************************/
		$product = Product::model()->findByPk($model->product_id);
		if ($product->productGifts)
		{
			foreach ($product->productGifts as $i => $productGift) 
			{
				$gift = OrderDetail::model()->find('product_id=:p and order_id=:o and unit_price=0', 
					array('p'=>$productGift->gift_product_id, 'o'=>$model->order_id));
				if($gift){
					if(!$gift->delete()){
						echo 'failed:';
						die(var_dump($gift->getErrors()) );
					}
				}
			}
		}

		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))

			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->regkey->cekReg();
		$dataProvider=new CActiveDataProvider('OrderDetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->regkey->cekReg();
		$model=new OrderDetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OrderDetail']))
			$model->attributes=$_GET['OrderDetail'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrderDetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OrderDetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OrderDetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDeliver(){
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$model->status = ORDER_DETAIL_DELIVERED;

		if($model->save()){
			/*delete notification*/
			Notification::model()->findByAttributes(array('order_detail_id'=>$id))->delete();
			
			echo CJSON::encode(array('success'=>true));
		}else{
			echo CJSON::encode(array('success'=>failed));
		}

		Yii::app()->end();
	}

	public function actionSearchNote($id){
		$model = $this->loadModel($id);

		echo json_encode(array('note'=>$model->note));
	}

	public function actionSaveNote(){
		if(isset($_POST['id']) && isset($_POST['note'])){
			$model = $this->loadModel($_POST['id']);
			$model->note = $_POST['note'];
			if($model->save()){
				echo json_encode(array('response'=>true));
			}
		}
	}

	public function actionCheck($id){
		$data = explode("_", $id);
		
		$table_id  	= $data[0]; 
		$id  		= $data[1];
		
		$model = $this->loadModel($id);

		$result = array(
			'id' 		 	 => $table_id,
			'order_detail_id'=> $model->id,
			'order_id'		 => $model->order_id,
			'product_id' 	 => $model->product_id,
			'unit_price' 	 => $model->unit_price,
			'list_price'	 => $model->list_price,
		);

		echo json_encode($result);
	}

	public function actionDeliverAll(){
		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$orderModel = Order::model()->findByPk($id);
			if($orderModel->orderDetails){
				foreach ($orderModel->orderDetails as $od) {
					if($od->status == ORDER_DETAIL_DONE){
						$od->status = ORDER_DETAIL_DELIVERED;
						$od->save();

						/*delete notification*/
						Notification::model()->findByAttributes(array('order_detail_id'=>$od->id))->delete();
					}
				}
			}
			echo CJSON::encode(array('success'=>true));
		}
	}
}
