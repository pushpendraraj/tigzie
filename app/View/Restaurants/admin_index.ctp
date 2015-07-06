<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable"><div style="color:#F00; padding:10px; text-align:center;"><?php echo $this->Session->flash(); ?></div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Restaurants</h2>
						
					</div>
                    
					<div class="box-content">
                    	Showing Page <?php echo $this->Paginator->counter();
						$start = $this->Paginator->counter(array('format' => '%start%')); ?> 
						<table class="table table-striped table-bordered bootstrap">
						  <thead>
                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Business Name'); ?></th>
								  <th><?php echo __('Email'); ?></th>	
								  <th><?php echo __('City'); ?></th>
								  <th><?php echo __('Country'); ?></th>
                                  <th><?php echo __('Status'); ?></th>
                                  <th>Other Options</th>
								  <th>Action</th>
                                  </tr>
						  </thead>   
						  <tbody>
                          <?php 
						  	 foreach ($restaurants as $rest): ?>
							<tr>
                            	<td><?php echo $start;; ?></td>
								<td><?php echo h($rest['Restaurant']['restaurant_name']); ?></td>
								<td class="center"><?php echo h($rest['User']['email']); ?></td>
								<td class="center"><?php echo h($rest['City']['city_name']); ?></td>
								<td class="center"><?php echo h($rest['Country']['country_name']); ?></td>
                               
                                <td class="center">
                                	
									<?php if($rest['User']['user_status']=='1') echo __('Active'); else echo __('Inactive'); ?></td>
								<td class="center">
                                
							
                                    
                                   <!-- <a class="btn btn-success" href="<?php echo $this->webroot; ?>admin/restaurants/view/<?php echo $rest['Restaurant']['id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>-->
									
                            <a class="btn <?php if($rest['Restaurant']['most_loved']=='Yes') echo 'btn-success'; else echo 'btn-danger'; ?>" href="<?php echo $this->webroot; ?>restaurants/update_most_loved/<?php echo $rest['Restaurant']['id'].'/';  if($rest['Restaurant']['most_loved']=='Yes') echo '0'; else echo '1';?>">
                               <?php if($rest['Restaurant']['most_loved']=='Yes') echo 'Remove Most Booked'; else echo 'Make Most Booked'; ?>                                           
                            </a><br><br>
                             <a class="btn <?php if($rest['Restaurant']['best_seller']=='Yes') echo 'btn-success'; else echo 'btn-danger'; ?>" href="<?php echo $this->webroot; ?>restaurants/update_best_seller/<?php echo $rest['Restaurant']['id'].'/';  if($rest['Restaurant']['best_seller']=='Yes') echo '0'; else echo '1';?>">
                               <?php if($rest['Restaurant']['best_seller']=='Yes') echo 'Remove Best Rated'; else echo 'Make Best Rated'; ?>                                           
                            </a><br><br>
                            <a class="btn <?php if($rest['Restaurant']['popular_this_week']=='Yes') echo 'btn-success'; else echo 'btn-danger'; ?>" href="<?php echo $this->webroot; ?>restaurants/update_popular_this_week/<?php echo $rest['Restaurant']['id'].'/';  if($rest['Restaurant']['popular_this_week']=='Yes') echo '0'; else echo '1';?>">
                               <?php if($rest['Restaurant']['popular_this_week']=='Yes') echo 'Special This Week'; else echo 'Special This Week'; ?>                                           
                            </a>
                            </td>
                            <td class="center">
                                    
                                    <a class="btn btn-info" href="<?php echo $this->webroot; ?>admin/restaurants/edit/<?php echo $rest['Restaurant']['id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
                                    
                                    <a class="btn btn-warning" href="<?php echo $this->webroot; ?>admin/restaurants/update_status/<?php echo $rest['Restaurant']['id']; ?>/<?php if($rest['User']['user_status']=='1') echo 0; else echo 1;?>">
										 
										<?php if($rest['User']['user_status']=='1') echo __('Deactivate'); else echo __('Activate');?>
									</a>
                                    
                                    
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rest['Restaurant']['id'],'admin'=>true), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $rest['Restaurant']['id'])); ?>
									
                                     
								</td>
							</tr>
							<?php $start++; endforeach; ?>  
						  </tbody>
					  </table>
                       <section class="paging_sec">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 	 |	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</section>                
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
            </div>


