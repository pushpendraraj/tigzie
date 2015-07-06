<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Restaurant Profile</h2>
						
					</div>
					<div class="box-content">
                   		<?php echo $this->Form->create('Restaurant',array('type'=>'file','url'=>array('controller'=>'restaurants','action'=>'profile_edit'),'method'=>'post','class'=>'form-horizontal none')); ?>
						
                        <?php echo $this->Form->input('Restaurant.id',array('type'=>'hidden')); ?>
                        
                          <div class="form-actions">
                          	<h2>Basic Details</h2>
                          </div>
                          
                           <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.restaurant_name','Business Name',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.restaurant_name',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                                                   
                          <div class="control-group">
                           	  <?php 
                           	  $selectedVal=explode(',', $this->Form->value('type'));
                           	  echo $this->Form->label('Restaurant.type','Type of Business',array('class'=>'control-label')); 							  		
							  echo $this->Form->input('Restaurant.type.',array('options'=>array('Restaurant'=>'Restaurant',
																					'Bar'=>'Bar',
																					'Cafe'=>'Cafe',
																					'Event'=>'Event'),
															'class'=>'validate[required]',
															'div'=>'controls small','label'=>false,'multiple',
							  								'selected'=>$selectedVal)); ?>       
                      </div>
                          
                          <?php if(!empty($this->request->data['Restaurant']['logo'])){ ?>
                          <div class="control-group">
                          <div class="controls small">
                          	<img src="<?php echo $this->webroot; ?>files/<?php echo $this->request->data['Restaurant']['id'].'/thumb/thumb_'.$this->request->data['Restaurant']['logo']; ?>"/>
                              <?php echo $this->Form->input('Restaurant.logo_old',array('type'=>'hidden','value'=>$this->request->data['Restaurant']['logo'])); ?>
                            </div>
                          </div>
                          <?php } ?>
                           
                           <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.logo','Restaurant Logo',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.logo',array('type'=>'file','class'=>'no_uniform','div'=>'controls small','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.currency','Currency',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.currency',array('options'=>array('CZK'=>'Czech Republic Koruna (CZK)',
																					'GBP'=>'British Pound (GBP)',
																					'USD'=>'US Dollar (USD)'),
															'class'=>'validate[required]','div'=>'controls small','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.country_id','Country',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.country_id',array('options'=>$countries,
															'class'=>'validate[required]','div'=>'controls small','label'=>false,'onchange'=>'get_cities(this.value);')); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.city','City',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.city_id',array('options'=>$cities,'class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false,'id'=>'cities','onchange'=>'check_other_city(this.value);')); ?>       
                              
                          </div>
                          
                          <div class="control-group city_div" style="display:none;">
                           	  <?php echo $this->Form->label('Restaurant.city_other','Specify City Name',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.city_other',array('type'=>'text','class'=>'','div'=>'controls small','label'=>false,'id'=>'cities_other')); ?>                             
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.street','Street',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.street',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.street_no','Street No.',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.street_no',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.zip_code','Zip Code',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.zip_code',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.phone','Phone',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.phone',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.website','Website',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.website',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="form-actions">
                          	<h2>Other Details</h2>
                          </div>
                          
                         <div class="control-group">
                         <label class="control-label">Facilities: </label>
                         	<div class="">                            
                            <?php foreach($facilities as $fc){ ?>
                                <label class="checkbox inline">
                                <div id="uniform-inlineCheckbox1" class="checker">
                                <?php echo $this->Form->checkbox('Facility.'.$fc['Facility']['id'],array('hiddenField'=>false)); ?>
                                 </div>
                                <?php 	echo $fc['Facility']['name']; ?>                           
                                 </label>
                            <?php } ?>
                             
                             </div>      
                         </div>
                         
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.cuisines','Cuisines',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.cuisines',array('type'=>'text','class'=>'input-xlarge','div'=>'controls','label'=>false)); ?>         
                              
                          </div>
                          
                           <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.cost','Cost',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.cost',array('type'=>'text','class'=>'input-xlarge','div'=>'controls','label'=>false)); ?>         
                              
                          </div>
                          
                           <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.opening_hours','Opening Hours',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.opening_hours',array('class'=>'small','div'=>'controls','label'=>false)); ?>         
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.closing_hours','Closing Hours',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.closing_hours',array('class'=>'small','div'=>'controls','label'=>false)); ?>         
                              
                          </div>
                          
                           <div class="control-group">
                           <?php echo $this->Form->label('Restaurant.terms_for_customers','Terms &amp; Conditions for Customers',array('class'=>'control-label')); 
                                echo $this->Form->input('Restaurant.terms_for_customers',array('type'=>'textarea','class'=>'cleditor','div'=>'controls','maxlength'=>'500','label'=>false)); ?> 
                            </div>
                                
                           <div class="control-group">
                           <?php echo $this->Form->label('Restaurant.terms_for_agents','Terms &amp; Conditions for Agents',array('class'=>'control-label')); 
                                echo $this->Form->input('Restaurant.terms_for_agents',array('type'=>'textarea','class'=>'cleditor','div'=>'controls','maxlength'=>'500','label'=>false)); ?>                </div>    
                          
                         <div class="control-group">
                           <label class="control-label">Payment Options: </label>
                         	<div class="">                            
                            <?php foreach($payment_options as $po){ ?>
                                <label class="checkbox inline">
                                <div id="uniform-inlineCheckbox1" class="checker">
                                <?php echo $this->Form->checkbox('PaymentOption.'.$po['PaymentOption']['id'],array('hiddenField'=>false)); ?>
                                 </div>
                                <?php 	echo $po['PaymentOption']['name']; ?>                           
                                 </label>
                            <?php } ?>
                             
                             </div>      
                         </div>
                         
                         <div class="control-group">
                           <label class="control-label">Tags: </label>
                         	<div class="">                            
                            <?php foreach($tags as $tg){ ?>
                                <label class="checkbox inline">
                                <div id="uniform-inlineCheckbox1" class="checker">
                                <?php echo $this->Form->checkbox('Tags.'.$tg['Tags']['id'],array('hiddenField'=>false)); ?>
                                 </div>
                                <?php 	echo $tg['Tags']['name']; ?>                           
                                 </label>
                            <?php } ?>
                             
                             </div>      
                         </div>
                         
                         <div class="control-group">
                           <?php echo $this->Form->label('Restaurant.block_1_text','Block 1 (Title/Text)',array('class'=>'control-label')); 
                                echo $this->Form->input('Restaurant.block_1_text',array('type'=>'textarea','class'=>'cleditor','div'=>'controls','maxlength'=>'500','label'=>false)); ?> 
                           </div>
                           
                           <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.block_1_image','Block 1 Image',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.block_1_image',array('type'=>'file','class'=>'no_uniform','div'=>'controls small','label'=>false)); ?>                              
                          </div> 
                            
                           <div class="control-group">
                           <?php echo $this->Form->label('Restaurant.block_2_text','Block 2 (Title/Text)',array('class'=>'control-label')); 
                                echo $this->Form->input('Restaurant.block_2_text',array('type'=>'textarea','class'=>'cleditor','div'=>'controls','maxlength'=>'200','label'=>false)); ?> 
                            </div> 
                            
                             <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.block_2_link','Block 2 Link',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.block_2_link',array('type'=>'text','class'=>'input-xlarge validate[custom[url]]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                            
                            <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.block_2_image','Block 2 Image',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.block_2_image',array('type'=>'file','class'=>'no_uniform','div'=>'controls small','label'=>false)); ?>                              
                          </div> 
                            
                            <div class="control-group">
                           <?php echo $this->Form->label('Restaurant.block_3_text','Block 3 (Title/Text)',array('class'=>'control-label')); 
                                echo $this->Form->input('Restaurant.block_3_text',array('type'=>'textarea','class'=>'cleditor','div'=>'controls','maxlength'=>'200','label'=>false)); ?> 
                            </div> 
                            
                             <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.block_3_link','Block 3 Link',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.block_3_link',array('type'=>'text','class'=>'input-xlarge validate[custom[url]]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                            
                            <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.block_3_image','Block 3 Image',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.block_3_image',array('type'=>'file','class'=>'no_uniform','div'=>'controls small','label'=>false)); ?>                              
                           </div> 
                          
							<div class="form-actions none">
							  <button type="submit" class="btn btn-primary">Save</button>
                              
							</div>
						 <?php echo $this->Form->end(); ?> 

					</div>
				</div><!--/span-->

			</div>
            
    </div>        
<script type="text/javascript">

$(document).ready(function(e) {
     $("#RestaurantProfileEditForm").validationEngine({promptPosition: "topRight"});
});

function get_cities(country){
	if(country!=''){
		$.post('<?php echo $this->webroot; ?>users/get_cities',{country_code:country},function(data){
			$('#cities').html(data);	
		});	
	}	
}

function check_other_city(val){
	if(val=='others'){
		//$('#cities').val('');
		$('#cities').removeClass('validate[required]');
		$('#cities_other').addClass('validate[required]');
		$('.city_div').show();	
	}else{
		$('#cities_other').removeClass('validate[required]');
		$('#cities').addClass('validate[required]');
		$('.city_div').hide();	
	}	
}

</script>




