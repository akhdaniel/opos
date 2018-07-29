<?php

/**
 * This is the model class for table "payment_type".
 *
 * The followings are the available columns in table 'payment_type':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $oe_id
 * @property string $code
 * @property integer $oe_debit_account_id
 * @property integer $oe_credit_account_id
 * @property integer $sorting
 *
 * The followings are the available model relations:
 * @property OrderPayment[] $orderPayments
 */
class PaymentType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, oe_id, code, oe_debit_account_id, oe_credit_account_id', 'required'),
			array('oe_id, oe_debit_account_id, oe_credit_account_id, sorting', 'numerical', 'integerOnly'=>true),
			array('name, type, code', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type, oe_id, code, oe_debit_account_id, oe_credit_account_id, sorting', 'safe', 'on'=>'search'),
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
			'orderPayments' => array(self::HAS_MANY, 'OrderPayment', 'payment_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'type' => 'Type',
			'oe_id' => 'Oe',
			'code' => 'Code',
			'oe_debit_account_id' => 'Oe Debit Account',
			'oe_credit_account_id' => 'Oe Credit Account',
			'sorting' => 'Sorting',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('oe_id',$this->oe_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('oe_debit_account_id',$this->oe_debit_account_id);
		$criteria->compare('oe_credit_account_id',$this->oe_credit_account_id);
		$criteria->compare('sorting',$this->sorting);
		$criteria->order = 'sorting asc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
