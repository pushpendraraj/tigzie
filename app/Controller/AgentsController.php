<?php 

App::import('Controller',array('Mail'));
App::import('Vendor',array('functions'));
App::uses('String', 'Utility');

class AgentsController extends AppController{
	
	public $components = array('Session','Access','Email');
	public $uses = array('User','Restaurant','Agent','Country','Docs','Menu','MenuCategory','Facility','Tags','PaymentOption','AgentRestaurant','Order','OrderDetail','Customer');	

	public function beforeFilter(){
		parent::beforeFilter();		
	}

	public function index(){
		$this->Access->checkAgentSession();		
	}

	public function admin_index(){
		$this->Access->checkAdminSession();	
		$this->layout='admin';		
		$agents=$this->paginate('Agent',array('User.user_status !='=>'2'));		
		$this->set('agents',$agents);			
	}

	

	public function admin_update_status($id,$val){
		$this->Access->checkAdminSession();	
		$rest=$this->Agent->findById($id);
		if(!empty($rest)){
			$this->User->id=$rest['User']['id'];
			$this->User->save(array('user_status'=>$val));	
			$this->Session->setFlash(__('Agent status updated successfully'));
			try{	
				if(($rest['User']['user_status'])==0){
						$this->Email->to =$rest['User']['email'];;
						$this->Email->subject = 'Account activated';
						$this->Email->from ='noreply@sys.com';
						$this->Email->sendAs = 'both';
						$this->Email->delivery = 'smtp';
						$body='Dear'.' '.$rest['User']['username'].','."<br/>".' '.'your account has been activated.'.'<br/><br/>'.'Thank You';
						$this->Email->send($body);
					}else{
						$this->Email->to =$rest['User']['email'];;
						$this->Email->subject = 'Account deactivated';
						$this->Email->from ='noreply@sys.com';
						$this->Email->sendAs = 'both';
						$this->Email->delivery = 'smtp';
					;		
						$body='Dear'.' '.$rest['User']['username'].','."<br/>".' '.'your account has been deactivated by admin.'.'<br/><br/>'.'Thank You';                      
						$this->Email->send($body);
					}
			}
					catch(Exception $e){
						$this->redirect(array('controller'=>'agents','action'=>'index','admin'=>true));	
					}

		}
		$this->redirect(array('controller'=>'agents','action'=>'index','admin'=>true));			
	}

	public function admin_delete($id=null){
		$this->Access->checkAdminSession();	
		if(!empty($id)){			
			$agent=$this->Agent->findById($id);
			if(!empty($agent)){
				$this->User->id=$agent['User']['id'];
				$this->User->save(array('user_status'=>'2'));
				$this->Session->setFlash(__('Agent deleted successfully'));	
			}	
		}
		$this->redirect(array('controller'=>'agents','action'=>'index','admin'=>true));
	}

	public function admin_linked_restaurants($agent_id){
		$this->Access->checkAdminSession();
		$this->layout='admin';
		if(!empty($agent_id)){	
			$this->AgentRestaurant->recursive=2;		
			$restaurant=$this->AgentRestaurant->find('all',array('conditions'=>array('AgentRestaurant.agent_id'=>$agent_id)));	
			$this->set('restaurant',$restaurant);
		}	
	}

	public function profile(){
		$this->Access->checkAgentSession();	
		if(!empty($this->data)){
			$this->Agent->id=$this->data['Agent']['id'];
			$agt=$this->Agent->save($this->data['Agent']);
			$errMsg='';
			if(!empty($this->data['Docs'])){
				foreach($this->data['Docs'] as $dc){
					if(!empty($dc['docs']['tmp_name']) && $dc['docs']['error']=='0'){
						$arr_img = explode(".", $dc['docs']["name"]);
						$ext = strtolower($arr_img[count($arr_img) - 1]);
						if(in_array($ext,array('jpg','gif','png','jpeg','pdf','doc','docx'))){
							if($dc['docs']['size'] < 1048576){
								$file=$this->upload_doc_file($dc['docs'],$agt['Agent']['id']);
								if($file!=0){
									$this->Docs->create();
									$this->Docs->save(array('ref_id'=>$agt['Agent']['id'],'name'=>$file,'type'=>'4','created'=>date('Y-m-d H:i:s')));	
								}
							}else{
								$errMsg='Some files were not uplaoded due to large file size';	
							}							
						}else{
							$errMsg='Some files were not uplaoded due to invalid file extension';	
						}
					}else{
						$errMsg='Some files were not uplaoded due to invalid file';	
					}	
				}	
			}
			$this->Session->setFlash(__($errMsg));
			$this->redirect(array('controller'=>'agents','action'=>'profile'));	
		}
		$this->layout='agent';
		$agent=$this->Agent->find('first',array('conditions'=>array('Agent.user_id'=>$this->Session->read('User.3.id'))));	
		$this->request->data=$agent;
		$this->set('docs',$this->request->data['Docs']);
	}

	

	

	public function upload_doc_file($arr,$id){

		

		$fileUpload = WWW_ROOT . 'files' . DS .'Agents'. DS .$id;

		if(!is_dir($fileUpload))

			mkdir($fileUpload,0777);		

				

		$fname = removeSpecialChar($arr['name']);

		$file = time() . "_" . $fname;

		if (upload_my_file($arr['tmp_name'], $fileUpload .'/'. $file)) {

			return $file;

		}else{

			return 0;	

		}		

	}

	

	public function delete_doc($id=null){

		

		$this->Access->checkAgentSession();	

		if(!empty($id)){			

			$doc=$this->Docs->findById($id);

			if(!empty($doc)){

				$this->Docs->delete($id);

			}	

		}			

		$this->redirect(array('controller'=>'agents','action'=>'profile'));		

	}

	

	public function restaurantList(){

		

		$this->Access->checkAgentSession();	

		$this->layout='agent';

		$agent=$this->Agent->find('first',array('conditions'=>array('Agent.user_id'=>$this->Session->read('User.3.id'))));

		$linked=$this->AgentRestaurant->find('all',array('conditions'=>array('AgentRestaurant.agent_id'=>$agent['Agent']['id'])));

		

		$linkr=array();

		if(!empty($linked)){

			foreach($linked as $lk){

				$linkr[]=$lk['AgentRestaurant']['restaurant_id'];	

			}

		}

		$restaurants=$this->paginate('Restaurant',array('Restaurant.country_id'=>$agent['Agent']['country_id'],'Restaurant.city_id'=>$agent['Agent']['city_id']));

		

		$this->set('linkr',$linkr);

		$this->set('agent',$agent);

		$this->set('restaurants',$restaurants);

		$this->render('restaurant_list');	

	}

	

	public function pending_approvals(){

		

		$this->Access->checkAgentSession();	

		$this->layout='agent';

		$agent=$this->Agent->find('first',array('conditions'=>array('Agent.user_id'=>$this->Session->read('User.3.id'))));

		$request=$this->AgentRestaurant->find('all',array('conditions'=>array('AgentRestaurant.agent_id'=>$agent['Agent']['id'],'status'=>'0')));	

		

		$this->set('request',$request);

		$this->render('pending_approvals');

	}

	

	public function linked_restaurants(){

		

		$this->Access->checkAgentSession();		

		$this->layout='agent';

		$request=$this->AgentRestaurant->find('all',array('conditions'=>array('AgentRestaurant.agent_id'=>$this->Session->read('User.3.agent_id'),'AgentRestaurant.status'=>'1')));	

		

		$this->set('request',$request);

		$this->render('linked_restaurants');	

	}

	

	public function registration_request($rest_id=null,$agent_id){

		

		$this->Access->checkAgentSession();	

		$this->layout='agent';

		if(!empty($rest_id)){

			

			$restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$rest_id)));

			$this->set('agent_id',$agent_id);

			$this->set('restaurant',$restaurant);

			$this->render('registration_request');

					

		}else{

			$this->redirect(array('controller'=>'dashboard','action'=>'index','agent'=>true));	

		}	

	}	

	

	public function send_registration_request(){

		

		$this->Access->checkAgentSession();	

		if(!empty($this->data)){

			

			$data=$this->data['Request'];

			$already=$this->AgentRestaurant->find('first',array('conditions'=>array('AgentRestaurant.agent_id'=>$data['agent_id'],'AgentRestaurant.restaurant_id'=>$data['restaurant_id'])));

			

			if(empty($already)){

				

				$data['status']='0';

				$data['created']=date("Y-m-d H:i:s");

				$this->AgentRestaurant->create();

				$request=$this->AgentRestaurant->save($data);

				

				

				$agent=$this->Agent->find('first',array('conditions'=>array('Agent.id'=>$request['AgentRestaurant']['agent_id'])));

				$restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$request['AgentRestaurant']['restaurant_id'])));

				

				try{	

						$this->Email->to =$restaurant['User']['email'];

						$this->Email->subject = 'Agent Request for approval';

						$this->Email->from =$agent['User']['email'];

						$this->Email->sendAs = 'both';

						$this->Email->delivery = 'smtp';

						$body='Dear'.' '.$restaurant['User']['username'].','."<br/>".' '.'Agent'.' '.$agent['Agent']['name'].' '.'wants to connect with your restaurant.'.'<br/><br/>'.'Agent information:'.'<br/><br/>'.'Agent Name :'.' '.$agent['Agent']['name'].'<br>'.'Email Id :'.' '.$agent['User']['email'].'<br/>'.'Phone No :'.' '.$agent['Agent']['phone'].'<br/>'.'Commission :'.' '.$request['AgentRestaurant']['commision'].' '.'%'.'<br/>'.'Message from agent :'.' '.$request['AgentRestaurant']['message'].'<br/><br/>'.'Thank You.';                      

						$this->Email->send($body);

						$this->Session->setFlash(__('Thank you for registering. Request has been sent to admin. You\'ll receive a mail regarding account activation soon.'));

					}

					catch(Exception $e){

						$this->redirect(array('controller'=>'agents','action'=>'index','admin'=>true));	

						}

				$this->Session->setFlash(__('Registration request sent successfully'));

				$this->redirect(array('controller'=>'agents','action'=>'restaurantList'));



			}else{

				$this->Session->setFlash(__('A request was already sent for approval.'));

				$this->redirect(array('controller'=>'agents','action'=>'registration_request',$data['restaurant_id'],$data['agent_id']));		

			}				

		}	

	}

		public function create_order(){

		$this->layout='agent';

		 $res=$this->AgentRestaurant->find('all',array('conditions'=>array('AgentRestaurant.agent_id'=>$this->Session->read('User.3.agent_id'))));

		$result=array();

		foreach($res as $r)

		{

			$result[]=$r['AgentRestaurant']['restaurant_id'];

		}

		 $restaurant=$this->Restaurant->find('all',array('conditions'=>array('Restaurant.id'=>$result)));

         $this->set('restaurant',$restaurant);

	    }

	public function get_category($id){

		$this->layout='ajax';

		$this->Session->write('rid',$id);

	   // $category=$this->MenuCategory->find('all',array('conditions'=>array('MenuCategory.restaurant_id'=>$id)));

	    //$this->set('category',$category);

		$categories=$this->MenuCategory->find('all',array('conditions'=>array('MenuCategory.restaurant_id'=>$this->data['restaurant'])));

		$category='<option>Select Category</option>';

		if(!empty($categories)){

			foreach($categories as $ct){

				$category.='<option value="'.$ct['MenuCategory']['id'].'">'.$ct['MenuCategory']['name'].'</option>';	

			}	

		}

		

		echo $category; die;	

	}

	

	public function list_menus(){

		$this->layout='ajax';

		$menu=$this->Menu->find('all',array('conditions'=>array('Menu.menucategory_id'=>$this->request->data['menu'])));

		$this->set('menu',$menu);

			}

	public function add_order($cid,$rid,$mid){

		$this->layout='ajax';

		$menuitem=$this->Menu->find('all',array('conditions'=>array('Menu.restaurant_id'=>$rid,'Menu.menucategory_id'=>$cid,'Menu.id'=>$mid)));

		$this->set('menuitem',$menuitem);

		}

	public function proceed(){

		$this->layout='agent';

		if($this->request->is('post')){

			if(!empty($this->request->data)){ 

				foreach($this->request->data['quantity'] as $itemKey=>$value){

					if(empty($value)){

						$this->Session->setFlash(__('Please add atleast one quantity.'),'default',array('class'=>'error'));

						$this->redirect($this->referer());

					}

					$id[]=$itemKey;

				}

		        $orderitems=$this->request->data;

				$this->set('items',$orderitems);

				$menu=$this->Menu->find('all',array('conditions'=>array('Menu.id'=>$id)));

				$this->set('menu',$menu);

				

			}else{

				$this->Session->setFlash(__('Please add atleast one item'),'default',array('class'=>'error'));

				$this->redirect($this->referer());

			}

			

		}

		

	}

	public function check_out(){

		$this->Access->checkAgentSession();	

	        if($this->request->is('post')){

			$this->request->data['Order']['order_date']=date("Y-m-d H:i:s");

			$this->request->data['Order']['total_cost']=$this->request->data['Order']['total'];

			$this->request->data['Order']['booked_by']="Agent";

			$this->request->data['Order']['order_status']="processing";

			$this->request->data['Order']['agent_id']=$this->Session->read('User.3.agent_id');

			$this->request->data['Order']['restaurant_id']=$this->Session->read('rid');

			$delivery=$this->request->data['Order']['delivery_type'];

		if($delivery==1){

			$this->request->data['Order']['delivery_type']="Home Delivery";

		}

		elseif($delivery==2){

			$this->request->data['Order']['delivery_type']="Dine In";

		}

		else{

			$this->request->data['Order']['delivery_type']="Take Away";

		}

	  $exists=$this->Customer->find('first',array('conditions'=>array('Customer.email_id'=>$this->request->data['Customer']['email_id'])));

		

		

		if ($this->request->is('post') || $this->request->is('put')) {

			if(!empty($exists)){

			$id=$exists['Customer']['customer_id'];

		    if (!$id) {

			throw new NotFoundException(__('Invalid id'));

			}

		    $this->request->data['Customer']['customer_id']=$id;

			}

			 $savedetail=array();

		 foreach($this->request->data['OrderDetail'] as $itemkey=>$value){  

		    $data=array();

			$data['menu_id']=$itemkey;

			$data['quantity']=$value['quantity'];

			$data['price']=$value['price'];

			$data['restaurant_id']=$this->Session->read('rid');

			$savedetail[]=$data;

		  

		}

		$this->request->data['OrderDetail'] =$savedetail;

            $this->Order->saveAll($this->request->data);

		}

			if (!$this->request->data) {

			$this->request->data = $post;

		}

		

			$this->redirect(array('controller'=>'agents','action'=>'list_orders'));

	

		}

		

	    die;

	}

			

	public function list_orders(){

	$this->layout='agent';

	$this->Access->checkAgentSession();	

		$this->Order->recursive = 3;

		$this->paginate=array('limit'=>'10','conditions'=>array('Order.agent_id'=>$this->Session->read('User.3.agent_id')));

	    $order=$this->paginate('Order');	

		$this->set('order',$order);	

	}

	

	public function direct_booking_urls(){

		$this->layout="agent";

		$this->Access->checkAgentSession();	

		$res=$this->AgentRestaurant->find('all',array('conditions'=>array('AgentRestaurant.agent_id'=>$this->Session->read('User.3.agent_id'),'AgentRestaurant.status'=>1)));

		$this->set('res',$res);

		}

		

	public function commision_details()

		{

		$this->layout='agent';

		$this->Access->checkAgentSession();	

		$myagents=$this->Order->find('all',array('conditions'=>array('Order.agent_id'=>$this->Session->read('User.3.agent_id'))));	

		$this->set('myagents',$myagents);

		$result=array();

		foreach($myagents as $key=>$value){

			$data=array();

			$data=$value['Order']['restaurant_id'];

			$result[]=$data;

		}

	    $agcomm=$this->AgentRestaurant->find('first',array('conditions'=>array('AgentRestaurant.agent_id'=>$this->Session->read('User.3.agent_id'),'AgentRestaurant.restaurant_id'=>$result)));

	    $this->set('agcomm',$agcomm);

		//pr($agcomm);die;

		$this->render('commision_details');			

	}



		

		

}