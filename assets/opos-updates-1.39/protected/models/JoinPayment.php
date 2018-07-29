<?php

/**
 * This is the model class for table "join_payment".
 *
 * The followings are the available columns in table 'join_payment':
 * @property integer $id
 * @property string $join_number
 * @property string $join_date
 * @property string $total_paid
 * @property string $total_change
 * @property string $state
 * @property integer $salesman_id
 * @property integer $session_id
 */
class JoinPayment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'join_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('join_number, join_date, total_paid, total_change, state, salesman_id, session_id', 'required'),
			array('salesman_id, session_id', 'numerical', 'integerOnly'=>true),
			array('join_number', 'length', 'max'=>100),
			array('total_paid, total_change', 'length', 'max'=>20),
			array('state', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, join_number, join_date, total_paid, total_change, state, salesman_id, session_id', 'safe', 'on'=>'search'),
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
			'joinPaymentDetails' => array(self::HAS_MANY, 'JoinPaymentDetail', 'join_payment_id'),
			'joinPaymentPayments' => array(self::HAS_MANY, 'JoinPaymentPayment', 'join_payment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'join_number' => 'Join Number',
			'join_date' => 'Join Date',
			'total_paid' => 'Total Paid',
			'total_change' => 'Total Change',
			'state' => 'State',
			'salesman_id' => 'Salesman',
			'session_id' => 'Session',
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
		$criteria->compare('join_number',$this->join_number,true);
		$criteria->compare('join_date',$this->join_date,true);
		$criteria->compare('total_paid',$this->total_paid,true);
		$criteria->compare('total_change',$this->total_change,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('salesman_id',$this->salesman_id);
		$criteria->compare('session_id',$this->session_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JoinPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNumberJoin(){
		$prefix = 'POS/JOIN/' . sprintf("%04d", Yii::app()->user->id) . '/';

		$criteria = new CDbCriteria();
		// $criteria->condition  = "status <> :s";
		$criteria->condition = 'salesman_id = ' .  Yii::app()->user->id;
		$criteria->order = "id DESC";
		$criteria->limit = 1;
		$last = JoinPayment::model()->find($criteria);
		if($last)
		{
			$number = $last->join_number;
			$n = str_replace($prefix, '', $number) + 0;
			$n++;	
		}
		else
		{
			$n = 1;
		}
		$new_number = $prefix . sprintf("%05d", $n);
		return $new_number;
	}
}
