<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Edit Deal</h2>
						
					</div>
					<div class="box-content">
                   		<?php echo $this->Form->create('Deal',array('method'=>'post','class'=>'form-horizontal none')); ?>
						
                       <?php 
					   echo $this->Form->input('Deal.id',array('type'=>'hidden'));
					   echo $this->Form->input('Deal.restaurant_id',array('type'=>'hidden','value'=>$restaurant_id));
					   echo $this->Form->input('Deal.deal_type',array('type'=>'hidden'));
					    ?>
                         
                      <!--  <div class="control-group">
                           	  <?php echo $this->Form->label('Deal.deal_type','Deal Type',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Deal.deal_type',array('options'=>array('discount'=>'Discount','promocode'=>'Promocode'),
															'class'=>'validate[required]','div'=>'controls small','label'=>false)); ?>       
                              
                          </div>-->
                                                 
                           <div class="control-group">
                           	  <?php echo $this->Form->label('Deal.title','Title',array('class'=>'control-label')); 
							  		echo $this->Form->input('Deal.title',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                           <div class="control-group promo_div" style="display:none;">
                           	  <?php echo $this->Form->label('Deal.promo_code','Promo Code',array('class'=>'control-label')); 
							  		echo $this->Form->input('Deal.promo_code',array('type'=>'text','class'=>'input-xlarge','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Deal.discount_type','Discount Type',array('class'=>'control-label')); 							  		
							  		echo $this->Form->input('Deal.discount_type',array('options'=>array('Percent'=>'Percent','Pure Value'=>'Pure Value'),
															'class'=>'validate[required]','div'=>'controls small','label'=>false)); ?>       
                              
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Deal.value','Discount Value <br>(e.g 10.00)',array('class'=>'control-label')); 
							  		echo $this->Form->input('Deal.value',array('type'=>'text','class'=>'input-xlarge validate[required,custom[number]]','div'=>'controls','label'=>false)); ?>                               
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Deal.start_date','Deal Start Date',array('class'=>'control-label')); 
							  		echo $this->Form->input('Deal.start_date',array('type'=>'text','class'=>'input-xlarge datepicker validate[required]','div'=>'controls','label'=>false)); ?>                               
                          </div>
                          
                          <div class="control-group">
                           	  <?php echo $this->Form->label('Deal.end_date','Deal End Date',array('class'=>'control-label')); 
							  		echo $this->Form->input('Deal.end_date',array('type'=>'text','class'=>'input-xlarge datepicker validate[required]','div'=>'controls','label'=>false)); ?>                               
                          </div>
                          
                          <div class="control-group">
							   <?php echo $this->Form->label('Deal.description','Description',array('class'=>'control-label')); 
							  		echo $this->Form->input('Deal.description',array('type'=>'textarea','class'=>'cleditor','div'=>'controls','label'=>false)); ?>       
							 
							</div>
                                                                             
							<div class="form-actions none">
							  <button type="submit" class="btn btn-primary">Save</button>
							  <button type="reset" class="btn">Reset</button>                              
							</div>
						 <?php echo $this->Form->end(); ?> 

					</div>
				</div><!--/span-->

			</div>
            
    </div>    
    
<script type="text/javascript">

$(document).ready(function(e) {
	
    $("#DealCreateDealForm").validationEngine({promptPosition: "topRight"});var to_day=new Date();
    $( "#DealStartDate" ).datepicker({
		defaultDate: "+1d",
		 minDate: new Date(to_day.getFullYear(), to_day.getMonth(), to_day.getDate(), 0, 0),
		changeMonth: true,
		changeYear: true,
		dateFormat:"yy-mm-dd",
		//numberOfMonths: 3,
		onClose: function( selectedDate ) {
		$( "#DealEndDate" ).datepicker( "option", "minDate", selectedDate );
		}
	});
		$( "#DealEndDate" ).datepicker({
		defaultDate: "+1d",
		changeMonth: true,
		 minDate: new Date(to_day.getFullYear(), to_day.getMonth(), to_day.getDate(), 0, 0),	
		changeYear: true,
		dateFormat:"yy-mm-dd",	
		//numberOfMonths: 3,
		onClose: function( selectedDate ) {
		$( "#DealStartDate" ).datepicker( "option", "maxDate", selectedDate );
		}
	});	
	
	
});

</script>            




