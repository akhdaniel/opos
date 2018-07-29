<?php

/**
 * This is the model class for table "session_payment".
 *
 * The followings are the available columns in table 'session_payment':
 * @property integer $id
 * @property integer $session_id
 * @property integer $payment_type_id
 * @property integer $oe_statement_id
 */
class SessionPayment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'session_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id, payment_type_id, oe_statement_id', 'required'),
			array('session_id, payment_type_id, oe_statement_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, session_id, payment_type_id, oe_statement_id', 'safe', 'on'=>'search'),
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
			'payment_type_id' => 'Payment Type',
			'oe_statement_id' => 'Oe Statement',
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
		$criteria->compare('payment_type_id',$this->payment_type_id);
		$criteria->compare('oe_statement_id',$this->oe_statement_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SessionPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);

	}

	/******************************************************************************
	* update SessionPayment ID
	* cari session OE, looping statement_ids
	* update ke session_payment, oe_id nya
	******************************************************************************/
	public static function updateSessionPayment($session_id){

		$session = Session::model()->findByPk($session_id);

		list($oe, $user_id) = oeLogin();

		if($session->oe_id)
		{
			$fields = array("id","name","statement_ids");
			$sessions = $oe->read(array($session->oe_id), $fields, "pos.session");

			foreach ($sessions as $i => $s) {
				$fields = array("id","name","code","journal_id");
				// untuk setiap bank.statement session ini:
				// update SessionPayment.statement_id = bank.statement.id
				// untuk session_id ini dan PaymentType.code = bank.statement.code
				$bs = $oe->read( $s['statement_ids'] , $fields, "account.bank.statement");

				foreach ($bs as $statement){
					$pt = PaymentType::model()->find('oe_id=:oe_id', 
						array('oe_id'=>$statement['journal_id'][0]));

					$spy = new SessionPayment;
					$spy->session_id=$session_id;
					$spy->payment_type_id=$pt->id;
					$spy->oe_statement_id = $statement['id']; //ini yg mau diambil waktu payment 
					$spy->save();
				}
			}

		}

	}

	public static function createLocalSessionPayment($session_id)
	{
		$pts = PaymentType::model()->findAll();

		foreach ($pts as $pt){
			$spy = new SessionPayment;
			$spy->session_id=$session_id;
			$spy->payment_type_id=$pt->id;
			$spy->oe_statement_id = 0;
			$spy->save();
		}
	}
}
