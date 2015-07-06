<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>
<?php echo $this->Session->flash(); ?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Restaurant Deals</h2>
						
					</div>
                    
					<div class="box-content">
                    	
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo $this->Paginator->sort('Deal.title','Title'); ?></th>
								  <!--<th><?php echo $this->Paginator->sort('Deal.deal_type','Deal Type'); ?></th>	
								  <th><?php echo $this->Paginator->sort('Deal.promo_code','Promocode'); ?></th>-->
								  <th><?php echo $this->Paginator->sort('Deal.discount_type','Discount Type'); ?></th>
                                  <th><?php echo $this->Paginator->sort('Deal.value','Value'); ?></th>
                                  <th><?php echo $this->Paginator->sort('Deal.start_date','Start Date'); ?></th>
                                  <th><?php echo $this->Paginator->sort('Deal.end_date','End Date'); ?></th>
                                  <th><?php echo $this->Paginator->sort('Deal.created','Created On'); ?></th>
								  <th>Action</th>
                                  
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
						  	 foreach ($deals as $dl): ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><?php echo h($dl['Deal']['title']); ?></td>
								<!--<td class="center"><?php echo h($dl['Deal']['deal_type']); ?></td>
								<td class="center"><?php if($dl['Deal']['deal_type']=="discount") echo '-'; else echo h($dl['Deal']['promo_code']); ?></td>-->
								<td class="center"><?php echo h($dl['Deal']['discount_type']); ?></td>
                                <td class="center"><?php echo h($dl['Deal']['value']); ?></td>
                                <td class="center"><?php echo h(show_formatted_date($dl['Deal']['start_date'])); ?></td>
                                <td class="center"><?php echo h(show_formatted_date($dl['Deal']['end_date'])); ?></td>
                                <td class="center"><?php echo h(show_formatted_datetime($dl['Deal']['created'])); ?></td>
                               
                                
								
                            <td class="center">
                                    
                                    <a class="btn btn-info" href="<?php echo $this->webroot; ?>deals/edit_deal/<?php echo $dl['Deal']['id']; ?>">

										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
                                    
                                   
                                    
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_deal', $dl['Deal']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete Deal # %s?', $dl['Deal']['id'])); ?>
									
                                     
								</td>
							</tr>
							<?php $i++; endforeach; ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
            </div>


