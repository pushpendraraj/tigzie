<?php 



class DashboardController extends AppController{

	

	public $name = 'Dashboard';

	public $components = array('Session');

	public $uses = array('User','Restaurant','Agent');

	

	public function beforeFilter(){

		parent::beforeFilter();	

		$this->layout='dashboard';

	}	



	public function admin_index(){

		

		$this->layout='admin';		

		$restaurant_count=$this->User->find('count',array('conditions'=>array('User.user_role_id'=>'2','User.user_status'=>'1')));

		$agent_count=$this->User->find('count',array('conditions'=>array('User.user_role_id'=>'3','User.user_status'=>'1')));

		$this->set('agent_count',$agent_count);

		$this->set('restaurant_count',$restaurant_count);				

	}

	

	public function restaurant_index(){
		$this->layout='restaurant';		
		$restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.user_id'=>$this->Session->read('User.2.id'))));			
	}

	

	public function agent_index(){

		$this->layout='agent';		

		$agent=$this->Agent->find('first',array('conditions'=>array('Agent.user_id'=>$this->Session->read('User.3.id'))));			

	}

	

}