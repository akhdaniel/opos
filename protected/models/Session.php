<?php

/**
 * This is the model class for table "session".
 *
 * The followings are the available columns in table 'session':
 * @property integer $id
 * @property string $name
 * @property string $open_date
 * @property string $close_date
 * @property string $total_sales
 * @property string $total_drawer
 * @property string $difference
 * @property integer $user_id
 * @property integer $oe_id
 * @property integer $state
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 */
class Session extends CActiveRecord
{
	public $start_date;
	public $end_date;
	public $tdrawer;
	public $tdifference;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'session';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, open_date, user_id', 'required'),
			array('user_id, oe_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('total_sales, total_drawer, difference', 'length', 'max'=>20),
			array('close_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, open_date, close_date, total_sales, total_drawer, difference, user_id, oe_id, state', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'session_id'),
		);
	}


	/**
	all sales Nett 
	**/
	public function getTotal($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(order_detail.amount) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->where('session.id=:id and order_detail.tax=0 and  order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$this->id))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(order_detail.amount) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->where('order_detail.tax=0 and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryRow();
		}
	
		return $row['s'];
	}

	public function getTotalppn($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(order_detail.amount) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->where('session.id=:id and order_detail.tax=1 and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$this->id))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(order_detail.amount) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->where('order_detail.tax=1 and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryRow();
		}

		return $row['s'];

	}

	/**
	all sales Non Discount
	**/
	public function getTotalListPrice($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(order_detail.list_price * qty) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->where('session.id=:id and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$this->id))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(order_detail.list_price * qty) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->where('order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryRow();
		}
		
		return $row['s'];
	}
	/**
	all discount 
	**/
	public function getTotalDiscount($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select(' sum(qty*order_detail.list_price) - sum(qty*order_detail.unit_price)  as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->where('session.id=:id and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$this->id))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select(' sum(qty*order_detail.list_price) - sum(qty*order_detail.unit_price)  as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->where('order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryRow();
		}
		return $row['s'];

	}

	public function getTotalDiscountSpecial($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select(' sum(discount_special) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->where('session.id=:id and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$this->id))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select(' sum(discount_special) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->where('order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryRow();
		}
		return $row['s'];

	}


	/**
	cash sales only
	**/
	public function getTotalCash($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(order_payment.amount) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_payment', 'order_payment.order_id = order.id')
			    ->join('payment_type', 'order_payment.payment_type_id = payment_type.id')
			    ->where('session.id=:id and payment_type.type=:pt and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$this->id, 'pt'=>'cash'))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(order_payment.amount) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_payment', 'order_payment.order_id = order.id')
			    ->join('payment_type', 'order_payment.payment_type_id = payment_type.id')
			    ->where('payment_type.type=:pt and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")', array('pt'=>'cash'))
			    ->queryRow();
		}
		return $row['s'];

	}
	/**
	all sales HPP
	**/
	public function getTotalHpp($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(product.cost_price * qty) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->join('product', 'order_detail.product_id = product.id')
			    ->where('session.id=:id and order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") ', array('id'=>$this->id))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(product.cost_price * qty) as s')
			    ->from('session')
			    ->join('order', 'order.session_id = session.id')
			    ->join('order_detail', 'order_detail.order_id = order.id')
			    ->join('product', 'order_detail.product_id = product.id')
			    ->where('order.state not in ("'.ORDER_NEW.'", "'.ORDER_CANCEL.'") and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")')
			    ->queryRow();
		}
		return $row['s'];
	}
	/**
	total opening cash
	**/
	public function getTotalCashOpening($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(cashbox_line.number_opening * cashbox_line.pieces) as s')
			    ->from('session')
			    ->join('session_payment', 'session_payment.session_id = session.id')
			    ->join('payment_type', 'session_payment.payment_type_id = payment_type.id')
			    ->join('cashbox_line', 'cashbox_line.session_payment_id = session_payment.id')
			    ->where('session.id=:id and payment_type.type=:pt', array(':id'=>$this->id, 'pt'=>'cash'))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(cashbox_line.number_opening * cashbox_line.pieces) as s')
			    ->from('session')
			    ->join('session_payment', 'session_payment.session_id = session.id')
			    ->join('payment_type', 'session_payment.payment_type_id = payment_type.id')
			    ->join('cashbox_line', 'cashbox_line.session_payment_id = session_payment.id')
			    ->where('payment_type.type=:pt and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")', array('pt'=>'cash'))
			    ->queryRow();
		}
		return $row['s'];

	}

	/**
	total closing cash
	**/
	public function getTotalCashClosing($start = null, $end = null){
		if($start == null and $end == null){
			$row = Yii::app()->db->createCommand()
			    ->select('sum(cashbox_line.number_closing * cashbox_line.pieces) as s')
			    ->from('session')
			    ->join('session_payment', 'session_payment.session_id = session.id')
			    ->join('payment_type', 'session_payment.payment_type_id = payment_type.id')
			    ->join('cashbox_line', 'cashbox_line.session_payment_id = session_payment.id')
			    ->where('session.id=:id and payment_type.type=:pt', array(':id'=>$this->id, 'pt'=>'cash'))
			    ->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
			    ->select('sum(cashbox_line.number_closing * cashbox_line.pieces) as s')
			    ->from('session')
			    ->join('session_payment', 'session_payment.session_id = session.id')
			    ->join('payment_type', 'session_payment.payment_type_id = payment_type.id')
			    ->join('cashbox_line', 'cashbox_line.session_payment_id = session_payment.id')
			    ->where('payment_type.type=:pt and session.close_date BETWEEN "'.$start.'" and "'.$end.'" and session.state not in ("'.SESSION_OPEN.'")', array('pt'=>'cash'))
			    ->queryRow();
		}
		return $row['s'];
	}	

	/**
	 @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'open_date' => 'Open Date',
			'close_date' => 'Close Date',
			'total_sales' => 'Total Sales',
			'total_drawer' => 'Total Drawer',
			'difference' => 'Difference',
			'user_id' => 'User',
			'oe_id' => 'Oe',
			'state' => 'State',
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
		$criteria->compare('open_date',$this->open_date,true);
		$criteria->compare('close_date',$this->close_date,true);
		$criteria->compare('total_sales',$this->total_sales,true);
		$criteria->compare('total_drawer',$this->total_drawer,true);
		$criteria->compare('difference',$this->difference,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('oe_id',$this->oe_id);
		$criteria->compare('state',$this->state);
		$criteria->order = 'open_date desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Session the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**

	 * create OE pos.session data
	 * @param CModel the model to be created on OpenERP
	
	 */
	public static function createOeSession($model){

		list($oe, $user_id) = oeLogin();

		$as = AppSetting::model()->findOrCreate('pos_config_id',1);
		$pos_config_id = $as->val;
		
		$values = array(
			'name'		=> new xmlrpcval($model->name , "string") ,
			'config_id'	=> new xmlrpcval($pos_config_id , "int"),
			'start_at'	=> new xmlrpcval($model->open_date , "string") ,
		);
		$session_id = $oe->create($values, "pos.session");

		if($session_id>0){
			//update local session oe_id
			$fields = array('name','id');
			$session = $oe->read(array($session_id), $fields, "pos.session");
			$model->oe_id = $session_id;
			$model->name = $session[0]['name'];
			$model->save();
		}

		//execute open wf
		//$oe->execWf('open', 'pos.session', $session_id );
		$oe->execWf('opening_control', 'pos.session', $session_id );


		return $session_id;
	}

	/**
	create cash box line
	**/
	public static function createCashbox($model){
		list($oe, $user_id) = oeLogin();

		//create account cashbox line for this session => bank statement id
		//1. cari dulu bank statement id cash
		$pt = PaymentType::model()->find('type="cash"', array());
		$bs = SessionPayment::model()->find('session_id=:sid and payment_type_id=:pid', 
			array('sid'=>$model->id, 'pid'=>$pt->id));
		$oe_cbl_ids = $oe->search('bank_statement_id.id', '=', $bs->oe_statement_id, 'account.cashbox.line');
		//var_dump($oe_cbl_ids);die;

		if($oe_cbl_ids != -1){
			$fields = array('id','number_opening','number_closing','pieces');
			$oe_cbls = $oe->read($oe_cbl_ids, $fields, 'account.cashbox.line');
			if($oe_cbls != -1){
				foreach ($oe_cbls as $i => $cbl) {
					$c = new CashboxLine;
					$c->number_opening = $cbl['number_opening'];
					$c->number_closing = $cbl['number_closing'];
					$c->pieces = $cbl['pieces'];
					$c->oe_id = $cbl['id'];
					$c->session_payment_id = $bs->id;
					if(! $c->save()){
						print "error save cb line " . 
						var_dump($c->getErrors());
						die;
					}
				}
			}
		} else {
			print 'Please setup Cash Control on Cash Journal Payment';
			die;
		}		
	}

	public static function createLocalCashbox($model){

		$pt = PaymentType::model()->find('type="cash"', array());
		$bs = SessionPayment::model()->find('session_id=:sid and payment_type_id=:pid', 
			array('sid'=>$model->id, 'pid'=>$pt->id));

		$pieces = array(100000, 50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100, 50);

		foreach ($pieces as $piece) {
			$c = new CashboxLine;
			$c->number_opening = 0;
			$c->number_closing = 0;
			$c->pieces = $piece;
			$c->oe_id = 0;
			$c->session_payment_id = $bs->id;
			if(! $c->save()){
				print "error save cb line " . 
				var_dump($c->getErrors());
				die;
			}
		}

	}

	/**
	close oe session
	**/
	public static function closeOeSession($model){
		list($oe, $user_id) = oeLogin();

		$values = array(
			'cash_register_balance_end_real'=> new xmlrpcval($model->total_drawer , "int") ,
		);

		if($sid = $oe->write(array($model->oe_id), $values, 'pos.session')){
			$wf = $oe->execWf('close', 'pos.session', $model->oe_id );			
			if($wf>0){
				$model->state = SESSION_POSTED;
				$model->save();			
			}		
		}

		return $wf;			
	}

	public function getNumber(){
		
		$prefix = 'S/' . sprintf("%04d", Yii::app()->user->id) . '/';

		$criteria = new CDbCriteria();
		$criteria->condition = 'user_id = ' .  Yii::app()->user->id;
		$criteria->order = "id DESC";
		$criteria->limit = 1;
		$last = Session::model()->find($criteria);

		if($last){
			$number = $last->name;
			$n = str_replace($prefix, '', $number) + 0 ;
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
