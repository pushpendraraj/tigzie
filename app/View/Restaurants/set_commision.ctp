<div id="content" class="span10">
<?php echo $this->element('adminBreadcrumb'); ?>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> My Agents</h2>
						
					</div>
                     <?php echo $this->Session->flash(); ?>
					<div class="box-content">
                    	<?php echo $this->Form->create('AgentRestaurant',array('type'=>'file','method'=>'post','class'=>'form-horizontal none'));  
			  echo $this->Form->input('AgentRestaurant.id',array('type'=>'hidden'));
					   
					   ?>                                                                                         
                          <div class="control-group">
                           	  <?php echo $this->Form->label('AgentRestaurant.commision','Set Commision for agent (in %)',array('class'=>'control-label')); 
							  		echo $this->Form->input('AgentRestaurant.commision',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                          </div>          
                                       <div class="form-actions none">
                          <button type="submit" class="btn btn-primary">Save </button>                          
                        </div>
                        
						<?php echo $this->Form->end(); ?>
                      
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
 </div>