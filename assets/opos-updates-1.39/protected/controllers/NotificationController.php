<?php

class NotificationController extends Controller
{
	public function actionCheckReady()
	{
		if(!Yii::app()->user->isGuest){
			$return = array();
			$count = 0;

			$criteria = new CDbCriteria();
			$criteria->with = array('orderDetail');
			$criteria->condition = 'orderDetail.status in ("'.ORDER_DETAIL_DONE.'")';


			$model = Notification::model()->findAll($criteria);
			//var_dump($model);die;
			if($model){
				foreach ($model as $m) {
					/*chek for session*/
					$order = Order::model()->findByPk($m->order_id);
					if($order->salesman_id == Yii::app()->user->id){
						$product = Product::model()->findByPk($m->product_id)->name;
						$return[$order->table->table_name]['product'][] = array($product, $m->qty);
						$return[$order->table->table_name]['order_id'] = $order->id;

						$m->status = 1;
						$m->save();
						$count++;
					}
				}
				echo json_encode(array('count'=>$count, 'data'=>$return));
			}
		}
	}
}