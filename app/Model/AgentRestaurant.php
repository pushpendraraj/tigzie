<?php 

App::uses('AppModel','Model');

class AgentRestaurant extends AppModel{
	
	public $name='AgentRestaurant';
	public $useTable='agent_restaurants';
    public $belongsTo=array(
				'Restaurant'=>array(
				'className'=>'Restaurant',
				'foreignKey'=>'restaurant_id'
				),
			'Agent'=>array(
				'className'=>'Agent',
				'foreignKey'=>'agent_id'
		));
		
	
}


