<?php 
App::import('Controller',array('Mail'));
App::import('Vendor',array('functions'));

class RestaurantsController extends AppController{
	
	public $components = array('Session','Access','Cookie','Email');
	public $helpers = array('Html','Form','Js');
	public $uses = array('User','Restaurant','Country','City','Docs','Menu','MenuCategory','Facility','Tags','PaymentOption','AgentRestaurant','Deal','Order','OrderDetail','Customer');
	public $paginate = array('limit' =>10);	

	
	public function beforeFilter(){
		parent::beforeFilter();		
	}	
	
	public function index(){
	
		$this->layout='frontend_menu';	
		$this->paginate=array('limit'=>'9','conditions'=>array('User.user_status'=>'1','Restaurant.logo !='=>'','Restaurant.most_loved'=>'Yes'),'order'=>array('Restaurant.id Desc'),'fields'=>array('Restaurant.restaurant_name','Restaurant.logo','Restaurant.id'));
		$restaurants=$this->paginate('Restaurant');	
			
		$this->set('restaurants',$restaurants);	
	}
	
	public function paging_index($type=1){
		$this->layout='ajax';
		if($type==1){
			$conditions['Restaurant.most_loved']='Yes';	
		}else if($type==2){
			$conditions['Restaurant.best_seller']='Yes';		
		}else if($type==3){
			$conditions['Restaurant.popular_this_week']='Yes';
		}
		$this->paginate=array('limit'=>'9','conditions'=>array('User.user_status'=>'1','Restaurant.logo !='=>'',$conditions),'order'=>array('Restaurant.id Desc'),'fields'=>array('Restaurant.restaurant_name','Restaurant.logo','Restaurant.id'));
		$restaurants=$this->paginate('Restaurant');	
		$this->set('restaurants',$restaurants);	
		$this->render('paging_index');	
	}
	
	public function admin_index(){
		
		$this->Access->checkAdminSession();	
		$this->layout='admin';
		$this->Restaurant->recursive = 3;
		$this->paginate=array('limit'=>'10','conditions'=>array('User.user_status !='=>'2'),'order' => array('User.user_added_date' => 'DESC'));	
		$restaurants=$this->paginate('Restaurant');		
		$this->set('restaurants',$restaurants);	
	}	
	
	public function admin_add(){
		
		$this->Access->checkAdminSession();	
		$this->layout='admin';
		if($this->request->is('post')){
			
			if(!empty($this->data)){				
							
				$exist=$this->User->find('first',array('conditions'=>array('User.username'=>$this->data['User']['username'],'User.user_role_id'=>'2')));
				if(empty($exist)){
					$exist=$this->User->find('first',array('conditions'=>array('User.email'=>$this->data['User']['email'])));
					if(empty($exist)){
					$this->Restaurant->unbindModel(array('belongsTo'=>array('User')));
					
					$this->request->data['User']['user_added_date']=date("Y-m-d H:i:s");	
					$this->request->data['User']['user_status']='0';
					$this->request->data['User']['user_role_id']='2';
					$password=$this->data['User']['password'];
					$this->request->data['User']['password']=encrypt($this->data['User']['password'],SALT);
					$this->request->data['User']['user_code']=String::uuid();
					
					$this->User->create();
					$user=$this->User->save($this->data);				
					$this->request->data['Restaurant']['user_id']=$user['User']['id'];
					$this->request->data['Restaurant']['created']=date("Y-m-d H:i:s");	
					
					$country=explode("|",$this->data['Restaurant']['country_id']);
					$this->request->data['Restaurant']['country_id']=$country[0];
					
					if($this->data['Restaurant']['city_id']=='others'){
						$city_id=$this->Access->insert_cities($this->data['Restaurant']['city_other'],$country[1]);
						$this->request->data['Restaurant']['city_id']=$city_id;	
					}
					
					if(!empty($this->request->data['Restaurant']['type'])){
						$this->request->data['Restaurant']['type']=implode(',', $this->request->data['Restaurant']['type']);
					}
					
					$this->Restaurant->create();
					$this->Restaurant->save($this->data);
					try{									
						$this->Email->to =$user['User']['email'];;
						$this->Email->subject = 'Account details';
						$this->Email->from ='admin@admin.com';
						$this->Email->sendAs = 'both';
						$this->Email->delivery = 'smtp';
						$url='<a href="'.SITE_URL.'/user_activate/'.$user['User']['id'].'/'.$user['User']['user_code'].'" target="_blank">Click here </a>';		
						$body='Dear'.' '.'client,'."<br/>".' '.'your account for restaurant'.' '.$user['Restaurant']['restaurant_name']. ' '.'has been activated .'.'<br/>'.'User name :'.' '.$user['User']['username'].'<br/>'.'password :'.' '.$password.'<br/><br>please'.' '.$url.' '.'to login';
						
						$this->Email->send($body);
						$this->Session->setFlash(__('Restaurant added successfully'));
						$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
					}
					catch(Exception $e){
						$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));	
					
					}

					}else{
						$this->Session->setFlash(__('Email-id already exists.'));
						 //$this->redirect(array('controller'=>'restaurants','action'=>'add','admin'=>true));
					}
				}else{
					$this->Session->setFlash(__('Username already exists.'));
					//$this->redirect(array('controller'=>'restaurants','action'=>'add','admin'=>true));	
				}				
			}	
		}		
		$country=$this->Country->find('all',array('order'=>array('Country.country_name'=>'ASC')));
		$countries=array(''=>'Select Country');
		
		foreach($country as $cs){
			$countries[$cs['Country']['id'].'|'.$cs['Country']['country_code']]=$cs['Country']['country_name'];	
		}
		$this->set('countries',$countries);
			
	}
	
	
	
	public function admin_edit($id=null){
		
		$this->Access->checkAdminSession();	
		$this->layout='admin';
					
		if(!empty($this->data)){
			
			$this->Restaurant->id=$this->data['Restaurant']['id'];
			if(!empty($this->request->data['Restaurant']['type'])){
				$this->request->data['Restaurant']['type']=implode(',', $this->request->data['Restaurant']['type']);
			}
			if($this->Restaurant->save($this->data)){				
				$this->User->id=$this->data['Restaurant']['user_id'];
				$this->User->save($this->data);
			}
			$this->Session->setFlash(__('Restaurant details updated successfully'));
			$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true)); 
							
		}else{
		
			$this->request->data=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$id)));
			$country=$this->Country->find('all',array('order'=>array('Country.country_name'=>'ASC')));
			$countries=array(''=>'Select Country');
			foreach($country as $cs){
				$countries[$cs['Country']['id'].'|'.$cs['Country']['country_code']]=$cs['Country']['country_name'];	
				
				if($cs['Country']['id']==$this->request->data['Restaurant']['country_id']){
					$this->request->data['Restaurant']['country_id']=$cs['Country']['id'].'|'.$cs['Country']['country_code'];		
				}
			}
			
			$allcity=$this->City->find('all',array('conditions'=>array('City.country_code'=>$this->request->data['City']['country_code'])));
			$cities=array();
			if(!empty($allcity)){
				foreach($allcity as $ct){
					$cities[$ct['City']['id']]=$ct['City']['city_name'];	
				}
			}			
			$this->set('cities',$cities);
			$this->set('countries',$countries);
		}		
	}
	
	public function admin_delete($id=null){
		
		$this->Access->checkAdminSession();	
		if(!empty($id)){
			
			$restaurant=$this->Restaurant->findById($id);
			if(!empty($restaurant)){
								
				$this->User->id=$restaurant['User']['id'];
				$this->User->save(array('user_status'=>'2'));
				$this->Session->setFlash(__('Restaurant deleted successfully'));	
			}	
		}
		$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
	}
		
	public function admin_update_status($id,$val){
		
		$this->Access->checkAdminSession();	
		$rest=$this->Restaurant->findById($id);
		if(!empty($rest)){
			$this->User->id=$rest['User']['id'];
			$this->User->save(array('user_status'=>$val));	
			$this->Session->setFlash(__('Restaurant status updated successfully'));
			try{	
				if(($rest['User']['user_status'])==0){
						$this->Email->to =$rest['User']['email'];;
						$this->Email->subject = 'Account activated';
						$this->Email->from ='noreply@sys.com';
						$this->Email->sendAs = 'both';
						$this->Email->delivery = 'smtp';
						$body='Dear'.' '.$rest['User']['username'].','."<br/>".' '.'your account has been activated.'.'<br/><br/>'.'Thank You';                        $this->Email->send($body);
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
						$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
						}
		}
		$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));			
	}
	
	public function profile_edit(){
		
		$this->Access->checkRestaurantSession();	
		if(!empty($this->data)){
			
			$payment_opt='';
			if(!empty($this->data['PaymentOption'])){
				foreach($this->data['PaymentOption'] as $ind=>$dpo){
					$payment_opt.=$ind.'|';	
				}	
			}
			$facilities_opt='';
			if(!empty($this->data['Facility'])){
				foreach($this->data['Facility'] as $ind_fc=>$dfc){
					$facilities_opt.=$ind_fc.'|';	
				}	
			}
			
			$tags_opt='';
			if(!empty($this->data['Tags'])){
				foreach($this->data['Tags'] as $ind_tg=>$dtg){
					$tags_opt.=$ind_tg.'|';	
				}	
			}
			
			$this->request->data['Restaurant']['payment_options']=$payment_opt;
			$this->request->data['Restaurant']['facilities']=$facilities_opt;
			$this->request->data['Restaurant']['tags']=$tags_opt;
			
			$country=explode("|",$this->data['Restaurant']['country_id']);
			$this->request->data['Restaurant']['country_id']=$country[0];
			
			if($this->data['Restaurant']['city_id']=='others'){
				$city_id=$this->Access->insert_cities($this->data['Restaurant']['city_other'],$country[1]);
				$this->request->data['Restaurant']['city_id']=$city_id;	
			}
			
			if(!empty($this->request->data['Restaurant']['type'])){
				$this->request->data['Restaurant']['type']=implode(',', $this->request->data['Restaurant']['type']);
			}
			
			$errMsg='';
			if(!empty($this->data['Restaurant']['logo']) && $this->data['Restaurant']['logo']['size']>0){			
					
					if(!empty($this->data['Restaurant']['logo']['tmp_name']) && $this->data['Restaurant']['logo']['error']=='0'){
						
						$arr_img = explode(".", $this->data['Restaurant']['logo']["name"]);
						$ext = strtolower($arr_img[count($arr_img) - 1]);
						
						if(in_array($ext,array('jpg','gif','png','jpeg'))){
							
							if($this->data['Restaurant']['logo']['size'] < 1048576){
								$file=$this->upload_img_file($this->data['Restaurant']['logo'],$this->data['Restaurant']['id']);
								
								if($file!=0){
									$this->request->data['Restaurant']['logo']=$file;
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
			}else{
				unset($this->request->data['Restaurant']['logo']);
					
			}
			
			if(!empty($this->data['Restaurant']['block_1_image']) && $this->data['Restaurant']['block_1_image']['size']>0){			
					
					if(!empty($this->data['Restaurant']['block_1_image']['tmp_name']) && $this->data['Restaurant']['block_1_image']['error']=='0'){
						
						$arr_img = explode(".", $this->data['Restaurant']['block_1_image']["name"]);
						$ext = strtolower($arr_img[count($arr_img) - 1]);
						
						if(in_array($ext,array('jpg','gif','png','jpeg'))){
							
							if($this->data['Restaurant']['block_1_image']['size'] < 1048576){
								$file=$this->upload_img_file($this->data['Restaurant']['block_1_image'],$this->data['Restaurant']['id']);
								
								if($file!=0){
									$this->request->data['Restaurant']['block_1_image']=$file;
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
			}else{
				unset($this->request->data['Restaurant']['block_1_image']);	
			}
			
			if(!empty($this->data['Restaurant']['block_2_image']) && $this->data['Restaurant']['block_2_image']['size']>0){			
					
					if(!empty($this->data['Restaurant']['block_2_image']['tmp_name']) && $this->data['Restaurant']['block_2_image']['error']=='0'){
						
						$arr_img = explode(".", $this->data['Restaurant']['block_2_image']["name"]);
						$ext = strtolower($arr_img[count($arr_img) - 1]);
						
						if(in_array($ext,array('jpg','gif','png','jpeg'))){
							
							if($this->data['Restaurant']['block_2_image']['size'] < 1048576){
								$file=$this->upload_img_file($this->data['Restaurant']['block_2_image'],$this->data['Restaurant']['id']);
								
								if($file!=0){
									$this->request->data['Restaurant']['block_2_image']=$file;
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
			}else{
				unset($this->request->data['Restaurant']['block_2_image']);	
			}
			
			if(!empty($this->data['Restaurant']['block_3_image']) && $this->data['Restaurant']['block_3_image']['size']>0){			
					
					if(!empty($this->data['Restaurant']['block_3_image']['tmp_name']) && $this->data['Restaurant']['block_3_image']['error']=='0'){
						
						$arr_img = explode(".", $this->data['Restaurant']['block_3_image']["name"]);
						$ext = strtolower($arr_img[count($arr_img) - 1]);
						
						if(in_array($ext,array('jpg','gif','png','jpeg'))){
							
							if($this->data['Restaurant']['block_3_image']['size'] < 1048576){
								$file=$this->upload_img_file($this->data['Restaurant']['block_3_image'],$this->data['Restaurant']['id']);
								
								if($file!=0){
									$this->request->data['Restaurant']['block_3_image']=$file;
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
			}else{
				unset($this->request->data['Restaurant']['block_3_image']);	
			}
			
			$this->Restaurant->id=$this->data['Restaurant']['id'];
			$this->Restaurant->save($this->data);
			$this->Session->setFlash(__($errMsg. 'Restaurant profile updated successfully'));			
		}
		
		$this->layout='restaurant';
		$data=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.user_id'=>$this->Session->read('User.2.id'))));		
		
		if(!empty($data['Restaurant']['payment_options'])){
			$all_po=explode('|',$data['Restaurant']['payment_options']);
			foreach($all_po as $apo){
				if(!empty($apo)){
					$data['PaymentOption'][$apo]=1;	
				}	
			}	
		}
		
		if(!empty($data['Restaurant']['facilities'])){
			$all_fc=explode('|',$data['Restaurant']['facilities']);
			foreach($all_fc as $afc){
				if(!empty($afc)){
					$data['Facility'][$afc]=1;	
				}	
			}	
		}
		
		if(!empty($data['Restaurant']['tags'])){
			$all_tg=explode('|',$data['Restaurant']['tags']);
			foreach($all_tg as $atg){
				if(!empty($atg)){
					$data['Tags'][$atg]=1;	
				}	
			}	
		}
		
		$this->request->data=$data;
		
		$country=$this->Country->find('all',array('order'=>array('Country.country_name'=>'ASC')));
		$payment_options=$this->PaymentOption->find('all');
		$tags=$this->Tags->find('all');
		$facilities=$this->Facility->find('all');
		
		$countries=array(''=>'Select Country');
		foreach($country as $cs){
			$countries[$cs['Country']['id'].'|'.$cs['Country']['country_code']]=$cs['Country']['country_name'];	
			
			if($cs['Country']['id']==$this->request->data['Restaurant']['country_id']){
				$this->request->data['Restaurant']['country_id']=$cs['Country']['id'].'|'.$cs['Country']['country_code'];		
			}
		}
		
		$allcity=$this->City->find('all',array('conditions'=>array('City.country_code'=>$this->request->data['City']['country_code'])));
		$cities=array();
		if(!empty($allcity)){
			foreach($allcity as $ct){
				$cities[$ct['City']['id']]=$ct['City']['city_name'];	
			}
		}
		$this->set('cities',$cities);
		
		$this->set('countries',$countries);
		$this->set('payment_options',$payment_options);
		$this->set('tags',$tags);
		$this->set('facilities',$facilities);
					
	}
	
	public function upload_menu(){
		
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		if(!empty($this->data)){
			
			if(!empty($this->data['Docs'])){
				
				foreach($this->data['Docs'] as $dc){
					
					if(!empty($dc['menu']['tmp_name']) && $dc['menu']['error']=='0'){
						
						$arr_img = explode(".", $dc['menu']["name"]);
						$ext = strtolower($arr_img[count($arr_img) - 1]);
						
						if(in_array($ext,array('jpg','gif','png','jpeg'))){
							
							if($dc['menu']['size'] < 1048576){
								$file=$this->upload_img_file($dc['menu'],$this->data['Restaurant']['id']);
								
								if($file!=0){
									$this->Docs->create();
									$this->Docs->save(array('ref_id'=>$this->data['Restaurant']['id'],'name'=>$file,'type'=>'1','created'=>date('Y-m-d H:i:s')));	
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
			$this->redirect(array('controller'=>'restaurants','action'=>'menu_images'));	
		}		
		$this->set('restaurant_id',$this->Session->read('User.2.restaurant_id'));		
	}
	
	
	public function menu_images(){
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		$menu=$this->paginate('Docs',array('Docs.ref_id'=>$this->Session->read('User.2.restaurant_id'),'Docs.type'=>'1'));
		$this->set('restaurant_id',$this->Session->read('User.2.restaurant_id'));	
		$this->set('menu',$menu);
	}
	
	
	public function upload_img_file($arr,$id){
		
		$fileUpload = WWW_ROOT . 'files' . DS .$id;
		if(!is_dir($fileUpload))
			mkdir($fileUpload,0777);
			
		if(!is_dir($fileUpload.'/thumb'))
			mkdir($fileUpload.'/thumb',0777);
			
		if(!is_dir($fileUpload.'/minithumb'))
			mkdir($fileUpload.'/minithumb',0777);			
			
		$fname = removeSpecialChar($arr['name']);
		$file = time() . "_" . $fname;
		if (upload_my_file($arr['tmp_name'], $fileUpload .'/'. $file)) {
			$save_path="thumb_".$file;
			$min_save_path="mini_thumb_".$file;
			create_thumb($fileUpload .'/'. $file, 150, $fileUpload.'/thumb/'.$save_path);
			create_thumb($fileUpload .'/'. $file, 42, $fileUpload.'/minithumb/'.$min_save_path);
			return $file;
		}else{
			return 0;	
		}		
	}
	
	public function delete_menu_image($id=null,$type){
		
		$this->Access->checkRestaurantSession();
		if(!empty($id)){
			
			$docs=$this->Docs->findById($id);
			if(!empty($docs)){

				$this->Docs->delete($docs['Docs']['id']);
				$this->Session->setFlash(__('Image deleted successfully'));	
			}	
		}
		if($type==1)
			$act='menu_images';
		else 
			$act='restaurantImages';	
		$this->redirect(array('controller'=>'restaurants','action'=>$act));
	}
	
	public function restaurantImages(){
		
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		$images=$this->paginate('Docs',array('Docs.ref_id'=>$this->Session->read('User.2.restaurant_id'),'Docs.type'=>'2'));
		$this->set('restaurant_id',$this->Session->read('User.2.restaurant_id'));	
		$this->set('images',$images);		
	}
	
	public function upload_restaurantImages(){
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		if(!empty($this->data)){
			
			if(!empty($this->data['Docs'])){
				
				foreach($this->data['Docs'] as $dc){
					
					if(!empty($dc['menu']['tmp_name']) && $dc['menu']['error']=='0'){
						
						$arr_img = explode(".", $dc['menu']["name"]);
						$ext = strtolower($arr_img[count($arr_img) - 1]);
						
						if(in_array($ext,array('jpg','gif','png','jpeg'))){
							
							if($dc['menu']['size'] < 1048576){
								$file=$this->upload_img_file($dc['menu'],$this->data['Restaurant']['id']);
								
								if($file!=0){
									$this->Docs->create();
									$this->Docs->save(array('ref_id'=>$this->data['Restaurant']['id'],'name'=>$file,'type'=>'2','created'=>date('Y-m-d H:i:s')));	
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
			$this->redirect(array('controller'=>'restaurants','action'=>'restaurantImages'));	
		}	
		$this->set('restaurant_id',$this->Session->read('User.2.restaurant_id'));		
	}
	
	
	public function list_menu(){
		
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		$menu=$this->paginate('Menu',array('Menu.restaurant_id'=>$this->Session->read('User.2.restaurant_id')));
		$this->set('restaurant_id',$this->Session->read('User.2.restaurant_id'));	
		$this->set('menu',$menu);
	}
	public function list_category(){
		
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		$this->paginate=array('limit'=>'10','conditions'=>array('MenuCategory.restaurant_id'=>$this->Session->read('User.2.restaurant_id')));
		$category=$this->paginate('MenuCategory');
		$this->set('restaurant_id',$this->Session->read('User.2.restaurant_id'));	
		$this->set('category',$category);
	}
	
	public function add_menu(){
		
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		
		if(!empty($this->data)){
			
			if(empty($this->data['Menu']['id'])){
				$this->Menu->create();
			}else{
				$this->Menu->id=$this->data['Menu']['id'];	
			}
			$menu=$this->Menu->save($this->data['Menu']);
			
			if(!empty($this->data['Docs'])){
				foreach($this->data['Docs'] as $dc){
					
					if(!empty($dc['menu']['tmp_name']) && $dc['menu']['error']=='0'){
						
						$arr_img = explode(".", $dc['menu']["name"]);
						$ext = strtolower($arr_img[count($arr_img) - 1]);
						
						if(in_array($ext,array('jpg','gif','png','jpeg'))){
							
							if($dc['menu']['size'] < 1048576){
								$file=$this->upload_img_file($dc['menu'],$menu['Menu']['restaurant_id']);
								
								if($file!=0){
									$this->Docs->create();
									$this->Docs->save(array('ref_id'=>$menu['Menu']['restaurant_id'],'rel_id'=>$menu['Menu']['id'],'name'=>$file,'type'=>'3','created'=>date('Y-m-d H:i:s')));	
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
			$this->redirect(array('controller'=>'restaurants','action'=>'list_menu'));	
		}
		
		$restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$this->Session->read('User.2.restaurant_id'))));	
		
		$categories=array();
		$mcat=$this->MenuCategory->find('all',array('conditions'=>array('restaurant_id'=>$this->Session->read('User.2.restaurant_id'))));
		foreach($mcat as $mc){
			$categories[$mc['MenuCategory']['id']]=$mc['MenuCategory']['name'];	
		}
		
		$this->set('categories',$categories);
		$this->set('restaurant',$restaurant);		
	}
	
	public function add_category(){
		
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		$restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$this->Session->read('User.2.restaurant_id'))));
			$this->set('restaurant',$restaurant);	
	       if(!empty($this->data)){
			if(empty($this->data['MenuCategory']['id'])){
				$this->MenuCategory->create();
			}else{
				$this->MenuCategory->id=$this->data['MenuCategory']['id'];	
				}
				if($this->MenuCategory->save($this->data))
			{
				$this->redirect(array('controller'=>'restaurants','action'=>'list_category'));	
			}
		   }
		   }
	
		public function delete_menu_item($id=null){
		$this->Access->checkRestaurantSession();
		if(!empty($id)){
			
			$menu=$this->Menu->findById($id);
			if(!empty($menu)){

				$this->Menu->delete($menu['Menu']['id']);
				$this->Docs->deleteAll(array('Docs.rel_id'=>$menu['Menu']['id'],'Docs.type'=>'3'));
			}	
		}			
		$this->redirect(array('controller'=>'restaurants','action'=>'list_menu'));
	}
	
	public function delete_menu_item_image($id,$menu_id){
		
		$this->Access->checkRestaurantSession();
		if(!empty($id)){						
			$this->Docs->delete($id);
			$this->Session->setFlash(__('deleted'));				
		}			
		$this->redirect(array('controller'=>'restaurants','action'=>'edit_menu',$menu_id));	
	}
	
	public function edit_menu($id){
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		$this->request->data=$this->Menu->find('first',array('conditions'=>array('Menu.id'=>$id)));
		$restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$this->Session->read('User.2.restaurant_id'))));	
		
		$categories=array();
		$mcat=$this->MenuCategory->find('all',array('conditions'=>array('MenuCategory.restaurant_id'=>$this->Session->read('User.2.restaurant_id'))));
		foreach($mcat as $mc){
			$categories[$mc['MenuCategory']['id']]=$mc['MenuCategory']['name'];	
		}		
		
		$this->set('menu',$this->request->data['Docs']);
		$this->set('categories',$categories);
		$this->set('restaurant',$restaurant);
	}
	
	
		public function edit_category($id){
			$this->Access->checkRestaurantSession();
			$this->layout='restaurant';
			if (!$id) {
			throw new NotFoundException(__('Invalid post'));
			}
			$post = $this->MenuCategory->findById($id);
			if (!$post) {
			throw new NotFoundException(__('Invalid post'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['MenuCategory']['restaurant_id']=$this->Session->read('User.2.restaurant_id');
			if ($this->MenuCategory->save($this->request->data)) {
			$this->redirect(array('controller'=>'restaurants','action'=>'list_category'));
			$this->redirect(array(’action’ => 'list_category'));
			} else {
			$this->Session->setFlash('category not updated. please try again');
			}
			}
			if (!$this->request->data) {
			$this->request->data = $post;
			}
	  
		}
		
		public function delete_category_item($id){
		
		$this->Access->checkRestaurantSession();
		if(!empty($id)){						
			$this->MenuCategory->delete($id);				
		}			
		$this->redirect(array('controller'=>'restaurants','action'=>'list_category'));
	}
	
	
	public function my_agents(){

		$this->Access->checkRestaurantSession();		
		$this->layout='restaurant';
		$myagents=$this->AgentRestaurant->find('all',array('conditions'=>array('AgentRestaurant.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),'AgentRestaurant.status'=>'1')));
		$this->set('myagents',$myagents);
		$this->render('my_agents');
			
	}
	
	public function agentRequests(){
		
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';		
		$requests=$this->AgentRestaurant->find('all',array('conditions'=>array('AgentRestaurant.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),'AgentRestaurant.status'=>'0')));
		$this->set('requests',$requests);
		$this->render('agent_requests');	
	}
	
	public function approve_agent_request($id=null){
		
		$this->Access->checkRestaurantSession();
		if(!empty($id)){
			
			$Mail = new MailController;
        	$Mail->constructClasses();
			
			$this->AgentRestaurant->id=$id;
			$this->AgentRestaurant->save(array('status'=>'1','approval_date'=>date("Y-m-d H:i:s")));
			
			$this->AgentRestaurant->recursive=2;
			$data=$this->AgentRestaurant->find('first',array('conditions'=>array('AgentRestaurant.id'=>$id)));
			
			$arr=array();
			$arr['TO_EMAIL']=$data['Agent']['User']['email'];
			$arr['TO_NAME']=$data['Agent']['name'];
			$arr['RESTAURANT_NAME']=$data['Restaurant']['restaurant_name'];
			$arr['CONTACT']=$data['Restaurant']['phone'];		
				
			$Mail->sendMail($data['Agent']['User']['id'],'approve_agent_request',$arr);
			
			$this->Session->setFlash(__('Agent request has been approved.'));
			$this->redirect(array('controller'=>'restaurants','action'=>'my_agents'));				
		}
	}
	
	public function deny_agent($id=null){
		
		$this->Access->checkRestaurantSession();
		if(!empty($id)){
			
			$Mail = new MailController;
        	$Mail->constructClasses();
			
			$this->AgentRestaurant->id=$id;
			$this->AgentRestaurant->save(array('status'=>'2'));
			
			$this->AgentRestaurant->recursive=2;
			$data=$this->AgentRestaurant->find('first',array('conditions'=>array('AgentRestaurant.id'=>$id)));
			
			$arr=array();
			$arr['TO_EMAIL']=$data['Agent']['User']['email'];
			$arr['TO_NAME']=$data['Agent']['name'];
			$arr['RESTAURANT_NAME']=$data['Restaurant']['restaurant_name'];
			$arr['CONTACT']=$data['Restaurant']['phone'];		
				
			$Mail->sendMail($data['Agent']['User']['id'],'denied_agent_request',$arr);
			
			$this->Session->setFlash(__('Agent request has been denied.'));
			$this->redirect(array('controller'=>'restaurants','action'=>'my_agents'));				
		}
	}
	
	public function remove_linked_agent($id=null){
		
		$this->Access->checkRestaurantSession();
		if(!empty($id)){			
					
			$this->AgentRestaurant->id=$id;
			$this->AgentRestaurant->save(array('status'=>'3'));									
			$this->Session->setFlash(__('Linked agent has been removed.'));
			$this->redirect(array('controller'=>'restaurants','action'=>'my_agents'));				
		}
	}
	
	public function compose_menu(){
		
		if(isset($this->params['slug']) && !empty($this->params['slug'])){
			
			$slug=$this->params['slug'];		
			$slug=str_replace('-',' ',$slug);
			
		}else if($this->Cookie->check('Basket')){
			$cookie=$this->Cookie->read('Basket');
			$this->Cookie->delete('Basket');
			if(isset($cookie['restaurant_id'])){
				$cookie_rest=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$cookie['restaurant_id'])));
				$slug=str_replace('-',' ',strtolower($cookie_rest['Restaurant']['restaurant_name']));
				$this->set('basket_totalqty',$cookie['totalqty']);
				$this->set('basket_totalprice',$cookie['totalprice']);
				$this->set('basket',$cookie);	
			}
						
		}
		
		$this->layout='frontend_menu';	
		
		if(!empty($slug)){ 
		
			$this->Restaurant->recursive=2;
			
			$this->Menu->bindModel(array('belongsTo'=>array('MenuCategory'=>array('className'=>'MenuCategory','foreignKey'=>'menucategory_id'))));
			$this->Restaurant->bindModel(array('hasMany'=>array('Menu'=>array('className'=>'Menu','foreignKey'=>'restaurant_id'))));
			$restaurant=$this->Restaurant->find('first',array('conditions'=>array("Restaurant.restaurant_name LIKE"=>$slug)));
			
			if(!empty($restaurant['Restaurant']['facilities'])){
				$facilities=explode('|',$restaurant['Restaurant']['facilities']);
				$facs=$this->Facility->find('all',array('conditions'=>array('Facility.id IN'=>$facilities)));
				$this->set('facilities',$facs);
					
			}
			
			$this->Deal->unbindModel(array('belongsTo'=>array('Restaurant')));
			$deals=$this->Deal->find('first',array('conditions'=>array('Deal.restaurant_id'=>$restaurant['Restaurant']['id'])));
			
			if(!empty($deals)){
				$this->set('deal',$deals);	
			}	
			
			
			$menuCat=array(); $i=0;
			if(!empty($restaurant['Menu'])){
				foreach($restaurant['Menu'] as $mn){
					if(!empty($mn['MenuCategory'])){
						$menuCat[$mn['MenuCategory']['id']]=$mn['MenuCategory']['name'];
						$i++;	
					}	
				}
			}
			$this->set('menuCat',$menuCat);
			$this->set('restaurant',$restaurant);
		}
		
		
		$this->render('compose_menu');	
	}
	
	public function get_menu_items(){
		
		$this->layout='ajax';
		$cat_id=$this->data['category_id'];
		$rest_id=$this->data['restaurant_id'];
		if(!empty($cat_id) && !empty($rest_id)){
			$menu=$this->Menu->find('all',array('conditions'=>array('Menu.menucategory_id'=>$cat_id,'Menu.restaurant_id'=>$rest_id)));
			$restaurant=$this->Restaurant->findById($rest_id);
			$this->set('restaurant',$restaurant);
			$this->set('menu',$menu);	
		}
		
		$this->render('get_menu_items');	
	
	}
	public function update_most_loved($id=null){
		$this->layout='admin';
		$this->Restaurant->id=$id;
		$res=$this->Restaurant->findById($id);
		$loved=$res['Restaurant']['most_loved'];
		if($loved=='Yes'){
		     $this->request->data['Restaurant']['most_loved']='No';
		}
		elseif($loved=='')
		{
	    	$this->request->data['Restaurant']['most_loved']='Yes';
		}
		else{
	    	$this->request->data['Restaurant']['most_loved']='Yes';
		}
		if($this->Restaurant->save($this->request->data)){
			$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
		}else{
			$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
		}
		die;
		
	}
	public function update_best_seller($id=null){
		$this->layout='admin';
		$this->Restaurant->id=$id;
		$res=$this->Restaurant->findById($id);
		$seller=$res['Restaurant']['best_seller'];
		if($seller=='Yes'){
		     $this->request->data['Restaurant']['best_seller']='No';
		}
		elseif($seller=='')
		{
	    	$this->request->data['Restaurant']['best_seller']='Yes';
		}
		else{
	    	$this->request->data['Restaurant']['best_seller']='Yes';
		}
		if($this->Restaurant->save($this->request->data)){
			$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
		}else{
			$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
		}
		die;
		
	}
	
	public function update_popular_this_week($id=null){
		$this->layout='admin';
		$this->Restaurant->id=$id;
		$res=$this->Restaurant->findById($id);
		$popular=$res['Restaurant']['popular_this_week'];
		if($popular=='Yes'){
		     $this->request->data['Restaurant']['popular_this_week']='No';
		}elseif($popular==''){
	    	$this->request->data['Restaurant']['popular_this_week']='Yes';
		}else{
	    	$this->request->data['Restaurant']['popular_this_week']='Yes';
		}
		if($this->Restaurant->save($this->request->data)){
			$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
		}else{
			$this->redirect(array('controller'=>'restaurants','action'=>'index','admin'=>true));
		}
		die;
		
	}
	
	public function create_order(){
		$this->layout='restaurant';
		$category=$this->MenuCategory->find('all',array('conditions'=>array('restaurant_id'=>$this->Session->read('User.2.restaurant_id'))));
    	$this->set('category',$category);
	}
	
	public function list_menus(){
		$this->layout='ajax';
		$this->Access->checkRestaurantSession();
		$menu=$this->Menu->find('all',array('conditions'=>array('Menu.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),'Menu.menucategory_id'=>$this->request->data['menu'])));
		
		$this->set('menu',$menu);
			
		}
		
	public function add_order($cid,$rid,$mid){
		$this->layout='ajax';
		$this->Access->checkRestaurantSession();
		$menuitem=$this->Menu->find('all',array('conditions'=>array('Menu.restaurant_id'=>$rid,'Menu.menucategory_id'=>$cid,'Menu.id'=>$mid)));
		$this->set('menuitem',$menuitem);
		
		
	}
	
	public function remove_item($cid,$rid,$mid){
		$this->layout='ajax';
		$this->Access->checkRestaurantSession();
		$menuitem=$this->Menu->find('all',array('conditions'=>array('Menu.restaurant_id'=>$rid,'Menu.menucategory_id'=>$cid,'Menu.id'=>$mid)));
		$this->set('menuitem',$menuitem);
		die;
		
		
	}
	
	public function proceed(){
		$this->layout='restaurant';
		if($this->request->is('post')){
			if(!empty($this->request->data)){
				foreach($this->request->data['quantity'] as $itemKey=>$value){
					if(empty($value)){
						$this->Session->setFlash(__('Please add atleast one quantity.'),'default',array('class'=>'error'));
						$this->redirect($this->referer());
					}
					$id[]=$itemKey;
					}
		        $this->set('items',$this->request->data);
				$menu=$this->Menu->find('all',array('conditions'=>array('Menu.id'=>$id)));
				$this->set('menu',$menu);
			}else{
				$this->Session->setFlash(__('Please add atleast one item'),'default',array('class'=>'error'));
				$this->redirect($this->referer());
			}
			
		}
		
	}
	public function check_out(){
		if($this->request->is('post')){
			$this->request->data['Order']['order_date']=date("Y-m-d H:i:s");
			$this->request->data['Order']['total_cost']=$this->request->data['Order']['total'];
			$this->request->data['Order']['order_status']="processing";
			$this->request->data['Order']['restaurant_id']=$this->Session->read('User.2.restaurant_id');
			$this->request->data['Order']['booked_by']="Restaurant";
			$delivery=$this->request->data['Order']['delivery_type'];
		if($delivery==1){
			$this->request->data['Order']['delivery_type']="Home Delivery";
		}
		elseif($delivery==2){
			$this->request->data['Order']['delivery_type']="Dine In";
		}
		else{
			$this->request->data['Order']['delivery_type']="Take away";
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
			$data['restaurant_id']=$this->Session->read('User.2.restaurant_id');
			$savedetail[]=$data;
		  
		}
		$this->request->data['OrderDetail'] =$savedetail;
            $this->Order->saveAll($this->request->data);
		}
			if (!$this->request->data) {
			$this->request->data = $post;
		}
		
			$this->redirect(array('controller'=>'restaurants','action'=>'list_orders'));
	
		}
		
	    die;
	}
	
	public function list_orders(){
		$this->layout='restaurant';
		$this->Access->checkRestaurantSession();
		$this->Order->recursive = 3;
		$this->paginate=array('limit'=>'10','conditions'=>array('Order.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),'Order.booked_by !='=>''));       
		$order=$this->paginate('Order');	
		$this->set('order',$order);	
	}
	public function list_agent_bookings($id){
		$this->layout='restaurant';
		$this->Access->checkRestaurantSession();
		$this->Order->recursive = 3;
		$this->paginate=array('limit'=>'10','conditions'=>array('Order.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),'Order.agent_id'=>$id));
	    $order=$this->paginate('Order');
		$agcomm=$this->AgentRestaurant->find('first',array('conditions'=>array('AgentRestaurant.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),'AgentRestaurant.agent_id'=>$id)));	
		$this->set('agcomm',$agcomm);
		$this->set('order',$order);	
	}
	public function filter_orders($val=null){
		$this->layout='ajax';
		$this->Access->checkRestaurantSession();
		if($val==0){
			$val=array("Restaurant","Customer","Agent");
			}
			if($val==3){
			$val="Agent";}
			if($val==1){
				$val="Restaurant";}
				if($val==2){
					$val="Customer";
					}
		$this->Order->recursive = 3;
		$this->paginate=array('limit'=>'10','conditions'=>array('Order.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),    'Order.booked_by'=>$val));
	    $order=$this->paginate('Order');	
		$this->set('order',$order);	
	}
	public function edit($status ,$oid) {
        $this->layout='ajax';
	   if ($this->request->is('post') || $this->request->is('put')) {
			$this->Order->id = $oid;
			if($status==1){
				$status="processing";}
					if($status==2){
						$status="delivered";}
			$this->request->data['Order']['order_status']=$status;
			$this->Order->save($this->request->data);
			$res=$status;
			}
		    echo $res;
			die;
			}
	
	 public function set_commision($id=null){
		 
	 	$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		$post = $this->AgentRestaurant->findById($id);
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$post = $this->AgentRestaurant->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AgentRestaurant->save($this->request->data)) {
				$this->Session->setFlash('Commision is updated successfully.');
				if(!empty($id)){
				   $this->AgentRestaurant->id=$id;
				   $this->AgentRestaurant->recursive=2;
				   $data=$this->AgentRestaurant->find('first',array('conditions'=>array('AgentRestaurant.id'=>$id)));
					try{									
						$this->Email->to =$data['Agent']['User']['email'];
						$this->Email->subject = 'Commission details';
						$this->Email->from =$data['Restaurant']['User']['email'];
						$this->Email->delivery = 'smtp';
						$body='Dear'.' '.$data['Agent']['name']."".' '.'the commission set by restaurant'.' '.$data['Restaurant']['restaurant_name']. ' '.'to'.' '.$data['AgentRestaurant']['commision'].' '.'%'  ;
						
						$this->Email->send($body);
						$this->redirect(array('controller'=>'restaurants','action'=>'my_agents'));	
					}
					catch(Exception $e){
						$this->redirect(array('controller'=>'restaurants','action'=>'my_agents'));	
					}
				}			
				
			}
		}
		if (!$this->request->data) {
			$this->request->data = $post;
		}
	 }
	 
	 public function commission_summary($id){
		 $this->layout='restaurant';
		 $myagents=$this->AgentRestaurant->find('first',array('conditions'=>array('AgentRestaurant.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),'AgentRestaurant.agent_id'=>$id)));
		 $comm_summary=$this->Order->find('all',array('conditions'=>array('Order.restaurant_id'=>$this->Session->read('User.2.restaurant_id'),'Order.agent_id'=>$id)));
		 $total_booked=$this->Order->find('count',array('conditions'=>array('Order.agent_id'=>$id,'And'=>array('Order.restaurant_id'=>$this->Session->read('User.2.restaurant_id')))));
		$total_cus_booked = $this->Order->find('count', array('fields'=>'DISTINCT Order.customer_id',
    'conditions'=> array('Order.agent_id'=>$id, 'AND'=>array('Order.restaurant_id'=>$this->Session->read('User.2.restaurant_id')))
));

		$usr=$this->User->find('first',array('conditions'=>array('User.id'=>$myagents['Agent']['user_id'])));
		$this->set('usr',$usr);
		$this->set('total_booked',$total_booked);
		$this->set('total_cus_booked',$total_cus_booked);
		$this->set('comm_summary',$comm_summary);
		$this->set('myagents',$myagents);
	 }
		
}