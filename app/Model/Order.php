<?php 

App::uses('AppModel','Model');

class Order extends AppModel{
	
	public $name='Order';
	public $useTable='orders';
	public $primaryKey='order_id';
	public $hasMany=array(
			'OrderDetail' => array(
				'className' => 'OrderDetail',
				'foreignKey' => 'order_id',
				'dependent' => true));
				
    public $belongsTo = array(
			'Customer' => array(
				'className' => 'Customer',
				'foreignKey' => 'customer_id',
				'dependent' => true				
			),
			'Restaurant' => array(
				'className' => 'Restaurant',
				'foreignKey' => 'restaurant_id',
				'dependent' => false
				));
	
}

?>