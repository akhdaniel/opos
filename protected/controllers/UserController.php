<?php

class UserController extends Controller
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
				'actions'=>array('create','update','admin','sync'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('sys'),
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
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('admin'));
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('admin'));
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
		//$dataProvider=new CActiveDataProvider('User');
		//$this->render('index',array(
		//	'dataProvider'=>$dataProvider,
		//));
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

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
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSync()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		list($oe, $user_id)=oeLogin();
		$fields = array('id','name','login','password'); 

		$as = AppSetting::model()->findOrCreate('user_last_sync','1970-01-01 00:00:00');
		$user_last_sync = $as->val;

		//search dulu yang berubah aja, write_date >= payment_login_last_sync
		$ids = $oe->search('write_date','>', $user_last_sync,'res.users');
		if ($ids == -1){
			Yii::app()->user->setFlash('warning','No newer User found since ' . $user_last_sync);
			$this->redirect(array('/user/admin'));
			return;
		}

		$users = $oe->read($ids, $fields, "res.users");

		if(!$users){
			Yii::app()->user->setFlash('error','no user found' );
			$this->redirect(array('/user/admin'));
			return;
		}
		$i=0;
		$result='';

		foreach ($users as $p){

			$user = User::model()->find('oe_id=:id',array('id'=>$p['id']) );
			if (!$user){
				$user 					= new User();
				$user->name 			= $p['name'];
				//$user->password 		= $p['password'];
				$user->password 		= 1;
				$user->login 			= $p['login'];
				$user->oe_id 			= $p['id'];
				$user->group_name 		= $p['login']=='admin'?'ADMIN':'CASHIER';

				if (!$user->save())
				{
					$err = "error insert ". $p['name'] . " <br> ";
					Yii::app()->user->setFlash('error', $err . " " . $user->getErrors() );
					$this->redirect(array('/user/index'));
				}
				else{
					$result .= "insert ". $p['name'] . "<br>";
				}
			}
			else{
				$user->name 			= $p['name'];
				//$user->password 		= $p['password'];
				$user->login 			= $p['login'];
				$user->oe_id 			= $p['id'];
				$user->group_name 		= $p['login']=='admin'?'ADMIN':'CASHIER';

				if(!$user->save()){
					$err =  "error update ". $p['name'] . "<br>";
					Yii::app()->user->setFlash('error', $err . " " . $user->getErrors() );
				}
				else{
					$result .= "update " . $p['name'] . "<br>";

				}
			}
			$i++;
		}

		$as->val = gmdate('Y-m-d H:i:s');
		$as->save();

		$result .= "Done sync $i users. Password is defaulted to 1";
		Yii::app()->user->setFlash('success', $result);
		$this->redirect(array('/user/admin'));

	}	
}
