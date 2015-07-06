<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i><?php if(isset($data)) echo 'Edit '; else echo 'Add '; ?>Restaurant</h2>
						
					</div>
                    
					<div class="box-content">
                    <div style="color:#F00; padding:10px; text-align:center;"><?php echo $this->Session->flash(); ?></div>
                   		<?php echo $this->Form->create('Restaurant',array('url'=>array('controller'=>'restaurants','action'=>'add','admin'=>true),'enctype'=>'multipart-formdata','method'=>'post','class'=>'form-horizontal none')); ?>
						
                                                 
                           <div class="control-group">
                            <p align="center">&nbsp;(*&nbsp;Required fields)</p>  
                           	  <?php echo $this->Form->label('Restaurant.restaurant_name','Business Name *',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.restaurant_name',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.contact_person_name','Contact Person',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.contact_person_name',array('type'=>'text','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('User.email','Email *',array('class'=>'control-label')); 
							  		echo $this->Form->input('User.email',array('type'=>'text','class'=>'input-xlarge validate[required,custom[email]]','div'=>'controls','label'=>false,'id'=>'email')); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('User.username','Username *',array('class'=>'control-label')); 
							  		echo $this->Form->input('User.username',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('User.password','Password *',array('class'=>'control-label')); 
							  		echo $this->Form->input('User.password',array('type'=>'password','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.type','Type of Business *',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.type.',array('options'=>array('Restaurant'=>'Restaurant',
																					'Bar'=>'Bar',
																					'Cafe'=>'Cafe',
																					'Event'=>'Event'),
															'class'=>'validate[required]','div'=>'controls small','label'=>false,'multiple')); ?>       
                           <p>&nbsp;(Hold ctrl key to select<br />&nbsp; more than one values)</p>   
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.currency','Currency *',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.currency',array('options'=>array('CZK'=>'Czech Republic Koruna (CZK)',
																					'GBP'=>'British Pound (GBP)',
																					'USD'=>'US Dollar (USD)'),
															'class'=>'validate[required]','div'=>'controls small','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.country_id','Country *',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Restaurant.country_id',array('options'=>$countries,
															'class'=>'validate[required]','div'=>'controls small','label'=>false,'onchange'=>'get_cities(this.value);')); ?>                             
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.city_id','City *',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.city_id',array('options'=>array(''=>'Select City'),'class'=>'validate[required]','div'=>'controls small','label'=>false,'id'=>'cities','onchange'=>'check_other_city(this.value);'));
								
									
									
									 ?>       
                              
                          </div>
                          
                          <div class="control-group city_div" style="display:none;">
                           	  <?php echo $this->Form->label('Restaurant.city_other','Specify City Name',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.city_other',array('type'=>'text','class'=>'','div'=>'controls small','label'=>false,'id'=>'cities_other')); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.street','Street',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.street',array('type'=>'text','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.street_no','Street No.',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.street_no',array('type'=>'text','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.zip_code','Zip Code',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.zip_code',array('type'=>'text','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.phone','Phone',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.phone',array('type'=>'text','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Restaurant.website','Website',array('class'=>'control-label')); 
							  		echo $this->Form->input('Restaurant.website',array('type'=>'text','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                       		<div class="form-actions none">
							  <button type="submit" class="btn btn-primary">Save</button>
							
                              
							</div>
						 <?php echo $this->Form->end(); ?> 

					</div>
				</div>
			</div>            
    </div>        
    
<script type="text/javascript">

$(document).ready(function(e) {
     $("#RestaurantAdminAddForm").validationEngine({promptPosition: "topRight"});
	 <?php if($this->Form->value('Restaurant.country_id')){?>
	 get_cities('<?php echo $this->Form->value('Restaurant.country_id');?>');
	 <?php }?>
	 
	 <?php if($this->Form->value('Restaurant.type')){
		 foreach($this->Form->value('Restaurant.type') as $type){ ?>
	 		$('#RestaurantType option[value=<?php echo $type;?>]').attr('selected',true);
	 <?php }}?>
	 
});

function get_cities(country){
	if(country!=''){
		$.post('<?php echo $this->webroot; ?>users/get_cities',{country_code:country},function(data){
			$('#cities').html(data);
			 <?php if($this->Form->value('Restaurant.city_id')){?>
	 				$('#cities option[value=<?php echo $this->Form->value('Restaurant.city_id');?>]').attr('selected',true);
	 		<?php }?>
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