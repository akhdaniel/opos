<?php
Yii::import('application.vendor.*');
require_once('openerp-php-connector/openerp.class.php');

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    private $_id;
    private $_group_id;
 

	public function authenticate()
	{
		$oe=null;

		$as = AppSetting::model()->findOrCreate('auth_oe',"0");
		$auth_oe = $as->val;

		if($auth_oe == 1)
			list($oe, $userId) = oeLogin($this->username, $this->password);
		else
		{
			$user = User::model()->find('login=:l and password=:p', array('l'=>$this->username, 'p'=>$this->password));
			if($user)
				$userId = $user->oe_id;
			else
				$userId = -1;
		}

		if( $userId < 0)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
			$this->_id = $userId;
			//Yii::app()->session['oe_password']= $this->password;	
			//Yii::app()->session['oe_userid']= $userId;	
			//Yii::app()->session['oe']= $oe;	
			Yii::app()->user->setState('oe', $oe);	
			Yii::app()->user->setState('oe_password', $this->password);	
			Yii::app()->user->setState('oe_userid', $userId);
			Yii::app()->user->setState('group_name', $user->group_name);	
		}
		return !$this->errorCode;
	}
	
    public function getId()
    {
        return $this->_id;
    }	
    
}