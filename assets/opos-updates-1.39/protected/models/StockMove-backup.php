<?php

/**
 * This is the model class for table "stock_move".
 *
 * The followings are the available columns in table 'stock_move':
 * @property integer $id
 * @property integer $session_id
 * @property integer $product_id
 * @property string $qty
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Session $session
 */
class StockMove extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_move';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id, product_id, qty', 'required'),
			array('session_id, product_id, is_active', 'numerical', 'integerOnly'=>true),
			array('qty', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, session_id, product_id, qty, is_active', 'safe', 'on'=>'search'),
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
			'product_id' => 'Product',
			'qty' => 'Qty',
			'is_active'=> 'Is Active',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('is_active',$this->is_active);

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
	 * @return StockMove the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



	public static function createStockMove($session_id){

		$resp = new stdClass;

		$session 		= Session::model()->findByPk($session_id);

		list($oe, $user_id) = oeLogin();
		if($user_id==-1)
		{
			$resp->status = 'error';
			$resp->msg = 'login failed';
			return $resp;
		}
		
		$lines = StockMove::model()->generateStockMoveLines($session_id);

		if(!$lines)
		{
			$resp->status = 'success';
			$resp->msg = 'No more stock move line to post';
			return $resp;
		}

		//delivery order:
		$values = array(
			'origin'			=> new xmlrpcval($session->name , "string") ,
			'min_date'			=> new xmlrpcval($session->close_date , "string") ,
			'state'				=> new xmlrpcval('done', "string"),
			'move_lines'		=> $lines,
		);

		$resp = $oe->create($values, "stock.picking.out");

		//kalau berhasil, update stock_move posted 
		if($resp->status == 'success' ){
	        $connection=Yii::app()->db;
	        $command=$connection->createCommand("UPDATE `stock_move` set state = '". STOCK_MOVE_POSTED ."' where session_id = {$session_id}");
	        $command->query();
		}
		return $resp;
	}	


	public static function generateStockMoveLines($session_id){


		$stockMoves = StockMove::model()->findAll("session_id = :id  and state = :state and is_active = :is_active", 
			array('id'=>$session_id, 'state'=>STOCK_MOVE_UNPOSTED, 'is_active'=>1));

		if (!$stockMoves)
			return null;

		$as = AppSetting::model()->findOrCreate('shop_id','11');
		$shop_id = $as->val;

		$ols = array();
		foreach($stockMoves as $sm) {
			$ols[] = new xmlrpcval(
					array(
						new xmlrpcval(0,'int'),
						new xmlrpcval(0,'int'),
						new xmlrpcval(
							array(
								'name'				=> new xmlrpcval($sm->name , "string") ,
								'product_id'		=> new xmlrpcval($sm->product_id , "int") ,
								'product_qty'		=> new xmlrpcval($sm->qty , "double") ,
								'product_uom'		=> new xmlrpcval($sm->product->uom , "int") ,
								'location_id'		=> new xmlrpcval($sm->source_location_id , "int") ,
								'location_dest_id'	=> new xmlrpcval($sm->dest_location_id , "int") ,
								'date_expected'		=> new xmlrpcval($sm->datetime , "string") ,
								'state'				=> new xmlrpcval('done', "string") ,
								'shop_id'			=> new xmlrpcval($shop_id, "int") ,
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
