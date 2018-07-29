<?php

/**
 * This is the model class for table "join_payment_payment".
 *
 * The followings are the available columns in table 'join_payment_payment':
 * @property integer $id
 * @property integer $join_payment_id
 * @property integer $payment_type_id
 * @property string $amount
 * @property string $card_no
 */
class JoinPaymentPayment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'join_payment_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('join_payment_id, payment_type_id, amount', 'required'),
			array('join_payment_id, payment_type_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>20),
			array('card_no', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, join_payment_id, payment_type_id, amount, card_no', 'safe', 'on'=>'search'),
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
			'joinPayment' => array(self::BELONGS_TO, 'JoinPayment', 'join_payment_id'),
			'paymentType' => array(self::BELONGS_TO, 'PaymentType', 'payment_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'join_payment_id' => 'Join Payment',
			'payment_type_id' => 'Payment Type',
			'amount' => 'Amount',
			'card_no' => 'Card No',
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
		$criteria->compare('join_payment_id',$this->join_payment_id);
		$criteria->compare('payment_type_id',$this->payment_type_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('card_no',$this->card_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JoinPaymentPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
