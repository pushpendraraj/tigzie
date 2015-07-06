<?php 

class UsersController extends AppController{	

	public $uses = array('User','City');
	
	public function logout($num=0){
		$this->Session->delete('User');		
		$this->Session->destroy();
		if($num==1)
			$this->redirect('/restaurant');
		else if($num==2)
			$this->redirect('/agent');	
		else		
			$this->redirect('/superadmin');	
	}	

	public function settings($role){
		$this->set('role',$role);	
	}

	public function get_cities(){
		$data=explode("|",$this->data['country_code']);		
		$cities=$this->City->find('all',array('conditions'=>array('City.country_code'=>$data[1])));
		$city_array='<option value="">Select City</option>';
		if(!empty($cities)){
			foreach($cities as $ct){
				if(!empty($ct['City']['city_name'])){
					$cityName=htmlspecialchars($ct['City']['city_name']);
					$city_array.='<option value="'.$ct['City']['id'].'">'.$cityName.'</option>';	
				}
			}	
		}
		$city_array.='<option value="others">Others</option>';
		echo $city_array; die;		
	}			

}