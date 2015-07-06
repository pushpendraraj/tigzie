<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> My Agents</h2>
						
					</div>
                    
					<div class="box-content">
                    	
						<table class="table table-striped table-bordered bootstrap">
						  <thead>
                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Agent Name'); ?></th>								  	
								  <th><?php echo __('Phone'); ?></th>
								  <th><?php echo __('Commission %'); ?></th>
                                   <th><?php echo __('Approval Date'); ?></th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
						  	 foreach ($myagents as $agt): ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><?php echo h($agt['Agent']['name']); ?></td>								
								<td class="center"><?php echo h($agt['Agent']['phone']); ?></td>
								<td class="center"><?php echo h($agt['AgentRestaurant']['commision']); ?></td>
                                       <td class="center"><?php echo show_formatted_datetime($agt['AgentRestaurant']['approval_date']); ?></td>
								<td class="center">
                                
							
                                    
                                   <!-- <a class="btn btn-success" href="<?php echo $this->webroot; ?>admin/restaurants/view/<?php echo $rest['Restaurant']['id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>-->
                                       <?php echo $this->Form->postLink(__('view booking'), array('action' => 'list_agent_bookings', $agt['AgentRestaurant']['agent_id']), array('class'=>'btn btn-success')); ?>
                                        <a class="btn btn-info" href="<?php echo $this->webroot; ?>restaurants/set_commision/<?php echo $agt['AgentRestaurant']['id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
                                     <?php echo $this->Form->postLink(__('Commission Summary'), array('action' => 'commission_summary', $agt['AgentRestaurant']['agent_id']), array('class'=>'btn btn-success')); ?> 
								</td>
							</tr>
							<?php $i++; endforeach; ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
            </div>