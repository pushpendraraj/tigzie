<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Restaurant Profile</h2>
						
					</div>
					<div class="box-content">
                   		<?php echo $this->Form->create('Docs',array('type'=>'file','url'=>array('controller'=>'restaurants','action'=>'upload_menu'),'method'=>'post','class'=>'form-horizontal none')); ?>
						
                        <?php echo $this->Form->input('Restaurant.id',array('type'=>'hidden','value'=>$restaurant_id)); ?>
                          <input type="hidden" id="num" value="1"/> 
                                                   
                          <div class="form-actions">
                          	<h2>Upload Restaurant Menu</h2>
                          </div>
                          <div class="control-group">Only jpeg/png/jpg files allowed to upload. Max. file size should not be more than 1Mb.</div>
                          
                          <div class="control-group up_1">
                           <label class="control-label">File</label>
                           	<div class="controls">
                           	  <?php echo $this->Form->input('Docs.1.menu',array('type'=>'file','size'=>19,'label'=>false,'div'=>false,'class'=>'no_uniform')); ?>                               
                             </div>                             
                          </div>
                         <div><a href="javascript://" onclick="add_more();">Add More</a></div>                          
                          
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

function add_more(){
	var num=$('#num').val();
	num=parseInt(num)+1;
	$('.control-group').last().after('<div class="control-group up_'+num+'"><label class="control-label">File</label><div class="controls"><input type="file" id="Docs'+num+'Menu" size="19"  name="data[Docs]['+num+'][menu]" class="no_uniform">&nbsp;&nbsp;<a href="javascript://" onclick="remove_div('+num+');">Remove</a> </div></div>');
	$('#num').val(num);	
	$("input:file").not('.no_uniform').uniform();
}

function remove_div(num){
	$('.up_'+num).remove();	
}
</script>         




