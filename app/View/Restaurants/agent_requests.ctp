<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Agent Requests</h2>						
					</div>
                    
					<div class="box-content"> 
                          Showing Page <?php echo $this->Paginator->counter(); ?>                        	
						<table class="table table-striped table-bordered bootstrap">
						  <thead>                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Agent Name'); ?></th>								  	
								  <th><?php echo __('Phone'); ?></th>
								  <th><?php echo __('Commision'); ?></th>
                                  <th><?php echo __('Documents'); ?></th>
                                  <th><?php echo __('Date'); ?></th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1;
								if(isset($requests)) 
						  	 foreach ($requests as $agt): ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><?php echo h($agt['Agent']['name']); ?></td>								
								<td class="center"><?php echo h($agt['Agent']['phone']); ?></td>
								<td class="center"><?php echo h($agt['AgentRestaurant']['commision']); ?></td>
                                <td class="center"><?php echo h($agt['AgentRestaurant']['commision']); ?></td>
                                <td class="center"><?php echo show_formatted_datetime($agt['AgentRestaurant']['created']); ?></td>
								<td class="center">           
							                                    
                            <a class="btn btn-success" href="<?php echo $this->webroot; ?>restaurants/approve_agent_request/<?php echo $agt['AgentRestaurant']['id']; ?>"><i class="icon-zoom-in icon-white"></i>Approve</a>        
                                                                      
                               <?php echo $this->Form->postLink(__('Deny'), array('action' => 'deny_agent', $agt['AgentRestaurant']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to deny agent request?')); ?>
                                     
								</td>
							</tr>
							<?php $i++; endforeach; ?>
						  </tbody>
					  </table> 
                        <section class="paging_sec">
		<?php 
		echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 	 |	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
     <?php echo $this->Js->writeBuffer();?>
	</section>                    
					</div>
				</div><!--/span-->			
			</div><!--/row-->
          </div>