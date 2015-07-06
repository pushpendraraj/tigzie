<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
                        <li <?php if($this->params['controller']=='agents' && $this->params['action']=='profile') echo 'class="active"'; ?>><a href="<?php echo $this->webroot; ?>agents/profile"><i class="icon-star"></i><span class="hidden-tablet"> Profile</span></a>                       
                        </li>
                        
                        <li <?php if($this->params['controller']=='agents' && ($this->params['action']=='restaurant_list' || $this->params['action']=='linked_restaurants' || $this->params['action']=='pending_approvals')) echo 'class="active"'; ?>><a href="<?php echo $this->webroot; ?>agents/restaurantList"><i class="icon-star"></i><span class="hidden-tablet"> Restaurant</span></a>
                        	 <ul class="subnav">
                                <li><a href="<?php echo $this->webroot; ?>agents/linked_restaurants"><span class="hidden-tablet"> Linked Restaurants</span></a></li>								
                                <li><a href="<?php echo $this->webroot; ?>agents/pending_approvals"><span class="hidden-tablet"> Pending Approvals</span></a></li>
                               <li><a href="<?php echo $this->webroot; ?>agents/restaurantList"><span class="hidden-tablet"> All Restaurants</span></a></li>
                            </ul>                        
                        </li> 
                        <li <?php if($this->params['controller']=='agents' && ($this->params['action']=='create_order' || $this->params['action']=='list_orders')) echo 'class="active"'; ?>><a href="<?php echo $this->webroot; ?>agents/list_orders"><i class="icon-list-alt"></i><span class="hidden-tablet"> Orders</span></a>
                        	 <ul class="subnav">
                                <li><a href="<?php echo $this->webroot; ?>agents/create_order"><span class="hidden-tablet">Create Order</span></a></li>
                                <li><a href="<?php echo $this->webroot; ?>agents/list_orders"><span class="hidden-tablet">List All Orders</span></a></li>                               
                            
                            </ul>                        
                        </li> 
                         <li <?php if($this->params['controller']=='agents' && ($this->params['action']=='commision_details' )) echo 'class="active"'; ?>><a href="<?php echo $this->webroot; ?>agents/commision_details"><i class="icon-list-alt"></i><span class="hidden-tablet"> Commision Details</span></a> </li>                     
                        <li <?php if($this->params['controller']=='agents' && ($this->params['action']=='direct_booking_urls' )) echo 'class="active"'; ?>><a href="<?php echo $this->webroot; ?>agents/direct_booking_urls"><i class="icon-list-alt"></i><span class="hidden-tablet"> Direct Booking Urls</span></a> </li>
                         
                    </ul>
				</div><!--/.well -->
			</div>