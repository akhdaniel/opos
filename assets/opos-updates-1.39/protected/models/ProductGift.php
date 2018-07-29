<?php

/**
 * This is the model class for table "product_gift".
 *
 * The followings are the available columns in table 'product_gift':
 * @property integer $id
 * @property integer $product_id
 * @property string $buy_qty
 * @property integer $gift_product_id
 * @property string $get_qty
 *
 * The followings are the available model relations:
 * @property Product $giftProduct
 * @property Product $product
 */
class ProductGift extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_gift';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, buy_qty, gift_product_id, get_qty', 'required'),
			array('product_id, gift_product_id, enable', 'numerical', 'integerOnly'=>true),
			array('buy_qty, get_qty', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, buy_qty, gift_product_id, get_qty, enable', 'safe', 'on'=>'search'),
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
			'giftProduct' => array(self::BELONGS_TO, 'Product', 'gift_product_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'buy_qty' => 'Buy Qty',
			'gift_product_id' => 'Gift Product',
			'get_qty' => 'Gift Qty',
			'enable' => 'Enable',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('buy_qty',$this->buy_qty,true);
		$criteria->compare('gift_product_id',$this->gift_product_id);
		$criteria->compare('get_qty',$this->get_qty,true);
		$criteria->compare('enable',$this->enable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductGift the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
