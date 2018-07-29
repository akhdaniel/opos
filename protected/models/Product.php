<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $name
 * @property string $list_price
 * @property string $default_code
 * @property string $ean13
 * @property integer $oe_id
 *
 * The followings are the available model relations:
 * @property OrderDetail[] $orderDetails
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, list_price, oe_id', 'required'),
			array('oe_id,oe_stock_account_id,oe_expense_account_id,oe_income_account_id,is_active, tax', 'numerical', 'integerOnly'=>true),
			array('name, image_url', 'length', 'max'=>200),
			array('category', 'length', 'max'=>500),
			array('list_price, discount_price', 'length', 'max'=>20),
			array('default_code, ean13', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, list_price, default_code, ean13, oe_id, discount_price,oe_stock_account_id,uom, is_active, tax, image_url', 'safe', 'on'=>'search'),
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
			'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'product_id'),
			'productDiscounts' => array(self::HAS_MANY, 'ProductDiscount', 'product_id'),
			'productGifts' => array(self::HAS_MANY, 'ProductGift', 'product_id'),
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
			'list_price' => 'List Price',
			'discount_price' => 'Discount Price',
			'default_code' => 'Default Code',
			'ean13' => 'Barcode',
			'oe_id' => 'Oe',
			'category' => 'Category',
			'oe_stock_account_id'=>'Property Stock Valuation Account',
			'oe_income_account_id'=>'Property Income Account',
			'oe_expense_account_id'=>'Property Expense Account',
			'is_active'=>'Active',
			'tax'=>'Tax',
			'image_url'=>'Image Url',
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
		$criteria->compare('list_price',$this->list_price,true);
		$criteria->compare('discount_price',$this->discount_price,true);
		$criteria->compare('default_code',$this->default_code,true);
		$criteria->compare('ean13',$this->ean13,true);
		$criteria->compare('oe_id',$this->oe_id);
		$criteria->compare('oe_stock_account_id',$this->oe_stock_account_id);
		$criteria->compare('category',$this->category);
		$criteria->compare('uom',$this->uom);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('image_url',$this->image_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'pagination'=>array(
                    'pageSize'=> Yii::app()->user->getState('pageSize',
                    	Yii::app()->params['defaultPageSize']),
            ),	
		));
	}

	public function searchGrid()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('list_price',$this->list_price,true);
		$criteria->compare('discount_price',$this->discount_price,true);
		$criteria->compare('default_code',$this->default_code,true);
		$criteria->compare('ean13',$this->ean13,true);
		$criteria->compare('oe_id',$this->oe_id);
		$criteria->compare('oe_stock_account_id',$this->oe_stock_account_id);
		$criteria->compare('category',$this->category);
		$criteria->compare('uom',$this->uom);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('image_url',$this->image_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 8),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	update list_price sesuai discount & cek apakah discount enable
	**/
	public function calcDiscount($qty){
		$new_price = $this->list_price;

		foreach ($this->productDiscounts as $dis ){
			if ($qty >= $dis->qty && $dis->enable==1){
				$new_price = $this->list_price - $dis->nominal - ($this->list_price * $dis->percent/100 );
				//break;
			}
		}

		return $new_price ;
	}

	public function getCssClass(){
		if($this->status == 0){
			return "out_of_stock";
		}
	}
}
