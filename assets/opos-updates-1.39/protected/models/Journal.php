<?php

/**
 * This is the model class for table "journal".
 *
 * The followings are the available columns in table 'journal':
 * @property integer $id
 * @property integer $session_id
 * @property string $name
 * @property string $datetime
 * @property integer $account_id
 * @property string $debit
 * @property string $credit
 * @property string $reference
 * @property string $state
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Session $session
 */
class Journal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'journal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id, name, datetime, account_id, debit, credit', 'required'),
			array('session_id, account_id', 'numerical', 'integerOnly'=>true),
			array('name, reference', 'length', 'max'=>200),
			array('debit, credit', 'length', 'max'=>20),
			array('state', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, session_id, name, datetime, account_id, debit, credit, reference, state', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'session' => array(self::BELONGS_TO, 'Session', 'session_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'session_id' => 'Session',
			'name' => 'Name',
			'datetime' => 'Datetime',
			'account_id' => 'Account',
			'debit' => 'Debit',
			'credit' => 'Credit',
			'reference' => 'Reference',
			'state' => 'State',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('state',$this->state,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'pagination'=>array(
                    'pageSize'=>100
            ),				
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Journal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTotalFooterCredit($ids)
    {
        if (!$ids){
        	return 0;
        }
        $ids = implode(",",$ids);

        $connection=Yii::app()->db;
        $command=$connection->createCommand("SELECT SUM(credit) FROM `journal` where id in ($ids)");
        return $amount = $command->queryScalar();
    }
    
	public function getTotalFooterDebit($ids)
    {
        if (!$ids){
        	return 0;
        }
        $ids = implode(",",$ids);

        $connection=Yii::app()->db;
        $command=$connection->createCommand("SELECT SUM(debit) FROM `journal` where id in ($ids)");
        return $amount = $command->queryScalar();
    }	

	public static function getTotalCredit($session_id)
    {
        if (!$session_id){
        	return 0;
        }
        $connection=Yii::app()->db;
        $command=$connection->createCommand("SELECT SUM(credit) FROM `journal` where session_id = $session_id and state='UNPOSTED'");
        return $amount = $command->queryScalar();
    }     

	public static function getTotalDebit($session_id)
    {
        if (!$session_id){
        	return 0;
        }
        $connection=Yii::app()->db;
        $command=$connection->createCommand("SELECT SUM(debit) FROM `journal` where session_id = $session_id and state='UNPOSTED'");
        return $amount = $command->queryScalar();
    }    


    /*
    generate account.move 
    based on journal data where session_id=:session_id and state=UNPOSTED
    */

	public static function createAccountMove($session_id){

		$resp = new stdClass;

		$session 		= Session::model()->findByPk($session_id);


		$as = AppSetting::model()->findOrCreate('shop_id','11');
		$shop_id = $as->val;

		$as = AppSetting::model()->findOrCreate('pos_journal_id','44');
		$pos_journal_id = $as->val;

		list($oe, $user_id) = oeLogin();
		
		if($user_id==-1)
		{
			$resp->status = 'error';
			$resp->msg = 'login failed';
			return $resp;
		}
						
		$lines = Journal::model()->generateAccountMoveLines($session_id);
		if(!$lines){
			$resp->status = 'success';
			$resp->msg = 'No more account move line to post';
			return $resp;
		}

		//account move:
		$values = array(
			'journal_id'	=> new xmlrpcval($pos_journal_id , "int") ,
			'ref'			=> new xmlrpcval($session->name , "string") ,
			'date'			=> new xmlrpcval($session->close_date , "string") ,
			'shop_id'		=> new xmlrpcval($shop_id , "int") ,
			'line_id'		=> $lines,

			//fieldnya period_id = 
		);
		$resp = $oe->create($values, "account.move");

		//kalau berhasil, update journal posted 
		if($resp->status == 'success' ){
			
			$move_id = $resp->msg; 

			$resp2 = $oe->exec("post", "account.move", array($move_id) ) ;
			if($resp2->status=='success'){
		        $connection=Yii::app()->db;

		        $command=$connection->createCommand("UPDATE `journal` set state = '". JOURNAL_POSTED ."' where session_id = $session_id");
		        $command->query();

			}
			return $resp2;
		}
		return $resp;
	}


	private static function generateAccountMoveLines($session_id){

		$journals = Journal::model()->findAll('session_id = :id and state = :state', 
			array('id'=>$session_id, 'state'=>JOURNAL_UNPOSTED));

		if (!$journals)
			return null;

		$ols = array();
		foreach($journals as $ol) {
			$ols[] = new xmlrpcval(
					array(
						new xmlrpcval(0,'int'),
						new xmlrpcval(0,'int'),
						new xmlrpcval(
							array(
								'date'   		=> new xmlrpcval($ol->datetime, 'string'), 
								'name' 			=> new xmlrpcval($ol->name, 'string'), 
								'ref' 			=> new xmlrpcval($ol->reference, 'string'), 
								'account_id'	=> new xmlrpcval($ol->account_id, 'int'),
								'debit'       	=> new xmlrpcval($ol->debit, 'double'),
								'credit'       	=> new xmlrpcval($ol->credit, 'double'),
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

		return $lines;		
	}
}
