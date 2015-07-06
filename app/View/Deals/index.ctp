<section id="body_container">

        	<section class="checkout_box">
            	<div class="wrapper">
                	<h4><span>Select your Country &amp; City</span></h4>
                    <section class="basket_box right_container cities">
                    	
                      
                        <select id="country_select" onchange="get_cities(this.value);">
                        <option>Select Country</option>
                       <?php foreach($countries as $cn){ ?>
                       	<option value="<?php echo $cn['Country']['country_code'];?>"><?php echo $cn['Country']['country_name'];?></option>
                       <?php } ?>
                        </select>
                       
                       <select id="cities" onchange="get_deals(this.value);">
                       <option>Select City</option>
                       </select>
                                       
                    </section>
                </div>
            </section>
            
            
            
            <section class="main_box deals_data">
            	<div class="wrapper">
                	<section class="left_container">
                    	
                        <?php 
							 if(!empty($deals)){ ?>
                             
                          <section class="food_sec">
                        	<ul> 
                             <?php 
								foreach($deals as $dl){ ?>
                       
                            	<li class="">
                                	<a href="<?php echo $this->webroot.str_replace(' ','-',strtolower($dl['Restaurant']['restaurant_name'])); ?>">
                                	<section class="off_box">
                                    	<section class="rating">
                                    		<span class="title_tag"><?php echo $dl['Deal']['title'].' - '; 
												
												if($dl['Deal']['discount_type']=='Pure Value') 
													$curr=$dl['Restaurant']['currency'];
												else
													$curr=' %';
													
												echo intval($dl['Deal']['value']).$curr.' Discount';		
											
											?></span>
                                            
                                        </section>
                                        <!--<img src="common/images/off.png">-->
                                    </section>
                                    <section class="detail_box">
                                    	<small><img class="menu_img" src="<?php echo $this->webroot.'files/'.$dl['Deal']['restaurant_id'].'/'.$dl['Restaurant']['logo']; ?>" width="179" height="132"></small>
                                        <section class="info description_tag">
                                        	<strong><?php echo $dl['Restaurant']['restaurant_name']; ?></strong>
                                            <p><?php echo wraptext($dl['Deal']['description'],200); ?></p>
                                            
                                        </section>
                                    </section>
                                    </a>
                                </li>
                                                           
                            
                        <?php } ?>
                        	</ul>
                            <!--<a href="#" class="more">show more</a>-->
                        </section>
                        <?php } ?>
                    </section>
                	<section class="right_container">
                    	<ul class="adds">
                        	<li><img src="<?php echo $this->webroot.'img/add2.jpg'; ?>"</li>
                        	<li><img src="<?php echo $this->webroot.'img/add3.jpg'; ?>"</li>
                        	<li><img src="<?php echo $this->webroot.'img/add4.jpg'; ?>"</li>
                        	<li><img src="<?php echo $this->webroot.'img/add5.jpg'; ?>"</li>
                        	<li><img src="<?php echo $this->webroot.'img/add7.jpg'; ?>"</li>
                        </ul>
                    </section>
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
    $('#country_select').val('');
	 $('#cities').val('');
});

function get_cities(val){
	 $('#cities').val('');
	$.post('<?php echo $this->webroot; ?>deals/get_cities',{country:val},function(data){
			$('#cities').html(data);
		});	
}

function get_deals(val){
	$.post('<?php echo $this->webroot; ?>deals/paging_index',{city:val},function(data){
			$('.deals_data').html(data);
		});	
}

</script>        