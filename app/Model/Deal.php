<?php 

App::uses('AppModel','Model');

class Deal extends AppModel{
	
	public $name='Deal';
	public $useTable='deals';
	
	public $belongsTo=array('Restaurant'=>array('className'=>'Restaurant','foreignKey'=>'restaurant_id'));
	
}

?>