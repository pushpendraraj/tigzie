<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Linked Restaurant(s)</h2>						
					</div>
                    
					<div class="box-content">                    	
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Business Name'); ?></th>
								  <th><?php echo __('Commision'); ?></th>
                                  
								  <th><?php echo __('Approval Date'); ?></th>
								  
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
						  		 foreach ($request as $rest): ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><?php echo h($rest['Restaurant']['restaurant_name']); ?></td>
								<td class="center"><?php echo h($rest['AgentRestaurant']['commision']); ?></td>								
								<td class="center"><?php if(!empty($rest['AgentRestaurant']['approval_date'])) echo show_formatted_datetime($rest['AgentRestaurant']['approval_date']); ?></td>                            								
							</tr>
							<?php $i++; endforeach; ?>
						  </tbody>
					  </table>            
					</div>
				</div>			
			</div>
            </div>


