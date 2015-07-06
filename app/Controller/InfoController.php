<?php 
App::import('Controller',array('Mail'));
App::import('Vendor',array('functions'));

class InfoController extends AppController{
	
	public $components = array('Session','Access');
	public $uses = array('User','Restaurant','Deal','Country','City');	
	
	public function beforeFilter(){
		parent::beforeFilter();		
	}


	public function support(){
		$this->layout='frontend_menu';
		
		if($this->request->is('post') && !empty($this->data)){
			$Mail = new MailController;
			$Mail->constructClasses();
			$arr=array();
			$arr['TO_EMAIL']='support@menucomposer.com';
			$arr['TO_NAME']='Admin';
			$arr['NAME']=$this->data['first_name'].' '.$this->data['last_name'];
			$arr['EMAIL']=$this->data['email'];
			$arr['PHONE']=$this->data['phone'];
			$arr['MESSAGE']=$this->data['message'];									
			
			$Mail->individualMail('support_mail',$arr);
			die;
		}
		
		$this->render('support');	
	}	
}