<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');

class SessionController extends Controller
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
				'actions'=>array('create',
					'update','close', 'admin',
					'openingControl',
					'closingControl',
					'openCashbox',
					'closeCashbox',
					'recreateOeSession',
					'recloseOeSession',
					'summaryPerCategoryReport',
					'summaryPerSalesmanReport',
					'summaryPerProductReport',
					'orderPerPaymentReport',
					'delete',
					'generateJournal',
					'autopost',
					'reportCategory',
					'reportProduct',
					'reportPayment',
					'waiterSelect'
				),
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
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		
		$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
		$oe_summary_mode = $as->val;

		$model = $this->loadModel($id);

		if ($oe_summary_mode == 0){
			if($model->state == SESSION_OPEN && $model->oe_id){
				Yii::app()->session['session_id']=$id; 
			}
			else{
				unset(Yii::app()->session['session_id']);
			}

		}
		else //glondongan mode
		{
			if($model->state == SESSION_OPEN){
				Yii::app()->session['session_id']=$id; 
			}
			else{
				unset(Yii::app()->session['session_id']);
			}
		}


		$this->render('view',array(
			'model'=>$model,
			'oe_summary_mode'=>$oe_summary_mode,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{	
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		/*
		oe_summary_mode = 1: kirim jurnal ketika akhir session close
		oe_summary_mode = 0: kirim detail POS order, cashbox, session 
		*/

		$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
		$oe_summary_mode = $as->val;

		if($oe_summary_mode == 0 ){
			/*
			cek OPEN dan CLOSED exist?
			harus POSTED dulu yang lama baru bisa open yang baru
			*/
			$exist = Session::model()->find('state in ("OPEN","CLOSED") and user_id=:sid', array('sid'=>Yii::app()->user->id));
			if($exist){
				if($exist->state == 'OPEN')
					Yii::app()->user->setFlash('error','You have pending OPEN Session '. CHtml::link($exist->name, $this->createUrl('/session/view', array('id'=>$exist->id)) ) .'. Please continue selling or close it before opening new one.' );
				else if($exist->state == 'CLOSED')
					Yii::app()->user->setFlash('error','You have pending UN-POSTED Session '. CHtml::link($exist->name, $this->createUrl('/session/view', array('id'=>$exist->id)) ).'. Please POST it before opening new one.' );
				$this->redirect(array('admin'));
			}			
		}
		else
		{
			/*
			cek OPEN exist?
			harus minimal CLOSED dulu yang lama baru bisa open yang baru
			*/

			$exist = Session::model()->find('state in ("OPEN") and user_id=:sid', 
				array('sid'=>Yii::app()->user->id));
			if($exist){
				if($exist->state == 'OPEN')
					Yii::app()->user->setFlash('error','You have pending OPEN Session '. CHtml::link($exist->name, $this->createUrl('/session/view', array('id'=>$exist->id)) ) .'. Please continue selling or close it before opening new one.' );
				$this->redirect(array('admin'));
			}
		}

		$model=new Session;

		if(isset($_POST['Session']))
		{
			$model->attributes=$_POST['Session'];
	
			if($model->save())
			{
				if($oe_summary_mode == 0){
					//create session dan bank statement di OE waktu "open" wf
					$session_id=Session::createOeSession($model);
					if($session_id >0){
						//update ID SessionPayment:
						SessionPayment::updateSessionPayment($model->id);
						//create cashbox lines
						Session::createCashbox($model);
						Yii::app()->user->setFlash('success','OE Session Created');
					}else{
						Yii::app()->user->setFlash('error','OE Session Failed. Please make sure that OpenERP connection is up and there is no other session open for the same Salesman' );					
					}
				}
				else
				{
					SessionPayment::createLocalSessionPayment($model->id);
					Session::createLocalCashbox($model);				
				}

				$this->redirect(array('openingControl','id'=>$model->id));
			}

		}

		$model->name = $model->getNumber();
		$model->open_date= date('Y-m-d H:i:s');
		$model->user_id = Yii::app()->user->id;
		$model->state = SESSION_OPENING_CONTROL;

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionRecreateOeSession($id){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		$model=$this->loadModel($id);

		//create session dan bank statement di OE waktu "open" wf
		$session_id = Session::createOeSession($model);
		if($session_id >0){
			//update ID SessionPayment:
			SessionPayment::updateSessionPayment($model->id);					
			Yii::app()->user->setFlash('success','OE Session Created');
		}else{
			Yii::app()->user->setFlash('error','OE Session create Failed, please check network connection and OE server is running.');					
		}

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

		if(isset($_POST['Session']))
		{
			$model->attributes=$_POST['Session'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionOpeningControl($id)
	{	
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=$this->loadModel($id);

		$cbl = Yii::app()->db->createCommand()
		    ->select('cashbox_line.*')
		    ->from('session')
		    ->join('session_payment', 'session_payment.session_id = session.id')
		    ->join('payment_type', 'session_payment.payment_type_id = payment_type.id and payment_type.type="cash"')
		    ->join('cashbox_line', 'cashbox_line.session_payment_id = session_payment.id')
		    ->where('session.id=:id', array(':id'=>$id))
		    ->queryAll();


		$this->render('openingControl',array(
			'model'=>$model,
			'casboxLines'=>$cbl,
		));
	}	

	public function actionClosingControl($id)
	{	
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=$this->loadModel($id);
		
		if($model->state =='OPEN'){

			$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
			$oe_summary_mode = $as->val;

			if($oe_summary_mode==0){
				#check for UNPOSTED orders
				$orders = Order::model()->findAll('state="PAID" and (oe_id is null or oe_id=0) and session_id=:id' , array('id'=>$id));
				$msg = 'Found UNPOSTED orders, please Post them now before closing a Session';
			}
			else{
				#check for UNPAID orders
				$orders = Order::model()->findAll('state="NEW" and session_id=:id' , array('id'=>$id));
				$msg = 'Found NEW orders, please make payment or cancel them before closing a Session';
			}


			if ($orders){ 
				Yii::app()->user->setFlash('warning',$msg);
				$this->redirect(array('/order/admin'));
			}

			$model=$this->loadModel($id);

			$cbl = Yii::app()->db->createCommand()
			    ->select('cashbox_line.*')
			    ->from('session')
			    ->join('session_payment', 'session_payment.session_id = session.id')
			    ->join('payment_type', 'session_payment.payment_type_id = payment_type.id and payment_type.type="cash"')
			    ->join('cashbox_line', 'cashbox_line.session_payment_id = session_payment.id')
			    ->where('session.id=:id', array(':id'=>$id))
			    ->queryAll();

			$this->render('closingControl',array(
				'model'=>$model,
				'casboxLines'=>$cbl,
			));
		}else{
			Yii::app()->user->setFlash('warning', 'You cannot edit Closing control');
			$this->redirect(array('view','id'=>$model->id));

		}
	}	

	public function actionOpenCashbox(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
		$oe_summary_mode = $as->val;

		$session_id = $_POST['session_id'];
		$session = Session::model()->findByPk($session_id);

		$number_openings = $_POST['number_openings'];
		$session_payment_id = $_POST['session_payment_id'];

		//update to OE:cashbox_line
		if($oe_summary_mode == 0){
			list($oe, $userId) = oeLogin();
		}

		foreach($number_openings as $id=>$number_opening){
			$cb = CashboxLine::model()->findByPk($id);
			$cb->number_opening = $number_opening;
			if (!$cb->save()){
				print_r($number_opening);
				print_r($cb->getErrors() );die;
			}

			if($oe_summary_mode == 0)
			{
				$ols[] = new xmlrpcval(
					array(
						new xmlrpcval(1,'int'),
						new xmlrpcval($cb->oe_id ,'int'),
						new xmlrpcval(
							array(
								'number_opening'   => new xmlrpcval($cb->number_opening , 'int'), 
							), 
							"struct"
						)
					),
					"array"
				); // one record 
			}
		}

		if($oe_summary_mode == 0)
		{
			$lines = new xmlrpcval(
				$ols,
				"array"
			);
			$values = array(
				'opening_details_ids' => $lines
			);

			$oe->write(array($session->oe_id), $values , 'pos.session');
			$oe->execWf('open', 'pos.session', $session->oe_id );
		}

		$this->redirect(array('view','id'=>$session_id ));

	}

	/**
	close cash box
	close session
	**/
	public function actionCloseCashbox(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
		$oe_summary_mode = $as->val;


		$start = time();

		$session_id = $_POST['session_id'];
		$session = Session::model()->findByPk($session_id);

		$number_closings = $_POST['number_closings'];
		$session_payment_id = $_POST['session_payment_id'];

		//update to OE:cashbox_line
		$session->state = SESSION_CLOSING_CONTROL;
		$session->save();

		$total_drawer=0;


		if($oe_summary_mode == 0){
			//ini harusnya pindah ke menu lain, supaya close session kasir bisa lebih cepat
			//
			list($oe, $userId) = oeLogin();
			$wfid = $oe->execWf('cashbox_control', 'pos.session', $session->oe_id );
			if ($wfid != -1){

				foreach($number_closings as $id=>$number_closing){
					$cb = CashboxLine::model()->findByPk($id);
					$cb->number_closing = str_replace(',', '', $number_closing);
					if (!$cb->save()){
						print_r($number_closing);
						print_r($cb->getErrors() );die;
					}

					$total_drawer += $cb->pieces * $number_closing;

					$ols[] = new xmlrpcval(
							array(
								new xmlrpcval(1,'int'),
								new xmlrpcval($cb->oe_id ,'int'),
								new xmlrpcval(
									array(
										'number_closing'   => new xmlrpcval($cb->number_closing , 'int'), 
									), 
									"struct"
								)
							),
							"array"
					); // one record 
				}


				$lines = new xmlrpcval(
					$ols,
					"array"
				);
				$values = array(
					'stop_at' => new xmlrpcval(date('Y-m-d H:i:s'), 'string'),
					'details_ids' => $lines
				);

				$oe->write(array($session->oe_id), $values , 'pos.session');

				# close and post
				$session->state = SESSION_CLOSED;
				$session->close_date= date('Y-m-d H:i:s');
				$session->total_sales = $session->total;
				$session->total_drawer = $total_drawer;
				$session->difference = $session->total_drawer - ($session->totalCash + $session->totalCashOpening);
				$session->save();

				$wfid = $oe->execWf('close', 'pos.session', $session->oe_id );		
				if($wfid !=-1){
					$session->state = SESSION_POSTED;
					$session->save();

					$end = time();
					$delta = $end-$start;

					$msg = 'Session POSTED successfully in ' . ($delta/60) . ' min(s)'; 
					Yii::app()->user->setFlash('success',$msg );
				}
			}
			else
			{
				$msg = 'Failed to POST Session!' ; 
				Yii::app()->user->setFlash('error',$msg );

			}			
		}
		else{

			# update cashbox line colsing number
			# count drawer 

			foreach($number_closings as $id=>$number_closing){
				$cb = CashboxLine::model()->findByPk($id);
				$cb->number_closing = str_replace(',', '', $number_closing);
				if (!$cb->save()){
					print_r($number_closing);
					print_r($cb->getErrors() );die;
				}
				$total_drawer += $cb->pieces * $number_closing;			
			}

			# close session
			$session->state = SESSION_CLOSED;
			$session->close_date= date('Y-m-d H:i:s');
			$session->total_sales = $session->total;
			$session->total_drawer = $total_drawer;
			$session->difference = $session->total_drawer - ($session->totalCash + $session->totalCashOpening);
			$session->save();	

			$end = time();
			$delta = $end-$start;

			$msg = 'Session CLOSED successfully in ' . ($delta/60) . ' min(s)'; 
			Yii::app()->user->setFlash('success',$msg );
		}


		$this->redirect(array('view','id'=>$session_id ));

	}


	/**
	 Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);

			if($model->state == SESSION_CLOSED || $model->state == SESSION_POSTED )
				throw new CHttpException(400,'Cannot delete CLOSED or POSTED session');

			// we only allow deletion via POST request
			$model->delete();
			unset(Yii::app()->session['session_id']);


			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$this->redirect(array('admin'));
	}

	/**
	 Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		$this->layout='//layouts/column1';
		$model=new Session('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Session']))
			$model->attributes=$_GET['Session'];
		else
			$model->user_id = Yii::app()->user->id;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Session::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='session-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 Performs session closing
	 * update to OpenERP 
	 * @param CModel the model to be closed
	 */
	public function actionClose(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		$id = Yii::app()->session['session_id'];
		$model = $this->loadModel($id);

		//save session
		if(isset($_POST['Session']))
		{

			$model->attributes=$_POST['Session'];
			$model->state = SESSION_CLOSED;
			$model->total_sales = $model->total;
			$model->total_drawer = str_replace(",","",$model->total_drawer);
			$model->difference = $model->total_drawer - $model->total_sales;

			if(! $model->save())
			{
				print "error " . $model->getErrors(); die;
			}

			unset(Yii::app()->session['session_id']);

			//close OpenERP session
			$wf = Session::closeOeSession($model);
			if($wf > 0 ){
				Yii::app()->user->setFlash('success','Session succesfully closed and posted to OE');
			}
			else{
				Yii::app()->user->setFlash('error','Session failed be posted to OE');
			}

			$this->redirect(array('/session/view', 'id'=>$id)) ;	
		}


		$total_sales = $this->getTotalSales($model);
		$model->total_sales = $total_sales;
		$model->close_date = date("Y-m-d H:i:s");

		$this->render('close',array(
			'model'=>$model,
		));

	}


	/**
	 cek semua order apakah sudah PAID
	 * hitung total : sum(order.total)
	 * @param CModel the model to be created on OpenERP
	 */
	private function getTotalSales($model){

		$total_sales=0;

		foreach ($model->orders as $o){
			if($o->state == ORDER_NEW){
				Yii::app()->user->setFlash('error', "Cannot Close! Order No " . $o->number . " is still open.");
				$this->redirect(array('/session/view', 'id' => $model->id));
			}

			$total_sales += $o->total;
		}

		return $total_sales;
	}

	/**
	row summary per payment
	*/
	public function summaryPerPaymentRows($id, $start=null, $end=null){
		if($id != null){
			$rows = Yii::app()->db->createCommand()
			    ->select('payment_type.name, payment_type.oe_credit_account_id, payment_type.oe_debit_account_id, sum(order_payment.amount) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_payment', 'order_payment.order_id = order.id')
			    ->join('payment_type', 'order_payment.payment_type_id = payment_type.id')
			    ->group('payment_type.name')
			    ->where('session.id=:id and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$id))
			    ->queryAll();
		}else{
			$rows = Yii::app()->db->createCommand()
			    ->select('payment_type.name, payment_type.oe_credit_account_id, payment_type.oe_debit_account_id, sum(order_payment.amount) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_payment', 'order_payment.order_id = order.id')
			    ->join('payment_type', 'order_payment.payment_type_id = payment_type.id')
			    ->group('payment_type.name')
			    ->where('order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" AND "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryAll();
		}

		return $rows;		
	}
	/**
	row order per payment
	*/	
	public function orderPerPaymentRows($id, $start=null, $end=null){
		$rows = array();
		if($id != null){
			$rows[] = Yii::app()->db->createCommand()
			    ->select('payment_type.name, payment_type.oe_credit_account_id, payment_type.oe_debit_account_id, order.number, order.notes, order_payment.amount ')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_payment', 'order_payment.order_id = order.id')
			    ->join('payment_type', 'order_payment.payment_type_id = payment_type.id')
			    ->where('session.id=:id and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$id))
			    ->order('payment_type.sorting, order.notes')
			    ->queryAll();

			$rows[] = Yii::app()->db->createCommand()
			    ->select('payment_type.name, payment_type.oe_credit_account_id, payment_type.oe_debit_account_id, join_payment.join_number, join_payment_payment.amount ')
			    ->from('session')
			    ->join('join_payment', 'join_payment.session_id = session.id')
			    ->join('join_payment_payment', 'join_payment_payment.join_payment_id = join_payment.id')
			    ->join('payment_type', 'join_payment_payment.payment_type_id = payment_type.id')
			    ->where('session.id=:id and join_payment.state = "'.JOIN_PAID.'" ', array('id'=>$id))
			    ->order('payment_type.sorting, join_payment.join_number')
			    ->queryAll();
		}else{
			$rows[] = Yii::app()->db->createCommand()
			    ->select('payment_type.name, payment_type.oe_credit_account_id, payment_type.oe_debit_account_id, order.number, order.notes, order_payment.amount ')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_payment', 'order_payment.order_id = order.id')
			    ->join('payment_type', 'order_payment.payment_type_id = payment_type.id')
			   	->where('order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" AND "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->order('payment_type.sorting, order.notes')
			    ->queryAll();

			$rows[] = Yii::app()->db->createCommand()
			    ->select('payment_type.name, payment_type.oe_credit_account_id, payment_type.oe_debit_account_id, join_payment.join_number, join_payment_payment.amount ')
			    ->from('session')
			    ->join('join_payment', 'join_payment.session_id = session.id')
			    ->join('join_payment_payment', 'join_payment_payment.join_payment_id = join_payment.id')
			    ->join('payment_type', 'join_payment_payment.payment_type_id = payment_type.id')
			    ->where('session.id=:id and join_payment.state = "'.JOIN_PAID.'" ', array('id'=>$id))
			    ->order('payment_type.sorting, join_payment.join_number')
			    ->queryAll();
		}
		return $rows;
	}
	/**
	row summaryPerCategoryRows
	*/
	public function summaryPerCategoryRows($id, $start=null, $end=null){
		if($id != null){

			$rows = Yii::app()->db->createCommand()
			    ->select('product.category, product.oe_stock_account_id,  product.oe_income_account_id, product.oe_expense_account_id, sum(order_detail.amount) as s, sum(product.cost_price * qty) as cost ')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->join('product', 'order_detail.product_id = product.id')
			    ->group('product.category')
			    ->where('session.id=:id and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$id))
			    ->queryAll();		
					
		}else{

			$rows = Yii::app()->db->createCommand()
			    ->select('product.category, product.oe_stock_account_id, product.oe_expense_account_id, sum(order_detail.amount) as s, sum(product.cost_price * qty) as cost ')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->join('product', 'order_detail.product_id = product.id')
			    ->group('product.category')
			    ->where('order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" AND "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryAll();		
		}

		return $rows;
	}
	/**
	row summaryPerProductRows
	*/
	public function summaryPerProductRows($id, $start=null, $end=null){
		if($id != null){
			$rows = Yii::app()->db->createCommand()
			    ->select('product.name, product.oe_id, sum(order_detail.qty) as qty, sum(order_detail.amount) as s,  sum(product.cost_price * qty) as cost ')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->join('product', 'order_detail.product_id = product.id')
			    ->group('product.name')
			    ->where('session.id=:id and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$id))
			    ->queryAll();
		}else{
			$rows = Yii::app()->db->createCommand()
			    ->select('product.name, product.oe_id, sum(order_detail.qty) as qty, sum(order_detail.amount) as s,  sum(product.cost_price * qty) as cost ')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->join('product', 'order_detail.product_id = product.id')
			    ->group('product.name')
			    ->where('order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" AND "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryAll();
		}
		
		return $rows;
	}
	/**
	 actionSummaryPerCategoryReport
	*/
	public function actionSummaryPerCategoryReport(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		$id = isset($_GET['id'])?$_GET['id']:null;
		$start_date = isset($_GET['start_date'])?$_GET['start_date']:null;
		$end_date = isset($_GET['end_date'])?$_GET['end_date']:null;

		$print = isset($_GET['print']);
		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;


		if($id)
			$session = $this->loadModel($id);
		else
			$session = null;

		$rows = $this->summaryPerCategoryRows($id, $start_date, $end_date);

		$payments = $this->summaryPerPaymentRows($id, $start_date, $end_date);

		if($print){
			$report = $this->renderPartial('_per_category_report_txt',array(
				'rows'=>$rows,
				'session'=>$session,
				'payments'=>$payments,
				'shop_name'=>$shop_name,
				'start_date'=>$start_date,
				'end_date'=>$end_date,
			), true);

			$as = AppSetting::model()->findOrCreate('tmp_dir','/tmp');
			$tmp_dir= $as->val;
			$filename = $tmp_dir  . 'daily_report.txt';

			$fp = fopen($filename, 'wb');
			fwrite($fp, $report);
			fclose($fp);

			$as = AppSetting::model()->findOrCreate('print_cmd','copy /b');
			$print_cmd = $as->val;

			$as = AppSetting::model()->findOrCreate('printer_port','com1:');
			$printer_port = $as->val;

			$cmd = $print_cmd  . " $filename " . $printer_port;
			@system($cmd);

			Yii::app()->user->setFlash('success', 'Report printed');

		}

		$this->render('per_category_report',array(
			'rows'=>$rows,
			'session'=>$session,
			'payments'=>$payments,
			'shop_name'=>$shop_name,
			'start_date'=>$start_date,
			'end_date'=>$end_date,

		));
	}

	/**
	 actionSummaryPerProductReport
	*/
	public function actionSummaryPerProductReport(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		$id = isset($_GET['id'])?$_GET['id']:0;
		$print = isset($_GET['print']);
		$start_date = isset($_GET['start_date'])?$_GET['start_date']:null;
		$end_date = isset($_GET['end_date'])?$_GET['end_date']:null;

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME\naddress");
		$shop_name = $as->val;

		if($id)
			$session = $this->loadModel($id);
		else
			$session = null;

		$rows = $this->summaryPerProductRows($id, $start_date, $end_date);
		$payments = $this->summaryPerPaymentRows($id, $start_date, $end_date);

		if($print){
			$report = $this->renderPartial('_per_product_report_txt',array(
				'rows'=>$rows,
				'session'=>$session,
				'payments'=>$payments,
				'shop_name'=>$shop_name,
				'start_date'=>$start_date,
				'end_date'=>$end_date,				
			), true);

			$as = AppSetting::model()->findOrCreate('tmp_dir','/tmp');
			$tmp_dir = $as->val;

			$filename = $tmp_dir  . 'daily_report.txt';

			$fp = fopen($filename, 'wb');
			fwrite($fp, $report);
			fclose($fp);

			$as = AppSetting::model()->findOrCreate('print_cmd','copy /b');
			$print_cmd = $as->val;

			$as = AppSetting::model()->findOrCreate('printer_port','com1:');
			$printer_port = $as->val;

			$cmd = $print_cmd  . " $filename " . $printer_port;
			@system($cmd);

			Yii::app()->user->setFlash('success', 'Report printed');

		}

		$this->render('per_product_report',array(
			'rows'=>$rows,
			'session'=>$session,
			'payments'=>$payments,
			'shop_name'=>$shop_name,
			'start_date'=>$start_date,
			'end_date'=>$end_date,			
		));


	}
	/**
	 actionOrderPerPaymentReport
	*/
	public function actionOrderPerPaymentReport(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		$id = isset($_GET['id'])?$_GET['id']:0;
		$print = isset($_GET['print']);
		$start_date = isset($_GET['start_date'])?$_GET['start_date']:null;
		$end_date = isset($_GET['end_date'])?$_GET['end_date']:null;

		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME\naddress");
		$shop_name = $as->val;
		if($id)
			$session = $this->loadModel($id);
		else
			$session = null;		
		$payments = $this->orderPerPaymentRows($id, $start_date, $end_date);

		if($print){
			$report = $this->renderPartial('_per_payment_report_txt',array(
				'session'=>$session,
				'payments'=>$payments,
				'shop_name'=>$shop_name,
				'start_date'=>$start_date,
				'end_date'=>$end_date,					
			), true);

			$as = AppSetting::model()->findOrCreate('tmp_dir','/tmp');
			$tmp_dir = $as->val;

			$filename = $tmp_dir  . 'daily_report.txt';

			$fp = fopen($filename, 'wb');
			fwrite($fp, $report);
			fclose($fp);

			$as = AppSetting::model()->findOrCreate('print_cmd','copy /b');
			$print_cmd = $as->val;

			$as = AppSetting::model()->findOrCreate('printer_port','com1:');
			$printer_port = $as->val;

			$cmd = $print_cmd  . " $filename " . $printer_port;
			@system($cmd);

			Yii::app()->user->setFlash('success', 'Report printed');

		}

		$this->render('per_payment_report',array(
			'session'=>$session,
			'payments'=>$payments,
			'shop_name'=>$shop_name,
			'start_date'=>$start_date,
			'end_date'=>$end_date,				
		));


	}
	/**
	re-close post session closing for all unposted / unclosed session
	*/
	public function actionRecloseOeSession($id){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		
		$model=$this->loadModel($id);
		$wf = Session::closeOeSession($model);	
		if($wf > 0 ){
			Yii::app()->user->setFlash('success','Session succesfully closed and posted to OE');
		}
		else{
			Yii::app()->user->setFlash('error','Session failed be posted to OE, try to Close the Session from OpenERP interface');
		}

		$this->redirect(array('/session/view', 'id'=>$id)) ;	
	}
	/**
	post session closing for all unposted / unclosed session
	*/
	public function actionRecloseAllOeSession(){

	}

	/**
	generate journals
	*/
	public function actionGenerateJournal($id){

		$model=$this->loadModel($id);

		try{
			$msg = 'Clearing Journal';
			$this->clearJournal( $model );

			$msg = 'Sales Journal';
			$this->generateSalesJournal( $model );

			$msg = 'Discount Journal';
			$this->generateDiscountJournal( $model );

			$msg = 'HPP Journal';
			$this->generateHppJournal($model);

			$msg = 'Difference Journal';
			$this->generateDifference($model);

			$msg = 'Stock Move';
			$this->generateStockMove($model);

			Yii::app()->user->setFlash('success','Journal created succesfully.');
        
        }
        catch (Exception $e)
        {
		
        	Yii::app()->user->setFlash('error', 'Something wrong while creating journal: ' . $msg. '<br>' . $e->getMessage() );
		}


		$this->redirect(array('/journal/admin?' . 'session_id=' . $id)) ;	

	}

	/**
	delete journal for the session
	if not posted 
	**/
	function clearJournal($model){
		//Journal::model()->deleteAll('session_id=:id', array('id'=>$model->id ));
		//StockMove::model()->deleteAll('session_id=:id', array('id'=>$model->id ));
	}


	/*************************************************************
	Sales Journal
	
	for each payment type debit/credit vs Sales :

		Mandiri
		Niaga
		Tunai
		Card Mandiri
		Compliment
		Kredit Elektronik
		KopCard
		UT Kopscard
		UT Voucher
		Voucher Kokarfi
		Voucher Retpath		
			Sales 
	**************************************************************/
	function generateSalesJournal($session){


		$payments = $this->summaryPerPaymentRows($session->id);
		/* payment */
		foreach ($payments as $payment){

			//apakah sudah ada ??
			$j = Journal::model()->find('session_id=:s and account_id=:a', 
				array('s'=>$session->id, 'a'=>$payment['oe_debit_account_id']));

			if(!$j)
				$j = new Journal();

			$j->session_id 	= $session->id ;
			$j->name 		= $session->name ;
			$j->datetime 	= $session->close_date;
			$j->account_id 	= $payment['oe_debit_account_id'];
			$j->debit 		= $payment['s'];
			$j->credit 		= 0;
			$j->reference 	= $payment['name'];
			if(!$j->save()){
				var_dump($j->getErrors() );
			}
		}

		//post to single sales COA ? or per category product
		//if true: then set sales_account_id setting
		$as_post = AppSetting::model()->findOrCreate('post_to_sales_coa','0');
		$post_to_sales_coa = $as_post->val;

		if($post_to_sales_coa)
		{
			/* Sales Non PPN */
			$as = AppSetting::model()->findOrCreate('sales_account_id','1525');
			$sales_account_id = $as->val;

			$j = Journal::model()->find('session_id=:s and account_id=:a', 
				array('s'=>$session->id, 'a'=>$sales_account_id ));

			if(!$j)
				$j = new Journal();
		
			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime 		= $session->close_date;
			$j->account_id 		= $sales_account_id;
			$j->debit 			= 0;
			$j->credit 			= $session->total;
			$j->reference 		= 'Sales Non PPN';
			if(!$j->save()){
				var_dump($j->getErrors() );
			}

		}
		else{ // sales account per category product

			$categories = $this->summaryPerCategoryRows($session->id);

			foreach ($categories as $categ) {

				/* Income */
				$income_account_id=$categ['oe_income_account_id'];
				$j = Journal::model()->find('session_id=:s and account_id=:a', 
					array('s'=>$session->id, 'a'=>$income_account_id));
				if(!$j)
					$j = new Journal();

				$j->session_id 		= $session->id ;
				$j->name 			= $session->name ;
				$j->datetime		= date('Y-m-d H:i:s');
				$j->account_id 		= $income_account_id;
				$j->debit 			= 0;
				$j->credit 			= $categ['s'];
				$j->reference 		= 'Sales ' . $categ['category'];
				if(!$j->save()){
					var_dump($j->getErrors() );
				}			
		

			}			
		}

		/*Jika ada penjualan yang kena pajak*/
		if($session->totalppn > 0){
			/*Sales PPN*/
			$as = AppSetting::model()->findOrCreate('ppn_account_id','1472');
			$ppn_account_id = $as->val;

			$j = new Journal();
	
			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime 		= $session->close_date;
			$j->account_id 		= $sales_account_id;
			$j->debit 			= 0;
			$j->credit 			= $session->totalppn/110*100;
			$j->reference 		= 'Sales PPN';
			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}

			/*Hutang PPN*/
			$j = new Journal();
	
			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime 		= $session->close_date;
			$j->account_id 		= $ppn_account_id;
			$j->debit 			= 0;
			$j->credit 			= $session->totalppn - ($session->totalppn/110*100);
			$j->reference 		= 'Hutang PPN';
			if(!$j->save()){
				var_dump($j->getErrors() );
			}

		}

		return true;

	}

	/*************************************************************
	discount product
	

	kalau session->totalDiscount > 0

		Biaya Discount 
			Sales 

	*************************************************************/

	function generateDiscountJournal( $session ){

		if($session->totalDiscount>0){

			$ref= 'Discount';
			/* Discount */
			$as = AppSetting::model()->findOrCreate('discount_account_id','1534');
			$discount_account_id = $as->val;

			/* sales */
			$as = AppSetting::model()->findOrCreate('sales_account_id','1525');
			$sales_account_id = $as->val;			

			/* Discount */
			$j = Journal::model()->find('session_id=:s and account_id=:a and reference=:r ', 
				array('s'=>$session->id, 'a'=>$discount_account_id , 'r'=>$ref ));

			if(!$j)
				$j = new Journal();
	
			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime		= $session->close_date;
			$j->account_id 		= $discount_account_id;
			$j->debit 			= 0;
			$j->credit 			= $session->totalDiscount;
			$j->reference 		= $ref ;
			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}
			/*	Sales */

			$j = Journal::model()->find('session_id=:s and account_id=:a and reference=:r ', 
				array('s'=>$session->id, 'a'=>$sales_account_id, 'r'=>$ref ));

			if(!$j)
				$j = new Journal();
			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime		= $session->close_date;
			$j->account_id 		= $sales_account_id;
			$j->debit 			= $session->totalDiscount;
			$j->credit 			= 0;
			$j->reference 		= $ref;
			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}
		}
	}

	/*************************************************************
	HPP Inventory Journal 

	for each product category vs HPP minimarket:

		HPP Minimarket
			13130 Persediaan Keringan
			13170 Persediaan Makanan
			13220 Persediaan Fashion Textil
			13250 Persediaan Elektronik

	**************************************************************/

	function generateHppJournal($session){


		$as = AppSetting::model()->findOrCreate('hpp_account_id','1552');
		$hpp_account_id = $as->val;



		/* 1COA:	HPP Minimarket */
		/*
		$j = Journal::model()->find('session_id=:s and account_id=:a', 
			array('s'=>$session->id, 'a'=>$hpp_account_id));
		if(!$j)
			$j = new Journal();

		$j->session_id 		= $session->id ;
		$j->name 			= $session->name ;
		$j->datetime		= $session->close_date;
		$j->account_id 		= $hpp_account_id;
		$j->debit 			= $session->totalHpp;
		$j->credit 			= 0;
		$j->reference 		= 'HPP';
		if(!$j->save()){
			var_dump($j->getErrors() );
			//die;
		}
		*/

		$categories = $this->summaryPerCategoryRows($session->id);

		foreach ($categories as $categ) {

			/* HPP */
			$hpp_account_id=$categ['oe_expense_account_id'];
			$j = Journal::model()->find('session_id=:s and account_id=:a', 
				array('s'=>$session->id, 'a'=>$hpp_account_id));
			if(!$j)
				$j = new Journal();

			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime		= date('Y-m-d H:i:s');
			$j->account_id 		= $hpp_account_id;
			$j->debit 			= $categ['cost'];
			$j->credit 			= 0;
			$j->reference 		= 'HPP ' . $categ['category'];
			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}			
	

			/*	Persediaan  */
			$j = Journal::model()->find('session_id=:s and account_id=:a', 
				array('s'=>$session->id, 'a'=>$categ['oe_stock_account_id']));
			if(!$j)
				$j = new Journal();
			$j->session_id 	= $session->id ;
			$j->name 		= $session->name ;
			$j->datetime 	= $session->close_date;
			$j->account_id 	= $categ['oe_stock_account_id'];
			$j->debit 		= 0;
			$j->credit 		= $categ['cost'];
			$j->reference 	= $categ['category'];
			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}

		}
	}

	/*************************************************************
	stock move:

	for each product qty:

		Baby Scott/Gedongan James		1.00	GK01	Customer
		Kulkas 2 Pintu Nrb 262			1.00	GK01	Customer
		Mie Telur Cap Kijang 2 Kepi		10.00	GK01	Customer
		Polytron Magic Comb Prc 1803W	2.00	GK01	Customer
		Telur Ayam						10.00	GK01	Customer

	**************************************************************/
	function generateStockMove($session){
		
		$as = AppSetting::model()->findOrCreate('source_location_id','86'); //GK01
		$source_location_id = $as->val;
		if(!$source_location_id){
			throw new CHttpException(404,'Please set source_location_id in AppSetting');
		}

		$as = AppSetting::model()->findOrCreate('dest_location_id','9'); //customer
		$dest_location_id = $as->val;
		if(!$dest_location_id){
			throw new CHttpException(404,'Please set dest_location_id in AppSetting');
		}

		$rows = $this->summaryPerProductRows($session->id);
		foreach ($rows as $row) {

			$j = StockMove::model()->find('session_id=:s and product_id=:p', 
				array('s'=>$session->id, 'p'=>$row['oe_id'] ) );
		
			if (!$j)
				$j = new StockMove();

			$j->session_id 	= $session->id ;
			$j->name 		= $session->name ;
			$j->datetime 	= $session->close_date;
			$j->product_id 	= $row['oe_id'];
			$j->reference 	= $row['name'];
			$j->qty 	 	= $row['qty'];
			$j->source_location_id 		= $source_location_id ;
			$j->dest_location_id 		= $dest_location_id ;

			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}

		}		
	}
	
	/*************************************************************
	cash difference journal:

	difference > 0 :
		Cash 
			Other Income

	difference < 0 :
		Other Income
			Cash 

	**************************************************************/
	function generateDifference($session){
		$diff = $session->difference;

		$pt = PaymentType::model()->find("type='cash'");
		$cash_coa_id  = $pt->oe_debit_account_id;

		$as = AppSetting::model()->findOrCreate('other_income_coa_id','1616');
		$other_income_coa_id = $as->val;


		if($diff > 0){
			$ref = 'Difference Plus';
			$j = Journal::model()->find('session_id=:s and account_id=:a and reference=:r', 
				array('s'=>$session->id, 'a'=>$cash_coa_id, 'r'=>$ref ));
			if(!$j)
				$j = new Journal();
			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime		= $session->close_date;
			$j->account_id 		= $cash_coa_id;
			$j->debit 			= $diff;
			$j->credit 			= 0;
			$j->reference 		= $ref;
			if(!$j->save()){
				var_dump($j->getErrors() );
				die;
			}

			$j = Journal::model()->find('session_id=:s and account_id=:a and reference=:r', 
				array('s'=>$session->id, 'a'=>$other_income_coa_id, 'r'=>$ref ));
			if(!$j)
				$j = new Journal();
			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime		= $session->close_date;
			$j->account_id 		= $other_income_coa_id;
			$j->debit 			= 0;
			$j->credit 			= $diff;
			$j->reference 		= $ref ;
			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}			
		}
		else if ($diff<0){
			$ref = 'Difference Minus';

			$j = Journal::model()->find('session_id=:s and account_id=:a and reference=:r', 
				array('s'=>$session->id, 'a'=>$other_income_coa_id, 'r'=>$ref ));
			if(!$j)
				$j = new Journal();

			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime		= $session->close_date;
			$j->account_id 		= $other_income_coa_id;
			$j->debit 			= abs($diff);
			$j->credit 			= 0;
			$j->reference 		= $ref ;
			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}

			$j = Journal::model()->find('session_id=:s and account_id=:a and reference=:r', 
				array('s'=>$session->id, 'a'=>$cash_coa_id, 'r'=>$ref ));
			if(!$j)
				$j = new Journal();
			$j->session_id 		= $session->id ;
			$j->name 			= $session->name ;
			$j->datetime		= $session->close_date;
			$j->account_id 		= $cash_coa_id;
			$j->debit 			= 0;
			$j->credit 			= abs($diff);
			$j->reference 		= $ref;
			if(!$j->save()){
				var_dump($j->getErrors() );
				//die;
			}
		}
	
	}
	
	function actionAutoPost(){
		$as = AppSetting::model()->findOrCreate('oe_summary_mode','1');
		$oe_summary_mode = $as->val;

		$as = AppSetting::model()->findOrCreate('autopost_interval',"5"); //menit
		$autopost_interval = $as->val;
		$this->render('autopost',array(
			'autopost_interval'=>$autopost_interval,
			'oe_summary_mode'=>$oe_summary_mode,
		));
	}

	function summarySessions($start, $end){
		$criteria = new CDbCriteria();
		$criteria->select = 'sum(total_drawer) as tdrawer, sum(difference) as tdifference';
		$criteria->addBetweenCondition('close_date', $start, $end);

		$model = Session::model()->find($criteria);
		
		return $model;
	}

	public function actionReportCategory(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$submit = false;
		$model 	= new Session;

		if(isset($_GET['Session']['start_date']) and isset($_GET['Session']['end_date'])){
			$start  = $_GET['Session']['start_date'];
			$end 	= $_GET['Session']['end_date'];
			$action 	= $_GET['action'];
			$this->redirect(array($action,'start_date'=>$start, 'end_date'=>$end));
			Yii::app()->end();

		}
		$this->render('searchReport',array(
			'model'=>$model,
			'action'=>'summaryPerCategoryReport',
			'title'=>'Summary Report Per Product Category'
		));
	}

	public function actionReportProduct(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$submit = false;
		$model 	= new Session;

		if(isset($_GET['Session']['start_date']) and isset($_GET['Session']['end_date'])){
			$start  = $_GET['Session']['start_date'];
			$end 	= $_GET['Session']['end_date'];
			$action 	= $_GET['action'];
			$this->redirect(array($action,'start_date'=>$start, 'end_date'=>$end));
			Yii::app()->end();

		}
		$this->render('searchReport',array(
			'model'=>$model,
			'action'=>'summaryPerProductReport',
			'title'=>'Summary Report Per Product'
		));
	}

	public function actionReportPayment(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$submit = false;
		$model 	= new Session;

		if(isset($_GET['Session']['start_date']) and isset($_GET['Session']['end_date'])){
			$start  = $_GET['Session']['start_date'];
			$end 	= $_GET['Session']['end_date'];
			$action 	= $_GET['action'];
			$this->redirect(array($action,'start_date'=>$start, 'end_date'=>$end));
			Yii::app()->end();

		}
		$this->render('searchReport',array(
			'model'=>$model,
			'action'=>'orderPerPaymentReport',
			'title'=>'Summary Report Per Payment'
		));
	}

	
	public function actionWaiterSelect($id){
		Yii::app()->session['session_id']=$id; 

		$this->redirect(array('/restoOrder/admin'));
	}
}
