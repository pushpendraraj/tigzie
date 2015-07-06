<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Commision Details</h2>
						
					</div>
					<div class="box-content">
                    	
						<table class="table table-striped table-bordered bootstrap">
						  <thead>
                         
							  <tr>
                              	
								  <th><?php echo __('Order Id'); ?></th>							  	
								  <th><?php echo __('Total'); ?></th>
								  <th><?php echo __('% commision'); ?></th>
                                   <th><?php echo __('Total commision'); ?></th>
                                  <th><?php echo __('Order Detail'); ?></th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		
					$i=0;if(!empty($myagents)){
						  	 foreach ($myagents as $agt): ?><?php
							  ?>
							<tr>
                            	
								<td><?php echo h($agt['Order']['order_id']); ?></td>							
								<td class="center"><?php echo h($agt['Order']['total_cost']);$total=$agt['Order']['total_cost'] ?></td>
                                <td class="center"><?php echo h($agcomm['AgentRestaurant']['commision']); ?>%<?php $commision=$agcomm['AgentRestaurant']['commision'] ?></td>
                                <td class="center"><?php $totalcomm=($total*$commision)/100; echo $totalcomm;  ?></td>
                                <td class="center"><table><tr><td><?php echo __('Customer Name'); ?></td><td><?php echo h($agt['Customer']['first_name']) ; echo " " ;echo h($agt['Customer']['last_name']); ?></td></tr><tr><td><?php echo __('Restaurant Name'); ?></td><td><?php echo h($agt['Restaurant']['restaurant_name']); ?></td></tr></table></td>
							</tr>
							<?php $i++; endforeach; }
							else {
								echo "<tr>"; echo "<td colspan=5>"; echo "no record found"; echo "</td>"; echo "</tr>" ;}?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
            </div>