<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');

class JournalController extends Controller
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
				'actions'=>array('create','update','admin','delete','post'),
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
		$model=new Journal;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Journal']))
		{
			$model->attributes=$_POST['Journal'];
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
		Yii::app()->regkey->cekReg();
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Journal']))
		{
			$model->attributes=$_POST['Journal'];
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
		Yii::app()->regkey->cekReg();
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->regkey->cekReg();
		if( isset($_GET['session_id'])){
			$session_id = $_GET['session_id'];
		}
		else{
			$session_id = Yii::app()->session['session_id'];
		}

		if(isset($_GET['state'])){
			$state = $_GET['state'];
		}
		else{
			$state = JOURNAL_UNPOSTED;
			$stateStockMove = STOCK_MOVE_UNPOSTED;
		}

		/* journal */
		$model=new Journal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Journal']))
			$model->attributes=$_GET['Journal'];
		else
			$model->state = $state ;

		$model->session_id= $session_id;



		/*stock move*/
		$modelStockMove=new StockMove('search');
		$modelStockMove->unsetAttributes();  // clear any default values
		if(isset($_GET['StockMove']))
			$modelStockMove->attributes=$_GET['StockMove'];
		else
			$modelStockMove->state = $stateStockMove ;

		$modelStockMove->session_id= $session_id;

		$session = Session::model()->findByPk($session_id);

		$this->render('admin',array(
			'session_id'=>$session_id,
			'session'=>$session,
			'model'=>$model,
			'modelStockMove'=>$modelStockMove,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Journal::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='journal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionPost(){

		Yii::app()->regkey->cekReg();
		$session_id = $_GET['session_id'];

		$msg = '';

		$success_journal = Journal::model()->createAccountMove($session_id);

		if ($success_journal->status == 'error'){
			$msg .= 'Failed to post journal, please try again.<br>';
			$msg .= '<pre>'.$success_journal->msg . '</pre><br>';
		}
		
		$success_stock = StockMove::model()->createStockMove($session_id);

		if ($success_stock->status  == 'error'){
			$msg .= 'Failed to post delivery order, please try again. <br>';
			$msg .= '<pre>'.$success_stock->msg . '</pre><br>';
		}

		if ($success_journal->status=='success' && $success_stock->status == 'success')
		{
	        $connection=Yii::app()->db;

	        $command=$connection->createCommand("UPDATE `session` set state = '". SESSION_POSTED ."' where id = {$session_id}");
	        $command->query();

	        $command=$connection->createCommand("UPDATE `order` set state = '". ORDER_POSTED ."' where session_id = {$session_id} and state = '".ORDER_PAID."'");
	        $command->query();

	        Yii::app()->session['session_id']=null;

			Yii::app()->user->setFlash('success','Journal and Stock Move Posted successful');
			$this->redirect(array('/session/admin'));

		}
		else
		{
			Yii::app()->user->setFlash('error', $msg );
			$this->redirect(array('/journal/admin', 'session_id'=>$session_id ));
		}
	}
}
