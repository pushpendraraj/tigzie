<?php 

App::uses('AppModel','Model');

class Restaurant extends AppModel{
	
	public $name = 'Restaurant';
	public $useTable = 'restaurants'; 	
	
	public $belongsTo=array('User'=>array('className'=>'User','foreignKey'=>'user_id'),
							'Country'=>array('className'=>'Country','foreignKey'=>'country_id'),
							'City'=>array('className'=>'City','foreignKey'=>'city_id'));
	
}
