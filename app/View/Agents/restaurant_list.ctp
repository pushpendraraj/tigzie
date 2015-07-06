<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Restaurant List (from your city)</h2>						
					</div>
                    
					<div class="box-content">                    	
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Business Name'); ?></th>
								  <th><?php echo __('Email'); ?></th>	
								  <th><?php echo __('Address'); ?></th>
								  <th><?php echo __('Website'); ?></th>
                                  <th><?php echo __('Status'); ?></th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
						  		 foreach ($restaurants as $rest): ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><?php echo h($rest['Restaurant']['restaurant_name']); ?></td>
								<td class="center"><?php echo h($rest['User']['email']); ?></td>
								<td class="center"><?php echo $rest['Restaurant']['street_no'].'<br>'.$rest['Restaurant']['street'].'<br>'.$rest['City']['city_name'].' - '.$rest['Restaurant']['zip_code']; ?></td>
								<td class="center"><?php echo h($rest['Restaurant']['website']); ?></td>
                                <td class="center"><?php if($rest['User']['user_status']=='1') echo __('Active'); else echo __('Inactive'); ?></td>
								<td class="center">							
                                    
                                <!--<a class="btn btn-success" href="<?php echo $this->webroot; ?>admin/restaurants/view/<?php echo $rest['Restaurant']['id']; ?>">
                                    <i class="icon-zoom-in icon-white"></i>  
                                    View                                            
                                </a>-->
                                
                                <?php if(!in_array($rest['Restaurant']['id'],$linkr)){ ?>
                                <a class="btn btn-info" href="<?php echo $this->webroot; ?>agents/registration_request/<?php echo $rest['Restaurant']['id'].'/'.$agent['Agent']['id']; ?>">
                                    <i class="icon-edit icon-white"></i>  
                                    Send Registration Request                                            
                                </a>
                                <?php }else{ ?>
                                	Request Sent
                                <?php } ?>     
								</td>
							</tr>
							<?php $i++; endforeach; ?>
						  </tbody>
					  </table>            
					</div>
				</div>			
			</div>
            </div>


