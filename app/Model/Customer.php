<?php 

App::uses('AppModel','Model');

class Customer extends AppModel{
	
	public $name='Customer';
	public $useTable='customers';
	public $primaryKey='customer_id';
	public $validate = array(
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter customer name'
		),	'email_id' =>array(
			array('rule' => 'notEmpty',
				'message' => 'Please enter the email'
			),
			array('rule' => 'email',
				'message' => 'Invalid email')));
	
}

?>