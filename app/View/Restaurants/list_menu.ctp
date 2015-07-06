<div class="portlet">
	<h3 class="portlet-title">
       	<u>List Menu</u>
	</h3>
    <div class="portlet-body">
		<div role="grid" class="dataTables_wrapper form-inline" id="table-1_wrapper">
        	<div class="row dt-rt"><div class="col-sm-6"></div>
        		<div class="col-sm-6">
        			<div class="dataTables_filter" id="table-1_filter"><label><input type="text" aria-controls="table-1"></label></div>
                </div>
            </div>
            <table id="table-1" class="table table-striped table-bordered dataTable" aria-describedby="table-1_info">
            <thead>
              <tr role="row">
              <?php if(isset($menu)){  ?>
                <th>S.No.</th>
                <th><?php echo __('Title'); ?></th>
                <th><?php echo __('Category Name'); ?></th>
                <th><?php echo __('Price'); ?></th>						 
                <th>Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tfoot>
              <tr>
              	<th>S.No.</th>
                   <th><?php echo __('Title'); ?></th>
                   <th><?php echo __('Category Name'); ?></th>
                   <th><?php echo __('Price'); ?></th>						 
                  <th>Action</th>
                  </tr>
            </tfoot>
          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php $start = $this->Paginator->counter(array('format' => '%start%')); ?> 
           <?php
						  		 
							if(!empty($menu)){	
						  	 foreach ($menu as $mn){ ?>
							<tr>
                            	<td><?php echo $start; ?></td>
								<td><?php echo $mn['Menu']['title']; ?></td>
                                <td><?php echo $mn['MenuCategory']['name']; ?></td>
                                <td><?php echo $mn['Menu']['price']; ?></td>
							
                                 <td>  
                                 
                                 <a class="btn btn-info" href="<?php echo $this->webroot; ?>restaurants/edit_menu/<?php echo $mn['Menu']['id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a> 
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_menu_item', $mn['Menu']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete menu Item # %s?', $mn['Menu']['id'])); ?>
									
                                     
								</td>
							</tr>
							<?php $start++; } }?>
          </tbody></table>
          <div class="row dt-rb"><div class="col-sm-6">
          	<div class="dataTables_info" id="table-1_info">Showing pages <?php echo $this->Paginator->counter(); ?></div></div><div class="col-sm-6">
          		<div class="dataTables_paginate paging_bootstrap">
                    <ul class="pagination">
                        <li class="prev disabled">
                        	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
                        </li>
                        <li class="next disabled">
                            <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
                        </li>
                    </ul>
                    </div>
            	</div>
			</div>
		</div>
	</div> <!-- /.portlet-body -->
</div>
<?php // echo '<pre>'; print_r($this->Paginator); ?>




