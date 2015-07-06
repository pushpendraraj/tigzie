<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Profile</h2>						
					</div>
					<div class="box-content">
                    <div><?php echo $this->Session->flash(); ?></div>
                   
				   <?php echo $this->Form->create('Agent',array('type'=>'file','url'=>array('controller'=>'agents','action'=>'profile'),'method'=>'post','class'=>'form-horizontal none')); 
					   echo $this->Form->input('Agent.id',array('type'=>'hidden'));
					   ?>
                         <input type="hidden" id="num" value="1"/>
                        <div class="control-group">
                           	  <?php echo $this->Form->label('Agent.name','Name',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Agent.name',array('type'=>'text',
															'class'=>'validate[required]','div'=>'controls small','label'=>false)); ?>  
                         </div>
                                                 
                         <div class="control-group">
                           	  <?php echo $this->Form->label('User.username','Username',array('class'=>'control-label')); 
							  		echo $this->Form->input('User.username',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false,'disabled'=>'disabled')); ?>       
                         </div>
                          
                         <div class="control-group">
                           	  <?php echo $this->Form->label('User.email','Email',array('class'=>'control-label')); 
							  		echo $this->Form->input('User.email',array('type'=>'text','class'=>'input-xlarge validate[required,custom[email]]','div'=>'controls','label'=>false,'disabled'=>'disabled')); ?>       
                         </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Agent.phone','Phone',array('class'=>'control-label')); 
							  		echo $this->Form->input('Agent.phone',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>                               
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Country.country_name','Country',array('class'=>'control-label')); 
							  		echo $this->Form->input('Country.country_name',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false,'disabled'=>'disabled')); ?>                               
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('City.city_name','City',array('class'=>'control-label')); 
							  		echo $this->Form->input('City.city_name',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false,'disabled'=>'disabled')); ?>                               
                          </div>
                           <div class="control-group">
                           	  <?php echo $this->Form->label('Agent.ppl_acc','Paypal id',array('class'=>'control-label')); 
							  		echo $this->Form->input('Agent.ppl_acc',array('type'=>'text','div'=>'controls','label'=>false)); ?>                               
                          </div>
                                                      
                         <div class="control-group up_1">
                           <label class="control-label">Document</label>
                            <div class="controls">
                           <?php echo $this->Form->input('Docs.1.docs',array('type'=>'file','size'=>19,'label'=>false,'div'=>false,'class'=>'no_uniform')); ?>                             
                             </div>                             
                          </div>
                         <div style="padding-bottom: 32px; width: 44%;"><a href="javascript://" onclick="add_more();" style="float:right;">Add More</a></div>
                          
                        <div class="form-actions none">
                          <button type="submit" class="btn btn-primary">Update</button>
                          
                          
                        </div>
						 <?php echo $this->Form->end(); ?>						
                        
                        <div class="box-content">                    	
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>                         
							  <tr>
                              	  <th>S.No.</th>
								  <th><?php echo __('Document'); ?></th>
                                  <th><?php echo __('Upload Date'); ?></th>								 
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  		$i=1; 
							if(!empty($docs)){	
						  	 foreach ($docs as $dc){ ?>
							<tr>
                            	<td><?php echo $i; ?></td>
								<td><?php $dname=explode("_",$dc['name']); unset($dname[0]); echo implode($dname); ?></td>
								<td><?php echo show_formatted_datetime($dc['created']); ?></td>
                                 <td>   
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_doc', $dc['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete document # %s?', $dc['id'])); ?>
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
    $("#AgentProfileForm").validationEngine({promptPosition: "topRight"});
});

function add_more(){
	var num=$('#num').val();
	num=parseInt(num)+1;
	$('.control-group').last().after('<div class="control-group up_'+num+'"><label class="control-label">Document</label><div class="controls"><input type="file" id="Docs'+num+'Menu" size="19"  name="data[Docs]['+num+'][docs]" class="no_uniform">&nbsp;&nbsp;<a href="javascript://" onclick="remove_div('+num+');">Remove</a> </div></div>');
	$('#num').val(num);	
	$("input:file").not('.no_uniform').uniform();
}

function remove_div(num){
	$('.up_'+num).remove();	
}
</script>            