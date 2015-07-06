<?php 

App::uses('AppModel','Model');

class OrderDetail extends AppModel{
	
	public $name='OrderDetail';
	public $useTable='order_details';
	public $primaryKey='order_detail_id';
	public $belongsTo = array(
			'Order' => array(
				'className' => 'Order',
				'foreignKey' => 'order_id',
				'dependent' => true				
			),
		 'Menu'=>array(
				'className' => 'Menu',
				'foreignKey' => 'menu_id',
				'dependent' => false				
			));
}

?>