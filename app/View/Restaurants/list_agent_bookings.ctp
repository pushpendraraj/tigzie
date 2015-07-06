<div id="content" class="span10"> 
<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Menu List</h2>			
					</div>
                    <div class="box-content">
                             Showing Page <?php echo $this->Paginator->counter(); ?>
                            <table class="table table-striped table-bordered">
						          <thead>                         
							       <tr>
								   <th><?php echo __('Order Id'); ?></th>
                                   <th><?php echo __('Customer Name'); ?></th>
                                   <th><?php echo __('Order Details'); ?></th>	
                                   <th><?php echo __('Total Cost(Czk)'); ?></th>	
                                   <th><?php echo __('Order Date'); ?></th>	
                                   <th><?php echo __('Booked By'); ?></th>
                                   <th><?php echo __('Commision %'); ?></th>
                                   <th><?php echo __('Total Commision(Czk)'); ?></th>	
                                   <th><?php echo __('Delivery Type'); ?></th>	
                                   <th><?php echo __('Status'); ?></th>	
                                   <th><?php echo __('Action'); ?></th>			 
							  </tr>
						  </thead>   
						  <tbody id="test" class="tbody">
                            <?php
						  	if(!empty($order)){	
						  	 	foreach ($order as $od){ ?>
									<tr><td><?php echo $od['Order']['order_id']; ?>
                                	<?php $oid=$od['Order']['order_id']; ?></td>
                            		<td><?php echo $od['Customer']['first_name']?>&nbsp;<?php echo $od['Customer']['last_name']; ?></td>
                             		<td><table>
                                    <tr><th>Menu</th><th>Quantity</th></tr><?php foreach($od['OrderDetail'] as $itemkey){ 
								 	if(!empty($itemkey['Menu']['title'])){?>
								     	<tr><td><?php echo $itemkey['Menu']['title'];?></td><td><?php echo $itemkey['quantity'];?></td></tr><?php
								 }//pr($itemkey);
		                              }?>
							    </table></td>
						        <td><?php echo $od['Order']['total_cost'];?><?php $total_cost=$od['Order']['total_cost'];?></td>
                                <td><?php echo $od['Order']['order_date']?></td>
                                <td><?php echo $od['Order']['booked_by']?></td>
                                <td><?php echo $agcomm['AgentRestaurant']['commision']?><?php $comm_per=$agcomm['AgentRestaurant']['commision'];?></td>
                                <td><?php $total_comm=($total_cost*$comm_per)/100; echo $total_comm;?></td>
                                <td><?php echo $od['Order']['delivery_type']?></td>
                                <td><label class=lbl_<?php echo $od['Order']['order_id']; ?>><?php echo $od['Order']['order_status']?></label></td>
                                <td width><?php $status=array('1'=>'processing','2'=>'delivered');
								echo $this->form->input('status',array('label'=>false,'options'=>$status,'id'=>'status_'.$oid,'onchange'=>'change_status(this.value,'.$oid.')','style'=>'width:130px'));
								?>
							     </td>
							     </tr>
							<?php  } }
							else{
							echo "no record found";}?>
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

  <script type="text/javascript">
  function change_status(val,val1){
       $('.lbl_'+val1).html('<img src="<?php  echo $this->webroot;?>img/ajax-loaders/loading.gif" class="loading-image" />');
	  $.post('<?php echo $this->webroot;?>restaurants/edit/'+val+'/'+val1,function(data){
      		$('.lbl_'+val1).html(data);
		  });
	}
  function change_order(val)
  	{
	  $.post('<?php echo $this->webroot;?>restaurants/filter_orders/'+val+'',function(data){
	  	 $('#test').html(data); })
  }
  </script>
