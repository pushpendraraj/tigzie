<section id="body_container">
	<form id="deliveryForm" name="deliveryForm" method="post" action="<?php echo $this->webroot; ?>orders/confirm_order<?php if(isset($this->request->query['agent_id'])){
							echo "?agent_id=".$this->request->query['agent_id'];}?>">
    	<input type="hidden" name="data[restaurant_id]" value="<?php echo $restaurant['Restaurant']['id']; ?>"/>
        	<section class="checkout_box">
            	<div class="wrapper">
                	<h4><span>Checkout</span></h4>
                    <section class="basket_box right_container">
                    	<div class="title_row">
                    		<span></span>
                            <h3>What’s in your basket?</h3>
                        </div>
                        <ul class="basket_items">
                        	<?php if(isset($menu) && !empty($menu)){																
									foreach($menu as $mn){	?>
                        	<li>
                            	<?php if(!empty($mn['Docs'])){ ?>
                            		<small><img src="<?php  echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$mn['Docs'][0]['name']; ?>" width="27" height="27"></small>
                                <?php } ?>
                                <span><?php echo $mn['Menu']['qty']; ?></span>
                                <div class="controls"><a href="javascript://" onclick="update_quantity(<?php echo $mn['Menu']['id']; ?>,<?php echo $mn['Menu']['qty']; ?>,1,<?php echo $restaurant['Restaurant']['id']; ?>);" class="plus"><img src="<?php echo $this->webroot; ?>img/plus.jpg"></a><a href="javascript://" onclick="update_quantity(<?php echo $mn['Menu']['id']; ?>,<?php echo $mn['Menu']['qty']; ?>,2,<?php echo $restaurant['Restaurant']['id']; ?>);" class="minus"><img src="<?php echo $this->webroot; ?>img/minus.jpg"></a></div>
                                <h5><?php echo $mn['Menu']['title']; ?></h5>
                                <p>(<?php echo wraptext($mn['Menu']['description'],40);?>)</p>
                                <h6><?php if(isset($deal)){ echo calculate_price($mn['Menu']['price'],$deal['Deal']['value'],$deal['Deal']['discount_type'])*$mn['Menu']['qty']; }else{ echo $mn['Menu']['price']*$mn['Menu']['qty'];} echo ' '.$restaurant['Restaurant']['currency']; ?></h6>
                                <a href="javascript://" onclick="update_quantity(<?php echo $mn['Menu']['id']; ?>,<?php echo $mn['Menu']['qty']; ?>,3,<?php echo $restaurant['Restaurant']['id']; ?>);"></a>
                            </li>
                            <input type="hidden" name="data[OrderDetail][<?php echo $mn['Menu']['id']?>][quantity]" value="<?php echo $mn['Menu']['qty']; ?>"/>
                              <input type="hidden" name="data[OrderDetail][<?php echo $mn['Menu']['id']?>][price]" value="<?php echo $mn['Menu']['price']; ?>"/>
                            <?php if(isset($this->request->query['agent_id'])){
								echo $this->form->input('Order.agent_id',array('type'=>'hidden','value'=>$this->request->query['agent_id']));}else{
									echo $this->form->input('Order.agent_id',array('type'=>'hidden','value'=>''));
								}?>
                            <?php }}else{ ?>
                            <li><h4>No item in basket</h4></li>	
                            <?php } ?>
                           
                            <li>
                            	<h4><?php if(isset($totalqty)) echo $totalqty; else echo 0;?> pcs in total price: </h4>
                                <h6 ><?php if(isset($totalprice)){?><?php echo $totalprice; ?> <?php echo $this->form->input('Order.total',array('type'=>'hidden','value'=>$totalprice));} echo ' '.$restaurant['Restaurant']['currency']; ?> <small>(including VAT)</small></h6>
                            </li>
                        </ul>
                        <!--<strong><a href="#">Back to shopping</a></strong>-->
                    </section>
                </div>
            </section>
            <section class="tab_box">
            	<div class="wrapper">
                	<input type="hidden" id="delivery_type" name="data[delivery_type]" value="1"/>
                	<ul class="delivery_type_tabs">
                    	<li class="active" onclick="update_delivery_type(1);"><span>Home Delivery</span></li>
                    	<li onclick="update_delivery_type(2);"><span>Dine In</span></li>
                    	<li onclick="update_delivery_type(3);"><span>Take away</span></li>
                    </ul>
                </div>
            </section>
            <section class="order_box order_box_1">
            	<div class="wrapper">
                	<div class="title_row">
                        <span></span>
                        <h3>Your details</h3>
                    </div>                                        
                    <ul>
                    	<li><span><?php echo $this->Form->input('Customer.first_name',array('type'=>'text','class'=>'validate[required]','label'=>false,'placeholder'=>'First Name')); ?>  </span></li>
                        <li><span><?php echo $this->Form->input('Customer.last_name',array('type'=>'text','label'=>false,'placeholder'=>'Surname')); ?></span></li>
                        <li><span><?php echo $this->Form->input('Customer.address',array('type'=>'text','label'=>false,'class'=>'validate[required]','placeholder'=>'Street')); ?></span></li>
                        <li><span><?php echo $this->Form->input('Customer.city',array('type'=>'text','label'=>false,'class'=>'validate[required]','placeholder'=>'city')); ?></span></li>
                    </ul>
                    <ul>
                    	<li><span><?php echo $this->Form->input('Customer.email_id',array('type'=>'text','label'=>false,'class'=>'validate[required,custom[email]]','placeholder'=>'email')); ?></span></li>
                        <li><span><?php echo $this->Form->input('Customer.phone',array('type'=>'text','label'=>false,'class'=>'validate[required]','placeholder'=>'phone number')); ?></span></li>
                        <li><strong><?php echo $this->Form->input('Customer.message',array('type'=>'textarea','label'=>false,'placeholder'=>'Message')); ?></strong></li>
                    </ul>                    
                </div>
            </section>            
            
            <section class="pay_box">
            	<div class="wrapper">
                	<div class="title_row">
                        <span></span>
                        <h3>How will you pay?</h3>
                    </div>
                    <ul>
                    	<li class="first">
                        	<section class="left_box">
                            	<img src="<?php echo $this->webroot; ?>img/frontend/cash.png">
                                <a href="javascript://">Select</a>
                            </section>
                            <section class="details">
                            	<h4>Cash on delivery</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam turpis lectus, aliquam a varius tincidunt, bibendum sed lacus. Nullam ullamcorper sem quis mauris sodales gravida lacinia metus tristique.</p>
                            </section>
                        </li>
                        <li class="last">
                        	<section class="left_box">
                            	<img src="<?php echo $this->webroot; ?>img/frontend/check.png">
                                <a href="javascript://">Select</a>
                            </section>
                            <section class="details">
                            	<h4>Cash on delivery</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam turpis lectus, aliquam a varius tincidunt, bibendum sed lacus. Nullam ullamcorper sem quis mauris sodales gravida lacinia metus tristique.</p>
                            </section>
                        </li>
                    </ul>
                    <strong><div class="form-actions none">
                          <button type="submit" class="btn btn-primary" class="place">Place Order</button>
                          
                        </div>
                       <?php echo $this->Form->end(); ?> 
</strong>
                </div>
            </section>
            <section class="success_box">
            	<div class="wrapper">
                	<div class="box">
                    	<h3>Your order has been successfully sent. Thank you!</h3>
                        <p>An e-mail with order receipt has been sent to <a href="mailto:<?php echo $restaurant['User']['email']; ?>"><?php echo $restaurant['User']['email']; ?></a><br>
Your order number is <strong><?php echo time(); ?></strong><br>
If you have any questions please call us on <strong>02 / 12 23 36</strong> or <a href="#">Skype</a></p>
                    </div>
                </div>
            </section>
            <section class="bottom_container">
            	<div class="wrapper">
                	
                    
                </div>
            </section>
            </form>
        </section>
        
<script type="text/javascript">
$(document).ready(function(e) {
    $("#deliveryForm").validationEngine({promptPosition: "topRight"});
});

function confirmOrder(){
	var valid = $("#deliveryForm").validationEngine('validate');
	if(valid)
	{
		$('.tab_box').hide();
		$('.order_box').hide();
		$('.pay_box').hide();
		$('.success_box').fadeIn();
			
	}else{
		$("#deliveryForm").validationEngine({scroll:false,focusFirstField : false});		
	}
}

function update_delivery_type(typ){
	$('.delivery_type_tabs li').removeClass('active');
	$('.delivery_type_tabs li').eq(parseInt(typ)-1).addClass('active');
	$('#delivery_type').val(typ);
	
}

function update_quantity(id,cur_qty,type,restaurant_id){
	$.post('<?php echo $this->webroot; ?>orders/update_quantity',{id:id,cur_qty:cur_qty,type:type,restaurant_id:restaurant_id},function(data){
			$('.basket_items').html(data);
		});
}


</script>        