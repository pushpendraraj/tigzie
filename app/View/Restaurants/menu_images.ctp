<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Menu Images</h2>						
					</div>
                    
					<div class="box-content">                    	
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Image'); ?></th>								 
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
							if(!empty($menu)){	
						  	 foreach ($menu as $mn){ ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><img src="<?php echo $this->webroot.'files/'.$restaurant_id.'/thumb/'.'thumb_'.$mn['Docs']['name']; ?>"/></td>
							
                                 <td>   
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_menu_image', $mn['Docs']['id'],1), array('class'=>'btn btn-danger'), __('Are you sure you want to delete menu image # %s?', $mn['Docs']['id'])); ?>
									
                                     
								</td>
							</tr>
							<?php $i++; }} ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
            </div>


