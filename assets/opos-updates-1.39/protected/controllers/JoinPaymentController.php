<?php

class JoinPaymentController extends Controller
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
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'index',
					'view',
					'create',
					'update',
					'admin',
					'delete',
					'autocomplete',
					'findbycode',
					'getTotal',
					'validate'
				),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
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
		$model=new JoinPayment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JoinPayment']))
		{
			$model->attributes=$_POST['JoinPayment'];
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JoinPayment']))
		{
			$model->attributes=$_POST['JoinPayment'];
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
		$dataProvider=new CActiveDataProvider('JoinPayment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new JoinPayment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JoinPayment']))
			$model->attributes=$_GET['JoinPayment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return JoinPayment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=JoinPayment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param JoinPayment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='join-payment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAutocomplete(){
		Yii::app()->regkey->cekReg();
		$arr = array();

		if (isset($_GET['term']))
		{
			$term = $_GET['term'];
			
			if(AppSetting::model()->findOrCreate("pos_mode","retail")->val == "retail"){
				$criteria = new CDbCriteria();
				$criteria->addSearchCondition('number', $term, true, 'OR', 'LIKE' );
				$criteria->addCondition('session_id = '.Yii::app()->session['session_id']);
				$criteria->addCondition('state not in("'.ORDER_PAID.'","'.ORDER_CANCEL.'","'.ORDER_POSTED.'")');

				$models = Order::model()->findAll($criteria);
				foreach($models as $model)
				{
					$orderModel = JoinPaymentDetail::model()->findByAttributes(array('order_id'=>$model->id));

					if(!$orderModel){
						$arr[] = array(
					          'label'=> $model->number,  // label for dropdown list
					          'value'=>$model->number,  // value for input field
					          'id'=>$model->id,       // return value from autocomplete
						);
					}
				}
			}else{
				$criteria = new CDbCriteria();
				$criteria->with = array('table');
				$criteria->addSearchCondition('table.table_name', $term, true, 'OR', 'LIKE' );
				$criteria->addSearchCondition('number', $term, true, 'OR', 'LIKE' );
				$criteria->addCondition('table.id = table_id');
				$criteria->addCondition('session_id = '.Yii::app()->session['session_id']);
				$criteria->addCondition('state not in("'.ORDER_PAID.'","'.ORDER_CANCEL.'","'.ORDER_POSTED.'")');

				$models = Order::model()->findAll($criteria);
				foreach($models as $model)
				{
					$orderModel = JoinPaymentDetail::model()->findByAttributes(array('order_id'=>$model->id));

					if(!$orderModel){
						$arr[] = array(
					          'label'=> $model->table->table_name . ' [' . $model->number . ']' ,  // label for dropdown list
					          'value'=>$model->number,  // value for input field
					          'id'=>$model->id,       // return value from autocomplete
						);
					}
				}
			}
		}
		echo CJSON::encode($arr);
		Yii::app()->end();	
	}

	public function actionFindByCode()
	{
		Yii::app()->regkey->cekReg();
		$code 	= $_GET['code'];
		$join_id= $_GET['join_payment_id'];
		$model = Order::model()->find('number=:number', array('number'=>$code));

		if (!$model) {
			echo CJSON::encode(array('success'=>false, 'message'=>'Product not found, please Sync from Server', 'product'=>''));
		}else{
			$joinPaymenDetail = new JoinPaymentDetail;
			$joinPaymenDetail->join_payment_id= $join_id;
			$joinPaymenDetail->order_id 	  = $model->id;
			$joinPaymenDetail->amount 	  	  = $model->total;

			if($joinPaymenDetail->save()){
				echo CJSON::encode(array('success'=>true));			
			}
		}
		Yii::app()->end();
	}

	public function actionGetTotal(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];

			$total = Yii::app()->db->createCommand()
			    ->select('sum(amount) as s')
			    ->from('join_payment_detail')
			    ->where('join_payment_detail.join_payment_id=:id', array(':id'=>$id,))
			    ->queryRow();

			$totalDue = $total['s'] == null?0:$total['s'];
			echo CJSON::encode(array('success'=>true, 'total'=>$totalDue));
		}
	}

	public function actionValidate(){
		$join_payment_id= $_POST['join_payment_id'];
		$amount_paids 	= $_POST['amount_paids'];
		$card_nos	 	= $_POST['card_nos'];
		$total_due	 	= $_POST['total_due'];
		$total_paid 	= $_POST['total_paid'];

		$modelJoinPayment = JoinPayment::model()->findByPk($join_payment_id);
		$joinDetails = $modelJoinPayment->joinPaymentDetails;

		foreach ($joinDetails as $joinDetail) {
			$orderModel = Order::model()->findByPk($joinDetail->order_id);
			
			/*********************************************************************
			* update status Order menjadi paid
			* total_paid
			* total_change
			*********************************************************************/
			$orderModel->total_paid = $orderModel->total;
			$orderModel->total_change = 0;
			$orderModel->state = ORDER_PAID;
			$orderModel->order_notes = "Join Payment No ".$modelJoinPayment->join_number;
			$orderModel->save();

			/*********************************************************************
			* update status order detail to paid
			*********************************************************************/
			foreach($orderModel->orderDetails as $modelOrderDetail){
				$modelOrderDetail->paid_status = 'PAID';
				$modelOrderDetail->save();
			}

			/*********************************************************************
			* kosongkan meja pelanggan
			*********************************************************************/
			if($orderModel->table_id > 0){
				$tableModel = Table::model()->findByPk($orderModel->table_id);
				$tableModel->status = 1;
				$tableModel->save();
			}
		}

		/*********************************************************************
		* looping semua jenis pembayaran 
		* masukkan ke join payment payment
		*********************************************************************/
		foreach ($amount_paids as $payment_type_id => $amount) {
			$jpp = new JoinPaymentPayment;
			$jpp->join_payment_id	= $join_payment_id;
			$jpp->payment_type_id	= $payment_type_id;
			$jpp->amount			= str_replace(",","",$amount);
			$jpp->card_no			= $card_nos[$payment_type_id];
			$jpp->save();
		}

		
		/*********************************************************************
		kalau ada change, masukkkan ke payment cash , nilai minus
		*********************************************************************/
		$change = $total_paid - $total_due;
		if ($change > 0){
			$payment_type = PaymentType::model()->findByAttributes( array('type'=>'cash') );

			$jpp = new JoinPaymentPayment;
			$jpp->join_payment_id	= $join_payment_id;
			$jpp->payment_type_id	= $payment_type->id;
			$jpp->amount			= -$change;
			$jpp->card_no			= 'return';
			$jpp->save();
		}

		$modelJoinPayment->total_paid = $total_paid;
		$modelJoinPayment->total_change = $total_paid - $total_due; 
		$modelJoinPayment->state = JOIN_PAID;
		$modelJoinPayment->save();

		/*print struck below*/
		$this->printJoinPayment($join_payment_id);

		Yii::app()->user->setFlash('success','All orders has been paid, receipt printed');
		$this->redirect(array('/order/joinPayment', 'id'=>$join_payment_id));
	}

	public function printJoinPayment($id){
		$model = JoinPayment::model()->findByPk($id);

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;
		$as = AppSetting::model()->findOrCreate('company_name',"KOKARFI");
		$company_name = $as->val;
		$as = AppSetting::model()->findOrCreate("pos_mode","retail");
		$pos_mode = $as->val;


		$receipt = $this->renderPartial('_receipt',array(
			'model'=>$model,
			'shop_name'=>$shop_name,
			'company_name'=>$company_name,
			'pos_mode'=>$pos_mode
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
	}
}
