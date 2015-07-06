<?php

App::uses('Component', 'Controller');
class AccessComponent extends Component{
	
	public $components = array('Session');

	function __construct($collection, $settings){
		$this->Controller = $collection->getController();
		$this->City = ClassRegistry::init('City');
	}

	public function checkAdminSession(){
		if(!$this->Controller->Session->check('User.1')){
			$this->Controller->redirect('/superadmin');	
		}	
	}

	public function checkRestaurantSession(){
		if(!$this->Controller->Session->check('User.2')){
			$this->Controller->redirect('/restaurant');	
		}	
	}

	public function checkAgentSession(){
		if(!$this->Controller->Session->check('User.3')){
			$this->Controller->redirect('/agent');	
		}	
	}

	public function insert_cities($city,$country_code){
		$this->City->create();
		$data=$this->City->save(array('country_code'=>$country_code,'city_name'=>$city));
		return $data['City']['id'];
	}
}