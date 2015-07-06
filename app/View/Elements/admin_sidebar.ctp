<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li <?php if($this->params['controller']=='dashboard') echo 'class="active"'; ?>><a href="<?php echo $this->webroot; ?>admin/dashboard"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                       
                        <li <?php if($this->params['controller']=='restaurants') echo 'class="active"'; ?>><a href="<?php echo $this->webroot; ?>admin/restaurants"><i class="icon-star"></i><span class="hidden-tablet"> Restaurants</span></a>
                        	 <ul class="subnav">
                                <li><a href="<?php echo $this->webroot; ?>admin/restaurants/add"><span class="hidden-tablet"> Add Restaurant</span></a></li>
                               <li><a href="<?php echo $this->webroot; ?>admin/restaurants"><span class="hidden-tablet"> Manage Restaurants</span></a></li>
                            </ul>                        
                        </li> 
                        
                        <li <?php if($this->params['controller']=='agents') echo 'class="active"'; ?>><a href="<?php echo $this->webroot; ?>admin/agents"><i class="icon-star"></i><span class="hidden-tablet"> Agents</span></a></li>                      
                        
                    </ul>
				</div><!--/.well -->
			</div>