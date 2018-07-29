<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');

class OrderController extends Controller
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
					'splitPayment',
					'printReceiptSplit',
					'createJoinPayment',
					'joinPayment',
					'cekAdminPwd',
					'changeCustomer',
					'checkDiscount'
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
		Yii::app()->regkey->cekReg();
		$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
		$oe_summary_mode = $as->val;

		$discount_enable = AppSetting::model()->findOrCreate('special_discount','1')->val;

		Yii::app()->session['order_id'] = $id;

		$modelOrder = $this->loadModel($id);
		
		$modelOrderDetail=new OrderDetail('search');
		$modelOrderDetail->order_id=$id;

		if($modelOrder->state == ORDER_NEW || $modelOrder->state == ORDER_CONFIRM){
			$modelOrderDetail->paid_status = 'UNPAID';
		}else{
			$modelOrderDetail->paid_status = 'PAID';
		}
		

		$modelOrderPayment=new OrderPayment('search');
		$modelOrderPayment->order_id=$id;

		$modelPaymentType = PaymentType::model()->findAll(array('order'=>'sorting asc'));

		$this->layout='//layouts/column1';

		$this->render('view',array(
			'model'=>$modelOrder,
			'modelOrderDetail'=>$modelOrderDetail,			
			'modelOrderPayment'=>$modelOrderPayment,			
			'modelPaymentType'=>$modelPaymentType,		
			'oe_summary_mode'=>$oe_summary_mode,
			'discount_enable'=>$discount_enable	
		));
	}

	public function actionJview($id)
	{
		Yii::app()->regkey->cekReg();
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
		Yii::app()->regkey->cekReg();
		if (! Yii::app()->session['session_id']){
			Yii::app()->user->setFlash('error',"No session, Create one first or Click the existing OPEN Session.");
			$this->redirect(array('/session/admin'));
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
		Yii::app()->regkey->cekReg();
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
		Yii::app()->regkey->cekReg();
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
		Yii::app()->regkey->cekReg();
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
		Yii::app()->regkey->cekReg();
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
		Yii::app()->regkey->cekReg();
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

	public function actionPrintReceipt(){
		Yii::app()->regkey->cekReg();

		$id 		= $_GET['id'];
		$split_num 	= isset($_GET['split_num'])?$_GET['split_num']:1;
		$split_due 	= isset($_GET['split_due'])?$_GET['split_due']:null;

		$model=Order::model()->findByPk($id);

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;
		$as = AppSetting::model()->findOrCreate('company_name',"KOKARFI");
		$company_name = $as->val;

		$receipt = $this->renderPartial('_receipt',array(
			'model'=>$model,
			'shop_name'=>$shop_name,
			'company_name'=>$company_name,
			'split_num'=>$split_num,
			'split_due'=>$split_due,
		), true);

		$windows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ;
		if($windows)
		{
			for($i = 1; $i <= $split_num; $i++){
				$as = AppSetting::model()->findOrCreate('printer_name','pos');
				$printer_name = $as->val;
				$printer = new PosPrinter($printer_name);
				$ret = $printer->send($receipt, $shop_name, $company_name);
			}
		}
		else
		{
			for($i = 1; $i <= $split_num; $i++){
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
		}


		Yii::app()->user->setFlash('success','Receipt Printed');
		$this->redirect(array('/order/view', 'id'=>$id));

	}

	/**
	 * create OE pos.order data
	 * @param CModel the model to be created on OpenERP
	 */

	public function actionRecreateOeOrder($id){
		Yii::app()->regkey->cekReg();
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
		
		Yii::app()->regkey->cekReg();$start = time();
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
		Yii::app()->regkey->cekReg();
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
		Yii::app()->regkey->cekReg();
		$as = AppSetting::model()->findOrCreate('admin_pwd',md5('1') );
		$admin_pwd			= $as->val;
		if($admin_pwd == md5($password) )
			return true;
		else
			return false ;
	}

	public function actionSplitPayment($id){
		Yii::app()->regkey->cekReg();
		$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
		$oe_summary_mode = $as->val;

		Yii::app()->session['order_id'] = $id;
		
		/*$modelOrderDetail=new OrderDetail('search');
		$modelOrderDetail->order_id=$id;
		$modelOrderDetail->paid_status = 'UNPAID';

		echo "<pre/>";
		var_dump($modelOrderDetail);die;*/

		/*populate data for order detail*/
		$modelOrderDetail = array();
		$modelOD = OrderDetail::model()->findAllByAttributes(array('order_id'=>$id, 'paid_status'=>UNPAID));
		$number = 1;
		if($modelOD){
			foreach ($modelOD as $mod) {
				if($mod->qty == 1){
					$modelOrderDetail[] = array(
						'id'=>$number++,
						'order_detail_id'=>$mod->id,
						'order_id'=>$mod->order_id,
						'product_id'=>$mod->product_id,
						'item_code'=>$mod->product->default_code,
						'product_name'=>$mod->product->name,
						'list_price'=>$mod->list_price,
						'unit_price'=>$mod->unit_price,
						'tax'=>$mod->tax,
						'status'=>$mod->status,
						'paid_status'=>$mod->paid_status,
						'is_print'=>$mod->is_print,
					);
				}else{
					for($i=1;$i<=$mod->qty;$i++){
						$modelOrderDetail[] = array(
							'id'=>$number++,
							'order_detail_id'=>$mod->id,
							'order_id'=>$mod->order_id,
							'product_id'=>$mod->product_id,
							'item_code'=>$mod->product->default_code,
							'product_name'=>$mod->product->name,
							'list_price'=>$mod->list_price,
							'unit_price'=>$mod->unit_price,
							'tax'=>$mod->tax,
							'status'=>$mod->status,
							'paid_status'=>$mod->paid_status,
							'is_print'=>$mod->is_print,
						);
					}
				}
			}
		}

		$dataProvider=new CArrayDataProvider($modelOrderDetail, array(
		    'id'=>'splitItem',
		    'keyField'=>'id',
		    'sort'=>array(
		        'attributes'=>array(
		            'id', 'order_detail_id', 'order_id', 'product_id', 'item_code', 'product_name', 'unit_price', 'tax', 'status', 'paid_status', 'is_print'
		        ),
		    ),
		    'pagination'=>false
		));

		/*populate data for order payment and payment type*/
		$modelOrderPayment=new OrderPayment('search');
		$modelOrderPayment->order_id=$id;

		$modelPaymentType = PaymentType::model()->findAll(array('order'=>'sorting asc'));

		$this->layout='//layouts/column1';

		$this->render('split_payment',array(
			'model'=>$this->loadModel($id),
			//'modelOrderDetail'=>$modelOrderDetail,			
			'modelOrderDetail'=>$dataProvider,			
			'modelOrderPayment'=>$modelOrderPayment,			
			'modelPaymentType'=>$modelPaymentType,		

			'oe_summary_mode'=>$oe_summary_mode	
		));
	}

	public function actionPrintReceiptSplit(){
		Yii::app()->regkey->cekReg();

		$id 			= $_GET['id'];
		$total_paid 	= $_GET['total_paid'];
		$od_ids 		= $_GET['od_ids'];
		$amount_paids 	= $_GET['amount_paids'];
		$toView 		= $_GET['toView'];
		$split_num 		= 1;
		

		$model=Order::model()->findByPk($id);

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;
		$as = AppSetting::model()->findOrCreate('company_name',"KOKARFI");
		$company_name = $as->val;

		/******************************************************************
		hitung sub total, discount total, dan total
		*****************************************************************/
		$sub_total = 0;
		$disc_total = 0;
		$total = 0;
		foreach($model->orderDetails as $od){
			if($od->paid_status == 'PAID' and in_array($od->id, $od_ids)){
				$sub_total += $od->list_price;
				$disc_total += ($od->list_price-$od->unit_price);
			}
		}

		$total = $sub_total-$disc_total;
		$change = $total_paid - $total;

		$receipt = $this->renderPartial('_receipt_split',array(
			'model'=>$model,
			'shop_name'=>$shop_name,
			'company_name'=>$company_name,
			'od_ids'=>$od_ids,
			'payments'=>$amount_paids,
			'sub_total'=>$sub_total,
			'disc_total'=>$disc_total,
			'total'=>$total,
			'total_paid'=>$total_paid,
			'change'=>$change
		), true);

		$windows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ;
		if($windows)
		{
			for($i = 1; $i <= $split_num; $i++){

				$as = AppSetting::model()->findOrCreate('printer_name','pos');
				$printer_name = $as->val;
				$printer = new PosPrinter($printer_name);
				$ret = $printer->send($receipt, $shop_name, $company_name);
			}
		}
		else
		{
			for($i = 1; $i <= $split_num; $i++){
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
		}


		Yii::app()->user->setFlash('success','Receipt Printed');

		if($toView == 1){
			$this->redirect(array('/order/view', 'id'=>$id));
		}else{
			$this->redirect(array('/order/splitPayment', 'id'=>$id));
		}
	}

	public function actionCreateJoinPayment(){
		Yii::app()->regkey->cekReg();
		if (!Yii::app()->session['session_id']){
			Yii::app()->user->setFlash('error',"No session, Create one first or Click the existing OPEN Session.");
			$this->redirect(array('/session/index'));
		}
		/*cek join payment yang open terlebih dahulu*/
		$join = JoinPayment::model()->findByAttributes(array('salesman_id'=>Yii::app()->user->id, 'session_id'=>Yii::app()->session['session_id'], 'state'=>JOIN_UNPAID));
		if($join){
			$this->redirect(array('joinPayment','id'=>$join->id));
		}else{
			$model=new JoinPayment;
			$model->join_number = $model->getNumberJoin();
			$model->join_date = date("Y-m-d H:i:s");
			$model->salesman_id = Yii::app()->user->id ;
			$model->state=JOIN_UNPAID;
			$model->total_paid=0;
			$model->total_change=0;
			$model->session_id=Yii::app()->session['session_id'];

			if($model->save())
				$this->redirect(array('joinPayment','id'=>$model->id));
		}
	}

	public function actionJoinPayment($id){
		$modelJoin = JoinPayment::model()->findByPk($id);

		$joinPaymentDetail = new JoinPaymentDetail('search');
		$joinPaymentDetail->join_payment_id = $id;

		$modelPaymentType = PaymentType::model()->findAll(array('order'=>'sorting asc'));

		$total = Yii::app()->db->createCommand()
			    ->select('sum(amount) as s')
			    ->from('join_payment_detail')
			    ->where('join_payment_detail.join_payment_id=:id', array(':id'=>$id,))
			    ->queryRow();

		$modelJoinPaymentPayment=new JoinPaymentPayment('search');
		$modelJoinPaymentPayment->join_payment_id=$id;

		$this->render('join_payment', array(
			'model'=>$modelJoin,
			'joinPaymentDetail'=>$joinPaymentDetail,
			'total'=>$total['s'],
			'modelPaymentType'=>$modelPaymentType,
			'modelJoinPaymentPayment'=>$modelJoinPaymentPayment
		));
	}

	public function actionCekAdminPwd()
	{
		if($_POST['password']){
			if($this->cekAdminPwd($_POST['password'])){
				echo json_encode(true);
			}else{
				echo json_encode(false);
			}
		}
	}

	public function actionChangeCustomer(){
		if($_POST['Order']){
			$model = $this->loadModel($_POST['Order']['id']);
			$model->customer_type = $_POST['Order']['customer_type'];
			
			if($model->customer->field == "cost_price"){
				$discount = 0;
				foreach($model->orderDetails as $m){
					$discount += ($m->product->cost_price * $m->qty); 
				}

				if($model->total == 0){
					$discount = 0;
				}else{
					$discount = $model->total - $discount;
				}
			}else{
				$discount = ($model->total * $model->customer->discount)/100;
			}

			$model->discount_special = $discount;
			$model->save();

			$this->redirect(array('view','id'=>$model->id));
		}
	}

	public function actionCheckDiscount(){
		if(isset($_POST['id'])){
			$model = $this->loadModel($_POST['id']);

			if($model->customer->field == "cost_price"){
				$discount = 0;
				foreach($model->orderDetails as $m){
					$discount += ($m->product->cost_price * $m->qty); 
				}

				if($model->total == 0){
					$discount = 0;
				}else{
					$discount = $model->total - $discount;
				}
			}else{
				$discount = ($model->total * $model->customer->discount)/100;
			}

			$model->discount_special = $discount;
			$model->save();

			echo json_encode($discount);
		}
	}
}
