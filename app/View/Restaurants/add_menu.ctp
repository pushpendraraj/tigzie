<div class="layout layout-main-right layout-stack-sm">
	<div class="col-md-3 col-sm-4 layout-sidebar">
		<div class="nav-layout-sidebar-skip">
        	<strong>Tab Navigation</strong> / <a href="#settings-content">Skip to Content</a>	
        </div>
        <ul class="nav nav-layout-sidebar nav-stacked" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#profile-tab">
                    <i class="fa fa-plus-square"></i> 
                    &nbsp;&nbsp;Add Menu
                </a>
            </li>
          </ul>
        </div> <!-- /.col -->
        <div class="col-md-9 col-sm-8 layout-main">
			<div class="tab-content stacked-content" id="settings-content">
            	<div id="profile-tab" class="tab-pane fade active in">
              		<h3 class="content-title"><u>Add Menu</u></h3>
              		<br><br>
              		<?php echo $this->Form->create('Menu',array('type'=>'file','url'=>array('controller'=>'restaurants','action'=>'add_menu'),'method'=>'post','class'=>'form-horizontal none')); ?>
                     <?php echo $this->Form->input('Menu.restaurant_id',array('type'=>'hidden','value'=>$restaurant['Restaurant']['id'])); ?>
                         <input type="hidden" id="num" value="1"/>
                    <div class="form-group"> 
                        <?php 		
							echo $this->Form->label('Menu.menucategory_id','Category',array('class'=>'col-md-3')); 				  		
                            echo $this->Form->input('Menu.menucategory_id',array(
                                    'options'=>$categories,
                                    'class'=>'validate[required]',
                                    'div'=>array('class'=>'col-md-7'),
                                    'label'=>false,
                                    'empty'=>'Select Category',
                                    'class'=>'form-control'
                                    )
                                ); 
                        ?>     
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                         <?php 
                            echo $this->Form->label('Menu.title','Title',array('class'=>'col-md-3')); 
                            echo $this->Form->input('Menu.title',array('type'=>'text','class'=>'form-control validate[required]','div'=>array('class'=>'col-md-7'),'label'=>false)); ?> 
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                      <?php 
					  	echo $this->Form->label('Menu.price','Price (in '.$restaurant['Restaurant']['currency'].')',array('class'=>'col-md-3')); 					echo $this->Form->input('Menu.price',array('type'=>'text','class'=>'form-control validate[required,custom[number]]','div'=>array('class'=>'col-md-7'),'label'=>false)); ?>   
                    </div> <!-- /.form-group -->
                    <div class="form-group">
    					<?php 
							echo $this->Form->label('Menu.description','Description',array('class'=>'col-md-3')); 
							echo $this->Form->input('Menu.description',array('type'=>'textarea','class'=>'cleditor','div'=>array('class'=>'col-md-7'),'label'=>false)); ?>    
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                      	<label class="col-md-3">Image</label>
                      	<div class="col-md-7">
                        	<?php echo $this->Form->input('Docs.1.menu',array('type'=>'file','size'=>19,'label'=>false,'div'=>false)); ?> 
                            <div style="padding-bottom: 30px; width: 15%;margin-left:8px;"><a href="javascript://" onclick="add_more();" style="float:right;"><i class="fa fa-plus-square"></i> Add More</a></div> 
                            <span id="more"></span>    
                      	</div> <!-- /.col -->
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                      	<div class="col-md-7 col-md-push-3">
                        	<button class="btn btn-primary" type="submit">Save</button>
                        	&nbsp;
                             <a class="btn btn-default" href="<?php echo $this->webroot; ?>restaurants/add_menu ">Cancel</a>
                      	</div> <!-- /.col -->
                   </div> <!-- /.form-group -->
           		 <?php echo $this->Form->end(); ?> 
			</div> <!-- /.tab-pane -->
		</div> <!-- /.tab-content -->
	</div> <!-- /.col -->
</div> 
    
<script type="text/javascript">

$(document).ready(function(e) {
    $("#MenuAddMenuForm").validationEngine({promptPosition: "topRight"});
});

function add_more(){
	var num=$('#num').val();
	num=parseInt(num)+1;
	$('#more').last().after('<div class="up_'+num+'"><div class="controls"><input type="file" id="Docs'+num+'Menu" size="19"  name="data[Docs]['+num+'][menu]" class="no_uniform">&nbsp;&nbsp;<a href="javascript://" onclick="remove_div('+num+');"><i class="fa fa-minus-square"></i> Remove</a> </div></div>');
	$('#num').val(num);	
	$("input:file").not('.no_uniform').uniform();
}

function remove_div(num){
	$('.up_'+num).remove();	
}
</script>            




