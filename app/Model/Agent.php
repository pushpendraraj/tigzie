<?php 

App::uses('AppModel','Model');

class Agent extends AppModel{
	
	public $name='Agent';
	public $useTable='agents';
	
	public $belongsTo=array('User'=>array('className'=>'User','foreignKey'=>'user_id'),
							'Country'=>array('className'=>'Country','foreignKey'=>'country_id'),
							'City'=>array('className'=>'City','foreignKey'=>'city_id'));
							
	public $hasMany=array('Docs'=>array('className'=>'Docs','foreignKey'=>'ref_id','conditions'=>array('Docs.type'=>'4')));	
	
			
}










