<?php
Yii::import('application.vendor.*');
require_once('openerp-php-connector/openerp.class.php');

class PaymentTypeController extends Controller
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
				'actions'=>array('create','update','sync'),
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
		$model=new PaymentType;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PaymentType']))
		{
			$model->attributes=$_POST['PaymentType'];
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

		if(isset($_POST['PaymentType']))
		{
			$model->attributes=$_POST['PaymentType'];
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

		$model=new PaymentType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PaymentType']))
			$model->attributes=$_GET['PaymentType'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=new PaymentType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PaymentType']))
			$model->attributes=$_GET['PaymentType'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PaymentType the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PaymentType::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PaymentType $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-type-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSync()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		list($oe, $user_id)=oeLogin();
		$fields = array('id','name','code','type','journal_user', 'default_debit_account_id','default_credit_account_id'); 

		$as = AppSetting::model()->find('code="payment_type_last_sync"');
		$payment_type_last_sync = $as->val;

		//search dulu yang berubah aja, write_date >= payment_type_last_sync
		$ids = $oe->search('write_date','>', $payment_type_last_sync,'account.journal');
		if ($ids == -1){
			Yii::app()->user->setFlash('warning','No newer PaymentType found than ' . $payment_type_last_sync);
			$this->redirect(array('/paymentType/index'));
			return;
		}

		$paymentTypes = $oe->read($ids, $fields, "account.journal");

		if(!$paymentTypes){
			Yii::app()->user->setFlash('error','no paymentType found' );
			$this->redirect(array('/paymentType/index'));
			return;
		}
		$i=0;
		$result='';

		foreach ($paymentTypes as $p){

			if(isset($p['journal_user']) && $p['journal_user'] == False)
				continue;

			$paymentType = PaymentType::model()->find('name=:name',array('name'=>$p['name']) );
			if (!$paymentType){
				$paymentType 				= new PaymentType();
				$paymentType->name 			= $p['name'];
				$paymentType->code 			= $p['code'];
				$paymentType->type 			= $p['type'];
				$paymentType->oe_id 		= $p['id'];
				$paymentType->oe_debit_account_id 		= $p['default_debit_account_id'][0];
				$paymentType->oe_credit_account_id 		= $p['default_credit_account_id'][0];
				if (!$paymentType->save())
				{
					$err = "error insert ". $p['name'] . " <br> ";
					Yii::app()->user->setFlash('error', $err . " " . var_export($paymentType->getErrors(), true) );
					$this->redirect(array('/paymentType/index'));
				}
				else{
					$result .= "insert ". $p['name'] . "<br>";
				}
			}
			else{
				$paymentType->name 			= $p['name'];
				$paymentType->code 			= $p['code'];
				$paymentType->type 			= $p['type'];
				$paymentType->oe_id 		= $p['id'];
				$paymentType->oe_debit_account_id 		= $p['default_debit_account_id'][0];
				$paymentType->oe_credit_account_id 		= $p['default_credit_account_id'][0];
				if(!$paymentType->save()){
					$err =  "error update ". $p['name'] . "<br>";
					Yii::app()->user->setFlash('error', $err . " " . $paymentType->getErrors() );
				}
				else{
					$result .= "update " . $p['name'] . "<br>";

				}
			}
			$i++;
		}

		$as->val = gmdate('Y-m-d H:i:s');
		$as->save();

		$result .= "done sync $i paymentTypes.";
		Yii::app()->user->setFlash('success', $result);
		$this->redirect(array('/paymentType/index'));

	}

}
