<?php 

App::import('Controller',array('Mail'));
App::import('Vendor',array('functions'));

class LoginController extends AppController{
	public $components = array('Session','Access','Email');
	public $uses = array('User','Restaurant','Agent','Country','City');

	public function beforeFilter(){
		$this->layout='login';
		parent::beforeFilter();	
	}

	public function superadmin_index(){		
		$this->set('user_role_id','1');	
		$this->render('admin_index');	
	}	

	public function restaurantLogin(){
		$this->set('user_role_id','2');	
		$this->render('admin_index');
	}

	public function agentLogin(){
		$this->set('user_role_id','3');	
		$this->render('admin_index');
	}

	public function agentRegistration(){
		if(!empty($this->data)){
			if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
				App::import('Component','Captcha'); //load it
				$this->Captcha = new CaptchaComponent(); //make instance
				$this->Captcha->startup($this); //and do some manually calling
			}
			$cap=$this->Captcha->getVerCode();
			if($cap==$this->data['User']['security_code']){			
				$exist=$this->User->find('first',array('conditions'=>array('User.username'=>$this->data['User']['username'],'User.user_role_id'=>'3')));
				if(empty($exist)){
					$exist=$this->User->find('first',array('conditions'=>array('User.email'=>$this->data['User']['email'])));
					if(empty($exist)){
					    $this->request->data['User']['user_added_date']=date("Y-m-d H:i:s");	
						$this->request->data['User']['user_status']='0';
						$this->request->data['User']['user_role_id']='3';
						$password=$this->data['User']['password'];
						$this->request->data['User']['password']=encrypt($this->data['User']['password'],SALT);
						$this->request->data['User']['user_code']=String::uuid();
						$this->User->create();
						$user=$this->User->save($this->data);					
						$this->request->data['Agent']['user_id']=$user['User']['id'];
						$country=explode("|",$this->data['Agent']['country_id']);
						$this->request->data['Agent']['country_id']=$country[0];
						if($this->data['Agent']['city_id']=='others'){
							$city_id=$this->Access->insert_cities($this->data['Agent']['city_other'],$country[1]);
							$this->request->data['Agent']['city_id']=$city_id;	
						}	
						$this->Agent->create();
						$this->Agent->save($this->data);
						try{									
						$this->Email->to =$user['User']['email'];;
						$this->Email->subject = 'Account activation request';
						$this->Email->from ='noreply@sys.com';
						$this->Email->sendAs = 'both';
						$this->Email->delivery = 'smtp';
						$url='<a href="'.SITE_URL.'/user_activate/'.$user['User']['id'].'/'.$user['User']['user_code'].'" target="_blank">Click here </a>';		
						$body='Dear'.' '.$user['User']['username'].','."<br/>".' '.'your account activaton request has been sent to admin.  You\'ll soon receive a mail regarding account activation.'.'<br/><br/>'.'Login Details:'.'<br/><br/>'.'Username :'.' '.$user['User']['username'].'<br/>'.'password :'.' '.$password;                      
						$this->Email->send($body);
						$this->Session->setFlash(__('Thank you for registering. Request has been sent to admin. You\'ll receive a mail regarding account activation soon.'));
					}
					catch(Exception $e){
						$this->redirect(array('controller'=>'logins','action'=>'agent_register'));	
						}
						$this->redirect(array('controller'=>'login','action'=>'agentRegistration'));						
					}else{
						$this->request->data=$this->data;
						$this->Session->setFlash(__('Email ID already exist. Register with different email id.'));								
					}				
				}else{
					$this->request->data=$this->data;
					$this->Session->setFlash(__('Username already exist. Register with different username.'));						
				}
			}else{
				$this->request->data=$this->data;
				$this->Session->setFlash(__('Invalid security code.'));						
			}
		}

		$country=$this->Country->find('all',array('order'=>array('Country.country_name'=>'ASC')));
		$countries=array(''=>'Select Country');
		foreach($country as $cs){
			$countries[$cs['Country']['id'].'|'.$cs['Country']['country_code']]=$cs['Country']['country_name'];	
		}
		$this->set('countries',$countries);
		$this->render('agent_register');	
	}

	public function verify_login(){
		if($this->request->is('post')){
			$data=$this->data['Login'];			
			$user=$this->User->find('first',array('conditions'=>array('User.username'=>$data['username'],'password'=>encrypt($data['password'],SALT),'user_role_id'=>$data['user_role_id'])));
			if(!empty($user)){
				if($user['User']['user_status']=='1'){
					$this->createSession($user['User']);
					if($user['User']['user_role_id']=='1')
						$redirect=array('controller'=>'dashboard','action'=>'index','admin'=>true);
					else if($user['User']['user_role_id']=='2')
						$redirect=array('controller'=>'dashboard','action'=>'index','restaurant'=>true);
					else if($user['User']['user_role_id']=='3')
						$redirect=array('controller'=>'dashboard','action'=>'index','agent'=>true);		
					$this->redirect($redirect);						
				}else{
					$this->Session->setFlash(__('<strong> Sorry ! </strong> Your account is not active. Contact Administrator.  <button data-dismiss="alert" class="close" type="button">×</button>', true), 'default', array('class' => 'alert alert-danger'));  
				}	
			}else{
				$this->Session->setFlash(__('<strong> Sorry ! </strong> Invalid Username or Password.  <button data-dismiss="alert" class="close" type="button">×</button>', true), 'default', array('class' => 'alert alert-danger'));  
			}	
		}		
		if($data['user_role_id']=='1')
			$act='/superadmin';
		else if($data['user_role_id']=='2')
			$act='/restaurant';
		else if($data['user_role_id']=='3')
			$act='/agent';		
		$this->redirect($act);	
	}
	public function createSession($user){
		switch($user['user_role_id']){
			case '1': $this->Session->write('User.1',$user);

						
					  break;	
			case '2': $this->Session->write('User.2',$user);
					  $restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.user_id'=>$user['id'])));	
					  $this->Session->write('User.2.restaurant_id',$restaurant['Restaurant']['id']);
					  break;
			case '3': $this->Session->write('User.3',$user);
					  $agent=$this->Agent->find('first',array('conditions'=>array('Agent.user_id'=>$user['id'])));	
					  $this->Session->write('User.3.agent_id',$agent['Agent']['id']);
					  break;		  
		}	
		return; 
	}
	
	public function activate_account($id=null,$code=null){
		if(!empty($code) && !empty($id)){
			$user=$this->User->find('first',array('conditions'=>array('User.id'=>$id)));
			if(!empty($user)){
				if($user['User']['user_code']==$code){
					if($user['User']['user_status']=='0'){
						$Mail = new MailController;
        				$Mail->constructClasses();
						$this->User->id=$id;
						$this->User->save(array('user_status'=>'1'));
						$arr=array();
						$arr['TO_EMAIL']=$user['User']['email'];
						$arr['TO_NAME']=$user['User']['username'];
						$arr['USERNAME']=$user['User']['username'];
						$arr['PASSWORD']=decrypt($user['User']['password'],SALT);									
						if($user['User']['user_role_id']=='2'){
							$template='restaurant_activated';
							$redirect='/restaurant';
						}else if($user['User']['user_role_id']=='3'){
							$template='agent_activated';
							$redirect='/agent';
						}
						$Mail->sendMail($user['User']['id'],$template,$arr);
						$this->Session->setFlash(__('Account have been activated. Please login.'));
						$this->redirect($redirect);
					}else{
						$this->Session->setFlash(__('Account already activated'));
					}					
				}else{
					$this->Session->setFlash(__('Invalid Request'));
				}					
			}else{
				$this->Session->setFlash(__('Invalid User'));	
			}	
		}else{
			$this->Session->setFlash(__('Invalid Request'));	
		}		
		$this->redirect('/restaurant');
	}

	 public function captcha()	{
		$this->autoRender = false;
		$this->layout='ajax';
		if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
			App::import('Component','Captcha'); //load it
			$this->Captcha = new CaptchaComponent(); //make instance
			$this->Captcha->startup($this); //and do some manually calling
		}
		$width = isset($_GET['width']) ? $_GET['width'] : '140';
		$height = isset($_GET['height']) ? $_GET['height'] : '60';
		$characters = isset($_GET['characters']) && $_GET['characters'] > 1 ? $_GET['characters'] : '6';
		$this->Captcha->create($width, $height, $characters); //options, default are 120, 40, 6.
	}

	public function reload_captcha(){
	    App::import('Component','Captcha'); //load it
	    $this->Captcha = new CaptchaComponent(); //make instance
	    $this->Captcha->startup($this); //and do some manually calling
	    $this->layout='ajax';
	    Configure::write('debug',2);
	   $this->render('reload_captcha');
	}

	public function forget_pass(){
		if(!empty($this->data)){
			$data=$this->data['ForgetPassForm'];
			if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
				App::import('Component','Captcha'); //load it
				$this->Captcha = new CaptchaComponent(); //make instance
				$this->Captcha->startup($this); //and do some manually calling
			}
			$cap=$this->Captcha->getVerCode();
			if($cap==$data['code']){
				$user=$this->User->find('first',array('conditions'=>array('User.username'=>$data['username'],'User.user_role_id'=>$data['user_role_id'])));
				if(!empty($user)){
					$Mail = new MailController;
        			$Mail->constructClasses();
					$pass=random_password();
					$this->User->id=$user['User']['id'];
					$this->User->save(array('password'=>encrypt($pass,SALT)));
					$arr=array();
					$arr['TO_EMAIL']=$user['User']['email'];
					$arr['TO_NAME']=$user['User']['username'];
					$arr['USERNAME']=$user['User']['username'];
					$arr['PASSWORD']=$pass;									
					$Mail->sendMail($user['User']['id'],'forgot_password',$arr);
					echo 'success'; die;
				}else{
					echo 'error'; 	
				}
			}else{
				echo 'code'; die;	
			}
		}
		die;	
	}	

}





