<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $id
 * @property string $number
 * @property string $order_date
 * @property integer $salesman_id
 * @property string $total_paid
 * @property string $total_change
 * @property integer $state
 * @property integer $oe_id
 *
 * The followings are the available model relations:
 * @property OrderDetail[] $orderDetails
 * @property OrderPayment[] $orderPayments
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, order_date, salesman_id, total_paid, total_change, state', 'required'),
			array('salesman_id, table_id', 'numerical', 'integerOnly'=>true),
			array('number, total_paid, total_change', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, order_date, table_id, salesman_id, total_paid, total_change, state, notes, session_id, order_notes', 'safe', 'on'=>'search'),
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
			'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'order_id'),
			'orderPayments' => array(self::HAS_MANY, 'OrderPayment', 'order_id'),
			'session' => array(self::BELONGS_TO, 'Session', 'session_id'),
			//'total' => array(self::STAT, 'OrderDetail', 'order_id', 'select'=>'sum(amount)', 'condition'=>'paid_status = "UNPAID"'),
			'table'=> array(self::BELONGS_TO, 'Table', 'table_id'),
			'joinPaymentDetails' => array(self::HAS_MANY, 'JoinPaymentDetail', 'order_id'),
			'customer'=>array(self::BELONGS_TO, 'CustomerType', 'customer_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'order_date' => 'Order Date',
			'salesman_id' => 'Salesman',
			'total_paid' => 'Total Paid',
			'total_change' => 'Total Change',
			'state' => 'State',
			'notes' => 'No. Struk',
			'oe_id' => 'Oe',
			'table_id'=> 'Table Name',
			'order_notes' => 'Order Notes',
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

		$criteria->compare('id',          $this->id);
		$criteria->compare('number',      $this->number,true);
		///$criteria->compare('order_date',  $this->order_date,true);
		$criteria->compare('salesman_id', $this->salesman_id);
		$criteria->compare('session_id',  $this->session_id );
		//$criteria->compare('total_paid',  $this->total_paid,true);
		///$criteria->compare('total_change',$this->total_change,true);
		$criteria->compare('state',       $this->state);
		$criteria->compare('oe_id',       $this->oe_id);
		$criteria->compare('notes',       $this->notes,true);
		$criteria->order = 'id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchWaiter()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',          $this->id);
		$criteria->compare('number',      $this->number,true);
		///$criteria->compare('order_date',  $this->order_date,true);
		$criteria->compare('salesman_id', $this->salesman_id);
		$criteria->compare('session_id',  $this->session_id );
		//$criteria->compare('total_paid',  $this->total_paid,true);
		///$criteria->compare('total_change',$this->total_change,true);
		//$criteria->compare('state',       $this->state);
		$criteria->condition = 'state in ("'.ORDER_NEW.'","'.ORDER_CONFIRM.'")';
		$criteria->compare('oe_id',       $this->oe_id);
		$criteria->compare('notes',       $this->notes,true);
		$criteria->order = 'id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/*********************************************************************
	* create OE pos.order
	* 
	*********************************************************************/

	public static function createOeOrder($model){
		$session 		= Session::model()->findByPk(Yii::app()->session['session_id']);

		list($oe, $user_id) = oeLogin();
				
		//order lines:
		if(! $model->orderDetails ){
			return -1;
		}

		$lines = Order::generateLines($model);


		//order payment:
		if (! $model->orderPayments){
			return -1;
		}

		$payments = Order::generatePayments($model);

		//order:
		$values = array(
			'name'		=> new xmlrpcval($model->number , "string") ,
			'pos_reference'	=> new xmlrpcval($model->number , "string") ,
			'user_id'	=> new xmlrpcval( $model->salesman_id , "int"),
			'amount_paid'=> new xmlrpcval($model->total_paid , "double") ,
			'session_id'=> new xmlrpcval( $session->oe_id , "int") ,
			'amount_tax'=> new xmlrpcval(0, "double") ,
			'amount_return'=> new xmlrpcval($model->total_change, "double") ,
			'amount_total'=> new xmlrpcval($model->total, "double") ,
			'lines'=>$lines,
			'statement_ids'=>$payments,
			'pricelist_id'=> new xmlrpcval(1, "int") ,
		);
		$order_id = $oe->create($values, "pos.order");

		//kalau berhasil, update local order: oe_id
		if($order_id>0){
			$fields = array('name','id');
			$orders = $oe->read(array($order_id), $fields, "pos.order");
			$model->oe_id = $order_id;
			$model->number = $orders[0]['name'];
			$model->state = ORDER_POSTED;
			$model->save();

			//exec wf paid:
			$oe->execWf("paid", "pos.order", $order_id);
		}

		return $order_id;
	}	

	/*********************************************************************
	* untuk generate xmlrpc order lines
	* 
	*********************************************************************/

	private static function generateLines($model){

		if (! $model->orderDetails){
			return null;
		}

		$ols = array();
		foreach($model->orderDetails as $ol) {
			$ols[] = new xmlrpcval(
					array(
						new xmlrpcval(0,'int'),
						new xmlrpcval(0,'int'),
						new xmlrpcval(
							array(
								'discount'   => new xmlrpcval(0, 'double'), 
								'price_unit' => new xmlrpcval($ol->unit_price, 'double'), 
								'product_id' => new xmlrpcval($ol->product->oe_id, 'int'), 
								'qty'        => new xmlrpcval($ol->qty, 'double')
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

	/*********************************************************************
	* untuk generate xmlrpc order payment (bank statement )
	* 
	*********************************************************************/
	private static function generatePayments($model){

		if (! $model->orderPayments){
			return null;
		}

		$apps = AppSetting::model()->findOrCreate('ar_account_id','1353');
		$ar_account_id = $apps->val;

		$ols = array();
		foreach($model->orderPayments as $op) {
			//replace name Unposted => ''
			$model->number = str_replace('Unposted', '', $model->number);

			//cari statement_id utk masing-masing payment type session ini
			$spy = SessionPayment::model()->find('session_id=:sid and payment_type_id=:pid',
				array('sid'=> Yii::app()->session['session_id'],
					'pid'=> $op->paymentType->id)
			);

			if($op->card_no != 'return'){// bukan return , kalau return dibuat khusus entry di bawah setelah ini
				$ops[] = new xmlrpcval(
					array(
						new xmlrpcval(0,'int'),
						new xmlrpcval(0,'int'),
						new xmlrpcval(
							array(
								'journal_id'   	=> new xmlrpcval($op->paymentType->oe_id , 'int'), 
								'amount' 		=> new xmlrpcval($op->amount, 'double'), 
								'name' 			=> new xmlrpcval($model->number, 'string'), 
								'account_id'    => new xmlrpcval($ar_account_id, 'int'),
								'statement_id'  => new xmlrpcval($spy->oe_statement_id, 'int') // dicreate waktu create session
							), 
							"struct"
						)
					),
					"array"
				);

			}
		}


		//jika ada kembalian: buat khusus entry kembalian
		if ($model->total_change>0){
			//cari CASH statement_id utk masing-masing payment type session ini
			$cash = PaymentType::model()->find('type="cash"');
			$spy = SessionPayment::model()->find('session_id=:sid and payment_type_id=:pid',
				array('sid'=> Yii::app()->session['session_id'],
					'pid'=> $cash->id)
			);

			$ops[] = new xmlrpcval(
				array(
					new xmlrpcval(0,'int'),
					new xmlrpcval(0,'int'),
					new xmlrpcval(
						array(
							'journal_id'   	=> new xmlrpcval($cash->oe_id , 'int'), 
							'amount' 		=> new xmlrpcval($model->total_change * -1, 'double'), 
							'name' 			=> new xmlrpcval($model->number . ': return', 'string'), 
							'account_id'    => new xmlrpcval($ar_account_id, 'int'),
							'statement_id'  => new xmlrpcval($spy->oe_statement_id, 'int') // dicreate waktu create session
						), 
						"struct"
					)
				),
				"array"
			);			
		}

		$lines = new xmlrpcval(
			$ops,
			"array"
		);

		return $lines;		
	}	


	/**
	total non discount
	**/
	public function getTotalListPrice(){
		if($this->state == ORDER_NEW || $this->state == ORDER_CONFIRM){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(qty * list_price) as s')
			    ->from('order_detail')
			    ->where('order_detail.order_id=:id and order_detail.paid_status=:status', array(':id'=>$this->id, ':status'=>'UNPAID'))
			    ->queryRow();
			return $row['s'] + 0;
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(qty * list_price) as s')
			    ->from('order_detail')
			    ->where('order_detail.order_id=:id and order_detail.paid_status=:status', array(':id'=>$this->id, ':status'=>'PAID'))
			    ->queryRow();
			return $row['s'] + 0;
		}
	}	
	/**
	total discount
	**/
	public function getTotalDiscount(){
		if($this->state == ORDER_NEW || $this->state == ORDER_CONFIRM){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(qty * list_price) - sum(qty * unit_price) as s')
			    ->from('order_detail')
			    ->where('order_detail.order_id=:id and order_detail.paid_status=:status', array(':id'=>$this->id, ':status'=>'UNPAID'))
			    ->queryRow();
			return $row['s'] + 0;
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(qty * list_price) - sum(qty * unit_price) as s')
			    ->from('order_detail')
			    ->where('order_detail.order_id=:id and order_detail.paid_status=:status', array(':id'=>$this->id, ':status'=>'PAID'))
			    ->queryRow();
			return $row['s'] + 0;
		}
	}

	/**
	total discount
	**/
	public function getTotal(){
		if($this->state == ORDER_NEW || $this->state == ORDER_CONFIRM){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(amount) as s')
			    ->from('order_detail')
			    ->where('order_detail.order_id=:id and order_detail.paid_status=:status', array(':id'=>$this->id, ':status'=>'UNPAID'))
			    ->queryRow();
			return ($row['s'] + 0);
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(amount) as s')
			    ->from('order_detail')
			    ->where('order_detail.order_id=:id and order_detail.paid_status=:status', array(':id'=>$this->id, ':status'=>'PAID'))
			    ->queryRow();
			return ($row['s'] + 0);
		}
		
	}
	/**
	new number logic
	POS/0003/00001
	replace: 0001
	n++ : 2
	new:
	POS/0003/00002
	**/
	public function getNumber(){
		$prefix = 'POS/' . sprintf("%04d", Yii::app()->user->id) . '/';

		$criteria = new CDbCriteria();
		// $criteria->condition  = "status <> :s";
		$criteria->condition = 'salesman_id = ' .  Yii::app()->user->id;
		$criteria->order = "id DESC";
		$criteria->limit = 1;
		$last = Order::model()->find($criteria);
		if($last)
		{
			$number = $last->notes;
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

	public function beforeSave(){
		if(parent::beforeSave()){
		    if($this->isNewRecord){
		    	$this->customer_type = REGULAR_CUSTOMER;
		    }
		    return true;
		}else{
		    return false;
		}
	}
}
