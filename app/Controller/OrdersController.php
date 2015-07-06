<?php 
App::import('Vendor','functions');
App::uses('AppController','Controller');

class OrdersController extends AppController{
	
	public $helpers = array('Html','Form');
	public $uses = array('Restaurant','Menu','Facility','Deal','Order','OrderDetail','Customer');
	public $components = array('Session','Cookie');
	
	public function beforeFilter(){
		$this->layout='frontend_menu';	
	}
	
	public function checkout(){
		//$this->Cookie->destroy();
		/*if($this->Cookie->check('Basket')){
			$cookie=$this->Cookie->read('Basket');
			
		}*/
		
		$items=array(); $i=0; $ids=array();
		if(isset($this->data['item']) && !empty($this->data['item'])){
			
			$restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$this->data['restaurant_id'])));
			if(!empty($restaurant['Restaurant']['facilities'])){
				$facilities=explode('|',$restaurant['Restaurant']['facilities']);
				$facs=$this->Facility->find('all',array('conditions'=>array('Facility.id IN'=>$facilities)));
				$this->set('facilities',$facs);					
			}
			
			foreach($this->data['item'] as $dat){
				foreach($dat as $id=>$qty){
					if(!in_array($id,$ids)){						
						$items[$id]=$qty;
						$ids[]=$id;						
					}else{
						$items[$id]+=$qty;	
					}				
				}	
			}
			
			$this->Deal->unbindModel(array('belongsTo'=>array('Restaurant')));
			$deals=$this->Deal->find('first',array('conditions'=>array('Deal.restaurant_id'=>$restaurant['Restaurant']['id'])));
			if(!empty($deals)){						
				$this->set('deal',$deals);						
			}
			
			if(count($ids)>1) $func='IN'; else $func=null;
			$menu=$this->Menu->find('all',array('conditions'=>array('Menu.id '.$func=>$ids)));			
			if(!empty($menu)){
				$totalprice=$totalqty=$i=0;
								
				foreach($menu as $mn){
					
					if(!empty($deals)){						
						$price=calculate_price($mn['Menu']['price'],$deals['Deal']['value'],$deals['Deal']['discount_type']);						
					}
					
					foreach($items as $ind=>$itm){
						if($ind==$mn['Menu']['id']){
							
						
							$menu[$i]['Menu']['qty']=$itm;	
							$totalprice+=($price*$itm);
							$totalqty+=$itm;
						}	
					}
					$i++;	
				}
				
				//pr($menu); die;
				
				if(isset($cookie) && !empty($cookie)){								
					foreach($cookie['menu'] as $ckm){	
						if(!in_array($ckm['Menu']['id'],$ids)){
							/*-------Add already existing item to new menu list----*/
							$menu[$i]=$ckm;
							$totalprice+=($ckm['Menu']['price']*$ckm['Menu']['qty']);
							$totalqty+=$ckm['Menu']['qty'];
							$i++;
						}else{
							/*----update item quantity and corresponding total price in new menu list----*/
							$j=0;
							foreach($menu as $mn){
								if($mn['Menu']['id']==$ckm['Menu']['id']){
									$menu[$j]['Menu']['qty']+=$ckm['Menu']['qty'];
									$totalprice+=$cookie['totalprice'];
									$totalqty+=$cookie['totalqty'];	
								}
								$j++;	
							}	
						}			
					}						
				}							
				$this->Cookie->time = 3600;  // 1 hour
				$this->Cookie->write('Basket.menu',$menu);
				$this->Cookie->write('Basket.totalqty',$totalqty);
				$this->Cookie->write('Basket.restaurant_id',$restaurant['Restaurant']['id']);
				$this->Cookie->write('Basket.totalprice',$totalprice);
				
				
				$this->set('restaurant',$restaurant);
				$this->set('totalprice',$totalprice);
				$this->set('totalqty',$totalqty);	
			}
			
			$this->set('menu',$menu);	
		}else{
			$this->redirect('/');	
		}				
		$this->render('checkout');		
	}
	
	public function update_quantity(){
		
		$this->layout='ajax';
		$id=$this->data['id'];
		$qty=$this->data['cur_qty'];
		$type=$this->data['type'];
			
		$restaurant_id=$this->data['restaurant_id'];
		$restaurant=$this->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$restaurant_id)));
		
		$cookie=$this->Cookie->read('Basket');
		if(!empty($cookie)){
			$i=0;
			foreach($cookie['menu'] as $ckm){
				if($ckm['Menu']['id']==$id){
					
					if($type=='1'){
						
						$cookie['menu'][$i]['Menu']['qty']=($qty+1);
						$cookie['totalprice']+=$ckm['Menu']['price'];
						$cookie['totalqty']+=1;
						
					}else if($type=='2'){
						if(($qty-1)>0){
							$cookie['menu'][$i]['Menu']['qty']=($qty-1);
							
						}else{
							unset($cookie['menu'][$i]);
						}
						$cookie['totalprice']-=$ckm['Menu']['price'];
						$cookie['totalqty']-=1;	
						
					}else if($type=='3'){
						$sub_qty=$ckm['Menu']['qty'];
						$sub_price=$ckm['Menu']['price'];
						unset($cookie['menu'][$i]);	
						$cookie['totalprice']-=($sub_price*$sub_qty);
						$cookie['totalqty']-=$sub_qty;
					}
				}
				$i++;
			}
			
			$this->Cookie->time = 3600;  // 1 hour
			$this->Cookie->write('Basket.menu',$cookie['menu']);
			$this->Cookie->write('Basket.totalqty',$cookie['totalqty']);
			$this->Cookie->write('Basket.restaurant_id',$restaurant['Restaurant']['id']);
			$this->Cookie->write('Basket.totalprice',$cookie['totalprice']);
				
			$this->set('menu',$cookie['menu']);	
			$this->set('restaurant',$restaurant);
			$this->set('totalprice',$cookie['totalprice']);
			$this->set('totalqty',$cookie['totalqty']);
			
			$this->render('basket_items');
		}	
	}
	
	public function confirm_order(){
		if($this->request->is('post')){
			$this->request->data['Order']['order_date']=date("Y-m-d H:i:s");
			$this->request->data['Order']['total_cost']=$this->request->data['Order']['total'];
			$this->request->data['Order']['order_status']="processing";
			$this->request->data['Order']['restaurant_id']=$this->request->data['restaurant_id'];
			$this->request->data['Order']['booked_by']="Customer";
			$this->request->data['Order']['agent_id']=$this->request->data['Order']['agent_id'];
			//$this->request->data['Customer']['message']=$this->request->data['Customer']['message'];
			$delivery=$this->request->data['delivery_type'];
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
			//$data['customer_id']= $this->Customer->id;
			//$data['order_id']=$this->Order->id;
			$data['restaurant_id']=$this->request->data['restaurant_id'];
			$savedetail[]=$data;
		  
		}
		$this->request->data['OrderDetail'] =$savedetail;
            $this->Order->saveAll($this->request->data);
		}
			if (!$this->request->data) {
			$this->request->data = $post;
		}
		
			$this->redirect(array('controller'=>'orders','action'=>'success'));
	
		}
		
	    die;
	}
	
	public function success(){
		$this->layout='frontend_menu';	
	}
	
	
}