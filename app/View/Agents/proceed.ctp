<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Your Order</h2>						
					</div> 
					
				    <div class="box-content">	<?php ?> <?php $i=1; ?>
                    
           <table class="table table-striped table-bordered bootstrap">
           <thead>                         
           <tr>
           <th>S.No.</th>
           <th><?php echo __('Menu Item'); ?></th>
            
            <th>Title</th>							 
            <th>Description</th>
            <th>Quantity</th>
            <th>Total</th>
            <th></th>
            </tr>
            </thead>   
            <tbody>
					<?php echo $this->Form->create('Order',array('url'=>array('controller'=>'agents','action'=>'check_out'),'enctype'=>'multipart-formdata','method'=>'post','class'=>'form-horizontal none')); ?>
                        	<?php if(isset($menu) && !empty($menu)){?>
								<?php $total=0;?>														
								<?php foreach($menu as $mn)
								{	?>
                                <tr>
                            	<td><?php echo $i; ?></td>
								<td><small><img src="<?php  echo $this->webroot.'files/'.$mn['Menu']['restaurant_id'].'/'.$mn['Docs'][0]['name']; ?>" width="50" height="50"</small></td>
								<?php $this->form->input('Order.restaurant_id',array('type'=>'hidden','value'=>$mn['Menu']['restaurant_id'])) ?>
                                <td><?php echo $mn['Menu']['title']; ?></td>
								
                                <td><?php echo wraptext($mn['Menu']['description'],40);?></td>
                                <td><?php echo $items['quantity'][$mn['Menu']['id']]; ?> </td>
                                <?php echo $this->form->input('OrderDetail.'.$mn['Menu']['id'].'.quantity',array('type'=>'hidden','value'=>$items['quantity'][$mn['Menu']['id']])) ?>                 
                                <td><?php  echo $items['total'][$mn['Menu']['id']];$total=$total+$items['total'][$mn['Menu']['id']]; ?></td>
                                <?php echo $this->form->input('OrderDetail.'.$mn['Menu']['id'].'.price',array('type'=>'hidden','value'=>$mn['Menu']['price'])) ?>
                                </tr>
                                <?php $i++; }?>
                                <tr><td colspan="6">Total=<?php echo $total;?>&nbsp; CZK
								<?php echo $this->form->input('Order.total',array('type'=>'hidden','value'=>$total)) ?></td></tr><?php
							} ?>
              	
                   
                          </tbody>
					  </table> 
                       
                        <!--<strong><a href="#">Back to shopping</a></strong>-->
                    <div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Customer Details</h2>						
					</div><br>
                    <div class="form-horizontal">
                    <div class="control-group">
                           	  <?php echo $this->Form->label('Customer.first_name','First Name',array('class'=>'control-label')); 
							  		echo $this->Form->input('Customer.first_name',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Customer.last_name','Last Name',array('class'=>'control-label')); 
							  		echo $this->Form->input('Customer.last_name',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>                              
                          </div>
                            
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Customer.email_id','Email Id',array('class'=>'control-label')); 
							  		echo $this->Form->input('Customer.email_id',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>                              
                          </div>
                               
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Customer.phone_no','Contact no',array('class'=>'control-label')); 
							  		echo $this->Form->input('Customer.phone_no',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>                              
                          </div>
                          
                           <div class="control-group">
							   <?php echo $this->Form->label('Customer.address','address',array('class'=>'control-label')); 
							  		echo $this->Form->input('Customer.address',array('type'=>'textarea','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
							 
							</div>
                            <?php $delivery=array('1'=>'Home Delivery','2'=>'Dine In','3'=>'Take Away'); ?>
                             <div class="control-group">
                           	  <?php echo $this->Form->label('Order.delivery','Delivery',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Order.delivery_type',array('options'=>$delivery,
															'class'=>'validate[required]','div'=>'controls small','label'=>false,'empty'=>'select')); ?>       
                              
                          </div>
                     
                          
                        <div class="form-actions none">
                          <button type="submit" class="btn btn-primary">Place Order</button>
                          <button type="reset" class="btn">Reset</button>
                          
                        </div>
                       <?php echo $this->Form->end(); ?> 
                      </div>
					</div> 
					
           </div>
 </div>
    <script type="text/javascript">

$(document).ready(function(e) {
    $("#MenuAddMenuForm").validationEngine({promptPosition: "topRight"});
});

function add_more(){
	var num=$('#num').val();
	num=parseInt(num)+1;
	$('.control-group').last().after('<div class="control-group up_'+num+'"><label class="control-label">Image</label><div class="controls"><input type="file" id="Docs'+num+'Menu" size="19"  name="data[Docs]['+num+'][menu]" class="no_uniform">&nbsp;&nbsp;<a href="javascript://" onclick="remove_div('+num+');">Remove</a> </div></div>');
	$('#num').val(num);	
	$("input:file").not('.no_uniform').uniform();
}

function remove_div(num){
	$('.up_'+num).remove();	
}
</script>            
           
               


