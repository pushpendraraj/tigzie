<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Edit Menu</h2>
						
					</div>
					<div class="box-content">
                   		<?php echo $this->Form->create('MenuCategory',array('type'=>'file','url'=>array('controller'=>'restaurants','action'=>'edit_category'),'method'=>'post','class'=>'form-horizontal none')); ?>
						
                       <?php 
					   echo $this->Form->input('MenuCategory.id',array('type'=>'hidden'));
					   echo $this->Form->input('MenuCategory.restaurant_id',array('type'=>'hidden')); ?>
                         <input type="hidden" id="num" value="1"/>
                     
                                                 
                           <div class="control-group">
                           	  <?php echo $this->Form->label('MenuCategory.category_name','Category',array('class'=>'control-label')); 
							  		echo $this->Form->input('MenuCategory.name',array('type'=>'text','class'=>'input-xlarge validate[required]','div'=>'controls','label'=>false)); ?>       
                              
                          </div>
                         	<div class="form-actions none">
							  <button type="submit" class="btn btn-primary">Save</button>
							  <button type="reset" class="btn">Reset</button>
                              
							</div>
						 <?php echo $this->Form->end(); ?> 
						
                        
                       
    </div>     
                        
					</div>
				</div><!--/span-->

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




