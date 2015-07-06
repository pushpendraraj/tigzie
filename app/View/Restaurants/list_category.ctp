<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Category List</h2>						
					</div>
                    
					<div class="box-content">
                    Showing Page <?php echo $this->Paginator->counter(); ?>
                    <?php $start = $this->Paginator->counter(array('format' => '%start%')); ?>                       	
						<table class="table table-striped table-bordered bootstrap-datatable ">
						  <thead>                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Category Name'); ?></th>
                                
                                							 
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
							if(!empty($category)){	
						  	 foreach ($category as $cg){ ?>
							<tr>
                            	<td><?php echo $start; ?></td>
								<td><?php echo $cg['MenuCategory']['name']; ?></td>
                                 <td>  
                                 
                                 <a class="btn btn-info" href="<?php echo $this->webroot; ?>restaurants/edit_category/<?php echo $cg['MenuCategory']['id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a> 
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_category_item', $cg['MenuCategory']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete menu Item # %s?', $cg['MenuCategory']['id'])); ?>
									
                                     
								</td>
							</tr>
								<?php $start++; } }?>
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


