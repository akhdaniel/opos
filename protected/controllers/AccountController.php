<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');

class AccountController extends Controller
{
	/**
	* version 40
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
				'actions'=>array('create','update','admin','delete','sync'),
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

		$model=new Account;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
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

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
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

		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$this->redirect(array('admin') );

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



	public function actionSync()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		list($oe, $user_id) = oeLogin();

		$as = AppSetting::model()->findOrCreate('account_last_sync','1970-01-01 00:00:00');
		$account_last_sync = $as->val;

		//search dulu yang berubah aja, write_date >= product_last_sync_date
		$ids = $oe->search('write_date','>', $account_last_sync,'account.account');
		if ($ids == -1){
			Yii::app()->user->setFlash('warning','No newer account found than ' . $account_last_sync);
			$this->redirect(array('/account/admin'));
			return;
		}

		$fields = array('id','name', 'code'); 
		$accounts = $oe->read($ids, $fields, "account.account");

		if(!$accounts){
			print "";
			Yii::app()->user->setFlash('error','no account found' );
			$this->redirect(array('/account/admin'));
			return;
		}
		$i=0;
		$result = '';

		foreach ($accounts as $p){

			//var_dump($p); die;
			$account = Account::model()->find('oe_id=:oe_id',array('oe_id'=>$p['id']) );
			// $account = Account::model()->find('code=:code',array('code'=>$p['code']) );

			if (!$account){
				$account 				= new Account();
				$account->name 			= $p['name'];
				$account->code 			= $p['code'];
				$account->oe_id 		= $p['id'];
				if (!$account->save())
				{
					$result .="**** error insert ". $p['name'] . "<br>";
					$result .= json_encode($account->getErrors());
				}
				$result .= "insert ". $p['name'] . "<br>";
			}
			else  
			{
				$account->oe_id 		= $p['id'];
				$account->name 			= $p['name'];
				$account->code 			= $p['code'];
				if(!$account->save()){
					$result .= "**** error update ". $p['name'] . "<br>";
					$result .= json_encode($account->getErrors());
				}
				$result .= "update " . $p['name'] . "<br>";
			}


			$i++;
		}

		$as->val = gmdate('Y-m-d H:i:s');
		$as->save();

		$result .= "done sync $i accounts.";
		Yii::app()->user->setFlash('success', $result);
		$this->redirect(array('/account/admin'));

	}

}
