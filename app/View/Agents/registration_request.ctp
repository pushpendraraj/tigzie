<div id="content" class="span10">			
		<?php echo $this->element('adminBreadcrumb'); ?>
		<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Registration Request - <?php echo $restaurant['Restaurant']['restaurant_name']; ?></h2>						
					</div>
                    
					<div class="box-content">
                   		<?php echo $this->Form->create('Request',array('type'=>'file','url'=>array('controller'=>'agents','action'=>'send_registration_request'),'method'=>'post','class'=>'form-horizontal none')); ?>
						
                       <?php echo $this->Form->input('restaurant_id',array('type'=>'hidden','value'=>$restaurant['Restaurant']['id'])); 
					   		echo $this->Form->input('agent_id',array('type'=>'hidden','value'=>$agent_id)); 	
					   
					   ?>                                                                                         
                          <div class="control-group">
                           	  <?php echo $this->Form->label('commision','Commision (in %)',array('class'=>'control-label')); 
							  		echo $this->Form->input('commision',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                          </div>                          
                                                 
                       <div class="control-group">
                           <?php echo $this->Form->label('message','Message',array('class'=>'control-label')); 
                                echo $this->Form->input('message',array('type'=>'textarea','class'=>'cleditor','div'=>'controls','maxlength'=>'500','label'=>false)); ?>                       </div>
                            
                         <div class="control-group">
                           	<div class="">   
                               <label class="checkbox inline">
                                <div id="uniform-inlineCheckbox" class="checker">
                                <?php echo $this->Form->checkbox('terms',array('hiddenField'=>false,'class'=>'validate[required]')); ?>
                                 </div>
                                I agree with <a href="javascript://" onclick="">terms &amp; conditions</a> of restaurant.                          
                                 </label>                            
                             </div>      
                         </div>                        
                                                  
                        <div class="form-actions none">
                          <button type="submit" class="btn btn-primary">Send Request</button>
                          <button type="reset" class="btn">Reset</button>                          
                        </div>
                        
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>            
    </div>    
    
<script type="text/javascript">

$(document).ready(function(e) {
    $("#RequestRegistrationRequestForm").validationEngine({promptPosition: "topRight"});
});

</script>            