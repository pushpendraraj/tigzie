<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Agents</h2>						
					</div>                    
					<div class="box-content">                    	
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Agent Name'); ?></th>
								  <th><?php echo __('Email'); ?></th>	
								  <th><?php echo __('City'); ?></th>
								  <th><?php echo __('Country'); ?></th>
                                  <th><?php echo __('Status'); ?></th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
						  	 foreach ($agents as $rest): ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><?php echo h($rest['Agent']['name']); ?></td>
								<td class="center"><?php echo h($rest['User']['email']); ?></td>
								<td class="center"><?php echo h($rest['City']['city_name']); ?></td>
								<td class="center"><?php echo h($rest['Country']['country_name']); ?></td>
                                <td class="center"><?php if($rest['User']['user_status']=='1') echo __('Active'); else echo __('Inactive'); ?></td>
								<td class="center">       
							                                    
                                    <a class="btn btn-success" href="<?php echo $this->webroot; ?>admin/agents/linked_restaurants/<?php echo $rest['Agent']['id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										Restaurant(s)                                            
									</a>									
									                                   
                                    <a class="btn btn-warning" href="<?php echo $this->webroot; ?>admin/agents/update_status/<?php echo $rest['Agent']['id']; ?>/<?php if($rest['User']['user_status']=='1') echo 0; else echo 1;?>">
										 
										<?php if($rest['User']['user_status']=='1') echo __('Deactivate'); else echo __('Activate');?>
									</a>
                                    
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rest['Agent']['id'],'admin'=>true), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $rest['Agent']['id'])); ?>									
                                     
								</td>
							</tr>
							<?php $i++; endforeach; ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
            </div>


