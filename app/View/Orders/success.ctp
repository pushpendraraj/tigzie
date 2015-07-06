<section id="body_container">
	<form id="deliveryForm" name="deliveryForm" method="post" action="<?php echo $this->webroot; ?>orders/confirm_order<?php if(isset($this->request->query['agent_id'])){
							echo "?agent_id=".$this->request->query['agent_id'];}?>">
    	
        	<section class="checkout_box">
            	<div class="wrapper">
                	<h4><span>Checkout</span></h4>
                    <section class="basket_box right_container">
                    	<div class="title_row">
               
                     <h3>Your order has been successfully sent. Thank you!</h3>
                     
            <section class="tab_box">
            	<div class="wrapper">
                	
                </div>
            </section>            
            <section class="success_box">
            	<div class="wrapper">
                	<div class="box">
                    	

                    </div>
                </div>
            </section>
            <section class="bottom_container">
            	<div class="wrapper">
                	
                    
                </div>
            </section>
            </form>
        </section>
 