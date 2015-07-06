<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo 'Agent - Linked Restaurant(s)'; ?></h2>						
					</div>                    
					<div class="box-content">                    	
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Business Name'); ?></th>
								  <th><?php echo __('Email'); ?></th>	
								  <th><?php echo __('City'); ?></th>
								  <th><?php echo __('Country'); ?></th>
                                  <th><?php echo __('Status'); ?></th>								  
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
								
						  	 	foreach ($restaurant as $rest): ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><?php echo h($rest['Restaurant']['restaurant_name']); ?></td>
								<td class="center"><?php echo h($rest['Restaurant']['User']['email']); ?></td>
								<td class="center"><?php echo h($rest['Restaurant']['City']['city_name']); ?></td>
								<td class="center"><?php echo h($rest['Restaurant']['Country']['country_name']); ?></td>
                                <td class="center"><?php if($rest['Restaurant']['User']['user_status']=='1') echo __('Active'); else echo __('Inactive'); ?></td>								
							</tr>
							<?php $i++; endforeach; ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->			
			</div><!--/row-->
         </div>