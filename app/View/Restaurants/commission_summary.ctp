<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>&nbsp;<?php echo $myagents['Agent']['name']; ?></h2>
						</div>
                    <div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap">
						    <thead>
                         		<tr>
                                <th><?php echo __('Total Bookings made'); ?></th>
                                <th><?php echo __('Total Customer booked'); ?></th>
								<th><?php echo __('Commission %'); ?></th>
                                <th><?php echo __('Total Commission '); ?></th>
                                </tr>
						    </thead>   
						  <tbody>
                          <?php
				
						  	if(isset($myagents)){ ?>
								<tr>
                                <td class="center"><?php echo h($total_booked); ?></td>
                                <td class="center"><?php echo h($total_cus_booked); ?></td>
								<td class="center"><?php echo h($myagents['AgentRestaurant']['commision']); ?></td>
                                <td class="center"><?php $total_comm=0;
								foreach($comm_summary as $cm){
									$total_comm=$total_comm+($cm['Order']['total_cost']);}
									$total_comm=($total_comm*($myagents['AgentRestaurant']['commision']))/100;
									echo h($total_comm); ?></td>
							</tr>
							<?php }?>
						  </tbody>
					  </table>            
					</div>
                    <div class="box-header well" data-original-title>
						<h2>Paypal Details:</h2>
                        </div>
                        <br>
                        <div class="box-content">
                         <div class="form-horizontal " >
                         	<table class="table table-striped table-bordered bootstrap">
                             <thead>
                         		<tr>
                                <th><?php echo __('Agent Name'); ?></th>
                                <th><?php echo __('Email Id'); ?></th>
								<th><?php echo __('Paypal id'); ?></th>
                                </tr>
						    </thead>   
						  <tbody>
                     		<tr><td><?php echo $myagents['Agent']['name']; ?></td>
                            <td><?php echo $usr['User']['email']; ?></td>
                            <td><?php echo $myagents['Agent']['ppl_acc']; ?></td>
                            </table>    
                             </div >
				</div>
                  <!--/span-->
			</div>
			<!--/row-->
            </div>
            </div>
            