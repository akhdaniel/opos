<?php

/**
 * This is the model class for table "cashbox_line".
 *
 * The followings are the available columns in table 'cashbox_line':
 * @property integer $id
 * @property integer $session_payment_id
 * @property integer $number_opening
 * @property integer $number_closing
 * @property integer $pieces
 * @property integer $oe_id
 */
class CashboxLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cashbox_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_payment_id, number_opening, number_closing, pieces, oe_id', 'required'),
			array('session_payment_id, number_opening, number_closing, pieces, oe_id', 'numerical', 'integerOnly'=>false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, session_payment_id, number_opening, number_closing, pieces, oe_id', 'safe', 'on'=>'search'),
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
			'session_payment_id' => 'Session Payment',
			'number_opening' => 'Number Opening',
			'number_closing' => 'Number Closing',
			'pieces' => 'Pieces',
			'oe_id' => 'Oe',
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
		$criteria->compare('session_payment_id',$this->session_payment_id);
		$criteria->compare('number_opening',$this->number_opening);
		$criteria->compare('number_closing',$this->number_closing);
		$criteria->compare('pieces',$this->pieces);
		$criteria->compare('oe_id',$this->oe_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CashboxLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
