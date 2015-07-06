<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Edit Menu</h2>
						
					</div>
					<div class="box-content">
                   		<?php echo $this->Form->create('Menu',array('type'=>'file','url'=>array('controller'=>'restaurants','action'=>'add_menu'),'method'=>'post','class'=>'form-horizontal none')); ?>
						
                       <?php 
					   echo $this->Form->input('Menu.id',array('type'=>'hidden'));
					   echo $this->Form->input('Menu.restaurant_id',array('type'=>'hidden')); ?>
                         <input type="hidden" id="num" value="1"/>
                        <div class="control-group">
                           	  <?php echo $this->Form->label('Menu.menucategory_id','Category',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Menu.menucategory_id',array('options'=>$categories,
															'class'=>'input-xlarge validate[required]','div'=>'controls small','label'=>false,'empty'=>'select category')); ?>       
                              
                          </div>
                                                 
                           <div class="control-group">
                           	  <?php echo $this->Form->label('Menu.title','Title',array('class'=>'control-label')); 
							  		echo $this->Form->input('Menu.title',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Menu.price','Price (in '.$restaurant['Restaurant']['currency'].')',array('class'=>'control-label')); 
							  		echo $this->Form->input('Menu.price',array('type'=>'text','class'=>'input-xlarge validate[required,custom[number]]','div'=>'controls','label'=>false)); ?>                               
                          </div>
                          
                           <div class="control-group">
							   <?php echo $this->Form->label('Menu.description','Description',array('class'=>'control-label')); 
							  		echo $this->Form->input('Menu.description',array('type'=>'textarea','class'=>'cleditor','div'=>'controls','label'=>false)); ?>       
							 
							</div>
                          
                         <div class="control-group up_1">
                           <label class="control-label">Image</label>
                           	<div class="controls">
                           	  <?php echo $this->Form->input('Docs.1.menu',array('type'=>'file','size'=>19,'label'=>false,'div'=>false,'class'=>'no_uniform')); ?>                               
                             </div>                             
                          </div>
                          <div style="padding-bottom: 32px; width: 44%;"><a href="javascript://" onclick="add_more();" style="float:right;">Add More</a></div>
                          
							<div class="form-actions none">
							  <button type="submit" class="btn btn-primary">Save</button>
							  <button type="reset" class="btn">Reset</button>
                              
							</div>
						 <?php echo $this->Form->end(); ?> 
						
                        
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
								<td><img src="<?php echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/thumb/'.'thumb_'.$mn['name']; ?>"/></td>
							
                                 <td>   
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_menu_item_image', $mn['id'],$this->data['Menu']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete menu item image # %s?', $mn['id'])); ?>
									
                                     
								</td>
							</tr>
							<?php $i++; }} ?>
						  </tbody>
					  </table>            
					</div>
                        
					</div>
				</div><!--/span-->

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




