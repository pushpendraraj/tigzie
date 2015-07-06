<?php 

App::import('Vendor',array('functions'));

class DealsController extends AppController{
	
	public $components = array('Session','Access');
	public $uses = array('User','Restaurant','Deal','Country','City');	
	
	public function beforeFilter(){
		parent::beforeFilter();		
	}
	
	public function index(){
		
		$this->layout='frontend_menu';
		$deals=$this->paginate('Deal');	
		
		$countries=$this->Country->find('all',array('order'=>array('Country.country_name'=>'asc')));		
		$this->set('deals',$deals);
		$this->set('countries',$countries);
		$this->render('index');
	}
	
	public function get_cities(){
		$cities=$this->City->find('all',array('conditions'=>array('City.country_code'=>$this->data['country']),'order'=>array('City.city_name'=>'asc')));
		
		$city='<option>Select City</option>';
		if(!empty($cities)){
			foreach($cities as $ct){
				$city.='<option value="'.$ct['City']['id'].'">'.$ct['City']['city_name'].'</option>';	
			}	
		}
		
		echo $city; die;	
	}
	
	public function paging_index(){
		$this->layout='ajax';
		
		if(!empty($this->data['city'])){
		$this->paginate=array('conditions'=>array('Restaurant.city_id'=>$this->data['city']));
		$deals=$this->paginate('Deal');	
		
				
		$this->set('deals',$deals);
		}
		
		$this->render('paging_index');	
	}
	
	public function list_deals(){
		$this->layout='restaurant';
		
		$deals=$this->paginate('Deal');
		$this->set('deals',$deals);	
		$this->render('list_deals');
		
	}
	
	public function create_deal(){
		$this->Access->checkRestaurantSession();
		$this->layout='restaurant';
		
		if($this->request->is('post') && !empty($this->request->data)){
			
			$this->request->data['Deal']['created']=date('Y-m-d H:i:s');
			$this->Deal->create();
			$this->Deal->save($this->data);
			$this->Session->setFlash(__('Deal saved successfully.'));
			$this->redirect(array('action'=>'list_deals'));	
		}
		
		$this->set('restaurant_id',$this->Session->read('User.2.restaurant_id'));
		$this->render('create_deal');
	}
	
	public function edit_deal($id=null){
		$this->layout='restaurant';
		$this->Access->checkRestaurantSession();
		if(!empty($this->data)){
			
			$this->Deal->id=$this->data['Deal']['id'];
			$this->Deal->save($this->data);
			$this->Session->setFlash(__('Deal updated successfully.'));
			$this->redirect(array('action'=>'list_deals'));
			
		}		
		 if(!empty($id)){
			$this->request->data=$this->Deal->findById($id);
			$this->set('restaurant_id',$this->request->data['Deal']['restaurant_id']);
			$this->render('edit_deal');	
		}		
	}
	
	public function delete_deal($id=null){
		$this->Access->checkRestaurantSession();
		if(!empty($id)){
			$this->Deal->delete($id);
			$this->Session->setFlash(__('Deal deleted successfully.'));
			$this->redirect(array('action'=>'list_deals'));	
		}	
	}
	
}