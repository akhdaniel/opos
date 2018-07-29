<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');

class RestoOrderController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array(
					'index',
					'view',
					'recreateUnpostedOeOrders',
				),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'create',
					'update',
					'delete',
					'jview', 
					'post', 
					'return',
					'printReceipt',
					'recreateOeOrder',
					'admin',
					'confirmOrder',
					'printBill',
					'kitchen',
					'setProgress',
					'joinTable',
					'splitTable',
					'proccessSplit',
					'productList'
				),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
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
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
		$oe_summary_mode = $as->val;

		Yii::app()->session['order_id'] = $id;
		
		$modelOrderDetail=new OrderDetail('search');
		$modelOrderDetail->order_id=$id;

		$modelOrderPayment=new OrderPayment('search');
		$modelOrderPayment->order_id=$id;

		$modelProduct=new Product('search');
		$modelProduct->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];

		$modelPaymentType = PaymentType::model()->findAll(array('order'=>'sorting asc'));

		$this->layout='//layouts/resto';

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'modelOrderDetail'=>$modelOrderDetail,			
			'modelOrderPayment'=>$modelOrderPayment,			
			'modelPaymentType'=>$modelPaymentType,		
			'oe_summary_mode'=>$oe_summary_mode,	
			'modelProduct'=>$modelProduct
		));
	}

	public function actionJview($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=$this->loadModel($id);

		$modelOrderDetail= OrderDetail::model()->findAll('order_id=:order_id', array('order_id'=>$id));
		$modelOrderPayment= OrderPayment::model()->findAll('order_id=:order_id', array('order_id'=>$id));

		$data = array(
			'success'=>true,
			'model'=>$model,
			'total'=>$model->total,
			'totalListPrice'=>$model->totalListPrice,
			'totalDiscount'=>$model->totalDiscount,
			'modelOrderDetail'=>$modelOrderDetail,			
			'modelOrderPayment'=>$modelOrderPayment,			
		);

		echo CJSON::encode($data);
		Yii::app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		if (! Yii::app()->session['session_id']){
			Yii::app()->user->setFlash('error',"No session, Create one first or Click the existing OPEN Session.");
			$this->redirect(array('/session/index'));
		}

		$model=new Order;
		$ref = 'Order/'.date("YmdHis");
		$model->number = $ref;
		$model->notes = $model->getNumber();
		$model->order_date = date("Y-m-d H:i:s");
		$model->salesman_id = Yii::app()->user->id ;
		$model->state=ORDER_NEW;
		$model->total_paid=0;
		$model->total_change=0;
		$model->session_id=Yii::app()->session['session_id'];

		if($model->save())
			$this->redirect(array('view','id'=>$model->id));

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

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
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
		//$this->loadModel($id)->delete();
		$model = $this->loadModel($id);
		$model->state = ORDER_CANCEL;
		$model->save();
		Yii::app()->user->setFlash('success', 'Order cancelled successfuly');


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		$this->redirect(array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$this->redirect(array('admin'));

		// $this->layout='//layouts/column1';
		// $model=new Order('search');
		// $model->unsetAttributes();  // clear any default values
		// if(isset($_GET['Order']))
		// 	$model->attributes=$_GET['Order'];

		// $this->render('admin',array(
		// 	'model'=>$model,
		// ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(isset(Yii::app()->session['session_id'])){
			Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
			$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
			$oe_summary_mode = $as->val;

			$model=new Order('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Order']))
				$model->attributes=$_GET['Order'];
			else
				$model->session_id = Yii::app()->session['session_id'];

			$this->render('admin',array(
				'model'=>$model,
				'oe_summary_mode'=>$oe_summary_mode
			));
		}else{
			$this->redirect(array('/site/list_session'));
		}
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Order the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Order::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Order $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionPost(){
		echo "post to openerp";
	}

	public function actionPrintReceiptCmd($id){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=Order::model()->findByPk($id);

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;


		$receipt = $this->renderPartial('_receipt',array(
			'model'=>$model,
			'shop_name'=>$shop_name
		), true);

		$as = AppSetting::model()->findOrCreate('tmp_dir','/tmp');
		$tmp_dir = $as->val;

		$filename = $tmp_dir  . 'reciept.txt';
		$fp = fopen($filename, 'wb');
		fwrite($fp, $receipt);
		fclose($fp);

		$as = AppSetting::model()->findOrCreate('print_cmd','copy /b');
		$print_cmd = $as->val;

		$as = AppSetting::model()->findOrCreate('printer_port','com1:');
		$printer_port = $as->val;
		
		$cmd = $print_cmd . " $filename " . $printer_port;
		@system($cmd);

		Yii::app()->user->setFlash('success','Receipt Printed');
		$this->redirect(array('/order/view', 'id'=>$id));

	}

	public function actionPrintReceipt($id){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=Order::model()->findByPk($id);

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;
		$as = AppSetting::model()->findOrCreate('company_name',"KOKARFI");
		$company_name = $as->val;

		$receipt = $this->renderPartial('_receipt',array(
			'model'=>$model,
			'shop_name'=>$shop_name,
			'company_name'=>$company_name,
		), true);

		$windows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ;
		if($windows)
		{
			$as = AppSetting::model()->findOrCreate('printer_name','pos');
			$printer_name = $as->val;
			$printer = new PosPrinter($printer_name);
			$ret = $printer->send($receipt, $shop_name, $company_name);
		}
		else
		{
			$as = AppSetting::model()->findOrCreate('tmp_dir','/tmp');
			$tmp_dir = $as->val;

			$filename = $tmp_dir  . 'reciept.txt';
			$fp = fopen($filename, 'wb');
			fwrite($fp, $receipt);
			fclose($fp);

			$as = AppSetting::model()->findOrCreate('print_cmd','cp');
			$print_cmd = $as->val;

			$as = AppSetting::model()->findOrCreate('printer_port','/dev/tty00');
			$printer_port = $as->val;
			
			$cmd = $print_cmd . " $filename " . $printer_port;
			@system($cmd);			
		}


		Yii::app()->user->setFlash('success','Receipt Printed');
		$this->redirect(array('/order/view', 'id'=>$id));

	}

	/**
	 * create OE pos.order data
	 * @param CModel the model to be created on OpenERP
	 */

	public function actionRecreateOeOrder($id){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$order = Order::model()->findByPk($id);
		$oe_id = Order::createOeOrder($order);
		if($oe_id>0){
			Yii::app()->user->setFlash('success','OE Order Recreated with ID:' . $oe_id);
		}
		else
		{
			Yii::app()->user->setFlash('error','OE Order create Failed, please check network connection and OE server is running. Try again.');
		}
		$this->redirect(array('view','id'=>$order->id));

	}	

	/******************************************************************
	recreate all orders yang belum diposting ke OE
	ditandai dengan oe_id = null dan status=PAID
	*****************************************************************/
	public function actionRecreateUnpostedOeOrders()
	{
		
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();$start = time();
		$cron = isset($_GET['cron']);
		$limit = isset($_GET['limit'])?$_GET['limit']:100;

		$msg = 'no active session';
		if($cron){
			//find active session, pasti 1 session karena 1 POS punya 1 orang kasir
			$session = Session::model()->find('state=:state', array('state'=>SESSION_OPEN));
			if(!$session){
				echo CJSON::encode( array('status'=>'error', 'msg'=>$msg));
				die;
			}
			$session_id = $session->id;
			Yii::app()->session['session_id']  = $session_id;

			//loginin 
			$as = AppSetting::model()->findOrCreate('openerp_admin_user','master.kokarfi');
			$admin_user		= $as->val;

			$as = AppSetting::model()->findOrCreate('openerp_admin_pwd','1');
			$admin_pwd		= $as->val;

			list($oe, $userId) = oeLogin($admin_user, $admin_pwd);
			if(!$oe){
				$msg = 'OpenERP login failed!';
				echo CJSON::encode( array('status'=>'error', 'msg'=>$msg));
				die;				
			}
			Yii::app()->session['oe_password'] = $admin_pwd;	
			Yii::app()->session['oe_userid']   = $userId;	
			Yii::app()->session['oe']          = $oe;	

		}
		else{
			$session_id = Yii::app()->session['session_id'];
			if(!$session_id){
				Yii::app()->user->setFlash('error', $msg );
				$this->redirect(array('index'));
			}
		}


		//$orders = Order::model()->findAll('state="PAID" and (oe_id is null or oe_id=0) and session_id=:sid', 
		//	array('sid'=>$session_id ));
		$orders = Order::model()->findAll(array(
		    "condition" => 'state="PAID" and (oe_id is null or oe_id=0) and session_id=' . $session_id,
		    "order" => "id ASC",
		    "limit" => $limit,
		));

		$i=0;
		foreach($orders as $order){
			$oe_id = Order::createOeOrder($order);	
			if($oe_id>0)
				$i++;
		}

		$end = time();
		$delta = $end-$start;

		if($i>0){
			$msg = $i . ' OE Order Re-created in ' . ($delta/60) . ' min(s)';
			if($cron){
				echo CJSON::encode(array('status'=>'success', 'msg'=>$msg)) ;
				die;
			}
			else{
				Yii::app()->user->setFlash('success',$msg );
			}
		}
		else{
			$msg = 'No new OE Order Re-created';
			if($cron){
				echo CJSON::encode(array('status'=>'error', 'msg'=>$msg)) ;
				die;
			}
			else{
				Yii::app()->user->setFlash('error', $msg );
			}
		}
		$this->redirect(array('index'));
	}

	/**
	 * Return a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionReturn($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$old=$this->loadModel($id);

		$admin_pwd = isset($_GET['admin_pwd'])?$_GET['admin_pwd']:'';
		if (!$admin_pwd){
			Yii::app()->user->setFlash('error','Please enter admin password to continue');			
			$this->redirect(array('view','id'=>$old->id));
		}

		if ( !$this->cekAdminPwd($admin_pwd) ){
			Yii::app()->user->setFlash('error','Incorrect admin password, please try again');			
			$this->redirect(array('view','id'=>$old->id));
		}


		/* header */
		$model=new Order;
		$model->number = 'Unposted Return/'.date("YmdHis");
		$model->order_date = date("Y-m-d H:i:s");
		$model->salesman_id = Yii::app()->user->id ;
		$model->state=ORDER_NEW;
		$model->total_paid=0;
		$model->total_change=0;
		$model->notes='Return ' . $old->notes;
		$model->session_id=Yii::app()->session['session_id'];

		if(!$model->save()){
			die('error save order');
		}

		/* details */
		foreach ($old->orderDetails as $od){
			$newOd = new OrderDetail;
			$newOd->product_id  = $od->product_id;
			$newOd->order_id    = $model->id;
			$newOd->qty         = -$od->qty;
			$newOd->unit_price  = $od->unit_price;
			$newOd->amount      = $newOd->qty * $newOd->unit_price;
			$newOd->tax 		= $od->tax;
			if(!$newOd->save()){
				die('error save order detail');
			}
		}


		$this->redirect(array('view','id'=>$model->id));
	}

	function cekAdminPwd($password){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$as = AppSetting::model()->findOrCreate('admin_pwd',md5('1') );
		$admin_pwd			= $as->val;
		if($admin_pwd == md5($password) )
			return true;
		else
			return false ;
	}

	public function actionConfirmOrder(){
		if(isset($_POST['Order'])){
			$model = $this->loadModel($_POST['Order']['id']);

			/*reset table*/
			if($model->table_id != 0){
				$tableModel = Table::model()->findByPk($model->table_id);
				$tableModel->status = 1;
				$tableModel->save();
			}

			$model->table_id= $_POST['Order']['table_id'];
			$model->order_notes = $_POST['Order']['order_notes'];
			$model->state 	= ORDER_CONFIRM;	

			if($model->save()){
				$tableModel = Table::model()->findByPk($model->table_id);
				$tableModel->status = 0;
				$tableModel->save();

				$countOrderDetail = count(OrderDetail::model()->findAllByAttributes(array('order_id'=>$model->id, 'is_print'=>0))); 
				if($countOrderDetail > 0){
					$this->printListKitchen($model->id);
				}
			}

			$this->redirect(array('admin'));
		}
	}

	public function printListKitchen($id){
		$model=Order::model()->findByPk($id);

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;
		$as = AppSetting::model()->findOrCreate('company_name',"KOKARFI");
		$company_name = $as->val;

		$product = array();
		foreach($model->orderDetails as $i=>$od){
			if($od->is_print == 0){
				$product[] = array(
					'name'=> $od->product->name,
					'qty'=> $od->qty,
				);

				$od->is_print = 1;
				$od->save();
			}
		}	

		$receipt = $this->renderPartial('_print_kitchen',array(
			'model'=>$model,
		), true);

		$windows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ;
		if($windows)
		{
			$as = AppSetting::model()->findOrCreate('kitchen_printer_name','pos');
			$printer_name = $as->val;
			$printer = new PosPrinter($printer_name);
			$ret = $printer->send($receipt, $shop_name, $company_name);
		}
		else
		{
			$as = AppSetting::model()->findOrCreate('tmp_dir','/tmp');
			$tmp_dir = $as->val;

			$filename = $tmp_dir  . 'reciept.txt';
			$fp = fopen($filename, 'wb');
			fwrite($fp, $receipt);
			fclose($fp);

			$as = AppSetting::model()->findOrCreate('print_cmd','cp');
			$print_cmd = $as->val;

			$as = AppSetting::model()->findOrCreate('kitchen_printer_port','/dev/tty00');
			$printer_port = $as->val;
			
			$cmd = $print_cmd . " $filename " . $printer_port;
			@system($cmd);			
		}
	}

	public function actionPrintBill($id){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=Order::model()->findByPk($id);

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;
		$as = AppSetting::model()->findOrCreate('company_name',"KOKARFI");
		$company_name = $as->val;

		$receipt = $this->renderPartial('_print_bill',array(
			'model'=>$model,
			'shop_name'=>$shop_name,
			'company_name'=>$company_name,
		), true);

		$windows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ;
		if($windows)
		{
			$as = AppSetting::model()->findOrCreate('printer_name','pos');
			$printer_name = $as->val;
			$printer = new PosPrinter($printer_name);
			$ret = $printer->send($receipt, $shop_name, $company_name);
		}
		else
		{
			$as = AppSetting::model()->findOrCreate('tmp_dir','/tmp');
			$tmp_dir = $as->val;

			$filename = $tmp_dir  . 'reciept.txt';
			$fp = fopen($filename, 'wb');
			fwrite($fp, $receipt);
			fclose($fp);

			$as = AppSetting::model()->findOrCreate('print_cmd','cp');
			$print_cmd = $as->val;

			$as = AppSetting::model()->findOrCreate('printer_port','/dev/tty00');
			$printer_port = $as->val;
			
			$cmd = $print_cmd . " $filename " . $printer_port;
			@system($cmd);			
		}

		echo json_encode(array('status'=>true));
	}

	public function actionKitchen(){
		$criteria = new CDbCriteria();
		$criteria->with = array('order');
		$criteria->condition = 'order.state in ("'.ORDER_CONFIRM.'") and status not in ("'.ORDER_DETAIL_DONE.'","'.ORDER_DETAIL_DELIVERED.'")';
		
		$model = new CActiveDataProvider('OrderDetail', array(
        	'criteria' => $criteria,
            'sort'=> false,
            'pagination' => array(
               'pagesize' => 30,
            ),
        )); 

		$this->render('kitchenList', array(
			'model'=> $model,
		));
	}

	public function actionProductList(){
		/*$model = new CActiveDataProvider('Product', array(
            'sort'=> false,
            'pagination' => array(
               'pagesize' => 10,
            ),
        )); */
		
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('productList',array(
			'model'=>$model,
		));
	}

	public function actionSetProgress(){
		if(isset($_POST['id'])){
			$model = OrderDetail::model()->findByPk($_POST['id']);

			if($_POST['type'] == 1){
				$model->status = 2;
			}elseif($_POST['type'] == 2){
				$model->status = 3;

				$notif = new Notification;
				$notif->order_id = $model->order_id;
				$notif->order_detail_id = $model->id;
				$notif->product_id = $model->product_id;
				$notif->qty = $model->qty;
				$notif->id = 0;
				$notif->save();
			}else{
				$model->status = 4;
			}

			if($model->save()){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('success'=>false));
			}
		}
	}

	public function actionJoinTable(){
		$criteria = new CDbCriteria();
		$criteria->condition = 'state in ("'.ORDER_NEW.'","'.ORDER_CONFIRM.'")';
		$model = Order::model()->findAll($criteria);
		
		if(isset($_POST['Order'])){
			$destination = $_POST['Order']['destination'];

			foreach($_POST['Order']['source'] as $source){
				if($source != $destination){
					$od = OrderDetail::model()->findAllByAttributes(array('order_id'=>$source));

					if($od){
						foreach ($od as $o) {
							$o->order_id = $destination;
							$o->save();
						}

						$order = Order::model()->findByPk($source);
						$tableModel = Table::model()->findByPk($order->table_id);
						$tableModel->status = 1;
						$tableModel->save();
						$order->delete();
					}
				}
			}

			$this->redirect(array('admin'));
		}

		$this->render('joinTable', array(
			'model'=>$model
		));
	}

	public function actionSplitTable(){
		$criteria = new CDbCriteria();
		$criteria->condition = 'state in ("'.ORDER_NEW.'","'.ORDER_CONFIRM.'")';
		$model = Order::model()->findAll($criteria);

		$table = Table::model()->findAll('status = 1');

		$this->render('splitTable', array(
			'model'=>$model,
			'table'=>$table
		));
	}

	public function actionProccessSplit(){
		if(isset($_POST['Order'])){
			$order 			= Order::model()->findByPk($_POST['Order']['order_id']);
			$destination 	= Table::model()->findByPk($_POST['Order']['destination_table']);

			$criteria = new CDbCriteria();
			$criteria->condition = 'order_id='.$order->id;
			
			$orderDetailModel = new CActiveDataProvider('OrderDetail', array(
	        	'criteria' => $criteria,
	            'sort'=> false,
	            'pagination' => array(
	               'pagesize' => 100,
	            ),
	        ));

	        $this->render('proccessSplit', array(
	        	'order' => $order,
	        	'destination' => $destination,
	        	'orderDetailModel' => $orderDetailModel
	        )); 
		}

		if(isset($_POST['Od'])){
			/*create new order for this split*/
			$model=new Order;
			$ref  = 'Order/'.date("YmdHis");
			$model->number 		= $ref;
			$model->notes 		= $model->getNumber();
			$model->order_date 	= date("Y-m-d H:i:s");
			$model->salesman_id = Yii::app()->user->id ;
			$model->state 		= ORDER_CONFIRM;
			$model->total_paid 	= 0;
			$model->total_change= 0;
			$model->session_id 	= Yii::app()->session['session_id'];
			$model->table_id 	= $_POST['Od']['destination_table'];
			$model->save();

			foreach($_POST['Od']['orderdetailIds'] as $id){
				$odModel = OrderDetail::model()->findByPk($id);
				$odModel->order_id = $model->id;
				$odModel->save();
			}

			$this->redirect(array('admin'));
		}
	}
}
