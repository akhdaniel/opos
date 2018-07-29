<?php

/**
 * This is the model class for table "order_detail".
 *
 * The followings are the available columns in table 'order_detail':
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $qty
 * @property string $unit_price
 * @property string $amount
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Order $order
 */
class OrderDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, product_id, qty, unit_price, amount', 'required'),
			array('order_id, product_id, status, is_print', 'numerical', 'integerOnly'=>true),
			array('qty', 'numerical', 'integerOnly'=>false),
			array('unit_price, list_price, amount', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_id, product_id, qty, unit_price, amount, list_price, status, paid_status, is_print, insert_date', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'Order',
			'product_id' => 'Product',
			'qty' => 'Qty',
			'unit_price' => 'Unit Price',
			'amount' => 'Amount',
			'status' => 'Status',
			'paid_status'=> 'Paid Status',
			'is_print' => 'Is Print',
			'insert_date' => 'Insert Date',
			'note' => 'Note'
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('paid_status',$this->paid_status,true);
		//$criteria->compare('status',$this->status);
		//$criteria->compare('is_print',$this->is_print);
		$criteria->order = 'id desc';


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
	 * @return OrderDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCssClass(){

		switch ($this->status) {
			case ORDER_DETAIL_WAITING:
				return "waiting";
				break;

			case ORDER_DETAIL_ONPROGRESS:
				return "onprogress";
				break;

			case ORDER_DETAIL_DONE:
				return "done";
				break;

			case ORDER_DETAIL_DELIVERED:
				return "delivered";
				break;
		}
	}

	public function getConcate($qty, $unit_price){
		return $qty.' x '.$unit_price;
	}
}
