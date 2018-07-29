<?php

class OrderPaymentController extends Controller
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
				'actions'=>array('create','update','validate','split','validateSplit'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new OrderPayment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrderPayment']))
		{
			$model->attributes=$_POST['OrderPayment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['OrderPayment']))
		{
			$model->attributes=$_POST['OrderPayment'];
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
		$dataProvider=new CActiveDataProvider('OrderPayment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=new OrderPayment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OrderPayment']))
			$model->attributes=$_GET['OrderPayment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrderPayment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OrderPayment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OrderPayment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-payment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	/**
	* validate Order Payment
	* send Order to OpenERP pos.order
	* update oe_id accordingly
	* 
	*/
	public function actionValidate()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		/*********************************************************************
		* POST vars
		* order_id
		* amount_paids: semua jenis pembayaran dan amount nya
		* card_nos    : semua nomor kartu per jenis pembayaran
		*********************************************************************/
		$order_id 		  = $_POST['order_id'];
		$amount_paids 	  = $_POST['amount_paids'];
		$card_nos	 	  = $_POST['card_nos'];
		$total_paid		  = 0;
		$split_due 		  = $_POST['split_due'];
		$split_num 		  = $_POST['split_num'];
		$discount_special = $_POST['discount_special'];

		/*********************************************************************
		* looping semua jenis pembayaran 
		* masukkan ke OrderPayment
		*********************************************************************/

		foreach ($amount_paids as $payment_type_id => $amount) {
			$op = new OrderPayment;
			$op['order_id'] 		= $order_id;
			$op['payment_type_id'] 	= $payment_type_id;
			$op['amount'] 			= str_replace(",","",$amount);
			$op['card_no'] 			= $card_nos[$payment_type_id];
			$total_paid				+= $op['amount'] ;
			if($op->save()){
				$success = true;
			}else{
				$success = false;
				$message = $op->getErrors();	
			}	
		}

		/*********************************************************************
		* update status Order menjadi paid
		* total_paid
		* total_change
		*********************************************************************/

		$order = Order::model()->findByPk($order_id);
		$total_due = $order->total - $discount_special;
		$order->state = ORDER_PAID;
		$order->discount_special = $discount_special;
		$order->total_paid = $order->total_paid + $total_paid;
		$order->total_change = $order->total_change + ($total_paid-$total_due);
		$order->save();

		/*********************************************************************
		update semua status pembayaran barang menjadi paid
		*********************************************************************/
		foreach($order->orderDetails as $od){
			$od->paid_status = 'PAID';
			$od->save();
		}

		/*********************************************************************
		kalau ada change, masukkkan ke payment cash , nilai minus
		*********************************************************************/
		$change = $total_paid-$total_due;
		if ($change > 0){
			$payment_type = PaymentType::model()->findByAttributes( array('type'=>'cash') );

			$op = new OrderPayment;
			$op['order_id'] 		= $order_id;
			$op['payment_type_id'] 	= $payment_type->id;	
			$op['amount'] 			= -$change;
			$op['card_no'] 			= 'return';
			if($op->save()){
				$success = true;
			}else{
				$success = false;
				$message = $op->getErrors();	
			}				
		}

		/*********************************************************************
		* kirim Order ke OpenERP
		* pos.order
		*   lines           = order detail
		*   statement_ids   = order payment
		* exec wf: paid
		* jika berhasil: update menjadi POSTED
		*********************************************************************/

		$as = AppSetting::model()->findOrCreate('create_order_online', 0);
		if ($as->val == 1){
			Order::createOeOrder($order);
		}

		/*set table to free*/
		if($order->table_id > 0){
			$tableModel = Table::model()->findByPk($order->table_id);
			$tableModel->status = 1;
			$tableModel->save();
		}

		/*********************************************************************
		* print receipt
		*********************************************************************/

		$this->redirect(array('/order/printReceipt', 'id'=>$order_id, 'split_num'=>$split_num, 'split_due'=>$split_due));

	}

	/**
	* validate Order Payment Split
	* send Order to OpenERP pos.order
	* update oe_id accordingly
	* 
	*/
	public function actionValidateSplit()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		/*********************************************************************
		* POST vars
		* order_id
		* amount_paids: semua jenis pembayaran dan amount nya
		* card_nos    : semua nomor kartu per jenis pembayaran
		*********************************************************************/
		$order_id 		= $_POST['order_id'];
		$amount_paids 	= $_POST['amount_paids'];
		$card_nos	 	= $_POST['card_nos'];
		$total_paid		= 0;
		$subtotal 		= $_POST['split_due'];
		//$split_num 		= $_POST['split_num'];
		$odi 			= $_POST['odi'];
		$oDI = array();

		/*********************************************************************
		* looping semua jenis pembayaran 
		* masukkan ke OrderPayment
		*********************************************************************/
		foreach ($amount_paids as $payment_type_id => $amount) {
			$op = new OrderPayment;
			$op['order_id'] 		= $order_id;
			$op['payment_type_id'] 	= $payment_type_id;
			$op['amount'] 			= str_replace(",","",$amount);
			$op['card_no'] 			= $card_nos[$payment_type_id];
			$total_paid				+= $op['amount'] ;
			if($op->save()){
				$success = true;
			}else{
				$success = false;
				$message = $op->getErrors();	
			}	
		}

		/*********************************************************************
		* update status order detail selected to paid
		*********************************************************************/
		foreach($odi as $order_detail_id){
			$id = explode("_", $order_detail_id);
			$modelOrderDetail = OrderDetail::model()->findByPk($id[1]);
			if($modelOrderDetail->qty == 1){
				$modelOrderDetail->paid_status = 'PAID';
				$modelOrderDetail->save();

				$oDI[] = $modelOrderDetail->id;
			}else{
				$modelOrderDetail->qty = $modelOrderDetail->qty - 1;
				$modelOrderDetail->amount = $modelOrderDetail->amount - $modelOrderDetail->list_price;
				$modelOrderDetail->save();

				$modelOD = new OrderDetail;
				$modelOD->order_id = $modelOrderDetail->order_id;
				$modelOD->product_id = $modelOrderDetail->product_id;
				$modelOD->qty = 1;
				$modelOD->unit_price = $modelOrderDetail->unit_price;
				$modelOD->list_price = $modelOrderDetail->list_price;
				$modelOD->amount = $modelOrderDetail->list_price;
				$modelOD->tax = $modelOrderDetail->tax;
				$modelOD->status = $modelOrderDetail->status;
				$modelOD->paid_status = 'PAID';
				$modelOD->is_print = $modelOrderDetail->is_print;
				$modelOD->insert_date = $modelOrderDetail->insert_date;
				$modelOD->save();

				$oDI[] = $modelOD->id;
			}
			
		}

		/*********************************************************************
		* check order detail status unpaid, jika sudah di paid semua, 
		* update status order menjadi paid
		*********************************************************************/
		$count = count(OrderDetail::model()->findAllByAttributes(array("order_id"=>$order_id, 'paid_status'=>'UNPAID')));
		
		/*********************************************************************
		* update status Order menjadi paid
		* total_paid
		* total_change
		*********************************************************************/
		$order = Order::model()->findByPk($order_id);
		$total_due = $subtotal;
		$order->total_paid = $order->total_paid + $total_paid;
		$order->total_change = $order->total_change + ($total_paid-$total_due);
		if($count == 0){
			$order->state = ORDER_PAID;
		}
		$order->save();

		/*********************************************************************
		* kosongkan meja pelanggan
		*********************************************************************/
		if($order->table_id > 0 && $count == 0){
			$tableModel = Table::model()->findByPk($order->table_id);
			$tableModel->status = 1;
			$tableModel->save();
		}

		/*********************************************************************
		kalau ada change, masukkkan ke payment cash , nilai minus
		*********************************************************************/
		$change = $total_paid - $total_due;
		if ($change > 0){
			$payment_type = PaymentType::model()->findByAttributes( array('type'=>'cash') );

			$op = new OrderPayment;
			$op['order_id'] 		= $order_id;
			$op['payment_type_id'] 	= $payment_type->id;	
			$op['amount'] 			= -$change;
			$op['card_no'] 			= 'return';
			if($op->save()){
				$success = true;
			}else{
				$success = false;
				$message = $op->getErrors();	
			}				
		}

		if($count == 0){
			$toView = 1;
		}else{
			$toView = 0;
		}
		/*********************************************************************
		* print receipt
		*********************************************************************/
		$this->redirect(array('/order/printReceiptSplit', 'id'=>$order_id, 'total_paid'=>$total_paid, 'od_ids'=>$oDI, 'amount_paids'=>$amount_paids, 'toView'=>$toView));

	}
}
