<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
	    //cari kalau ada sessin yang masih aktif/belum POSTED
	    if (Yii::app()->user->id ){
	    	Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

	    	/*jika group kitchen*/
	    	if(Yii::app()->user->group_name == GROUP_KITCHEN){
	    		$this->redirect(array('/restoOrder/kitchen'));
	    	}

	    	/*jika group waiter*/
	    	if(Yii::app()->user->group_name == GROUP_WAITER){
	    		$this->redirect(array('/site/list_session'));
	    	}
	    	
	        $session = Session::model()->find(array(
	            'condition'=>'state in ( "' . SESSION_OPEN.'","'.SESSION_CLOSED.'" ) and user_id = ' . Yii::app()->user->id 
	        ));

	        if($session){
	            Yii::app()->session['session_id'] = $session->id;   
				$this->redirect(array('/session/view','id'=>$session->id));
         
	        }
	    }
	    else{
	        Yii::app()->session['session_id'] = null;                 
	    }		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionList_session(){
		if(!Yii::app()->user->isGuest){
			if(isset(Yii::app()->session['session_id'])){
				$this->redirect(array('/restoOrder/admin'));
			}else{
				$count = Session::model()->findAllByAttributes(array('state'=>SESSION_OPEN));

				if(count($count) > 1 or count($count) == 0){
					$criteria = new CDbCriteria();
					$criteria->condition = 'state in ("'.SESSION_OPEN.'")';

					$model = new CActiveDataProvider('Session', array(
			        	'criteria' => $criteria,
			        ));

					//var_dump($model);die;
			        $this->render('sessionList', array(
						'model'=> $model,
					)); 
				}else{
					Yii::app()->session['session_id']=$count[0]->id;
					$this->redirect(array('/restoOrder/admin')); 
				}
				
			}
		}else{
			$this->redirect(array('/site/login'));
		}
	}
}