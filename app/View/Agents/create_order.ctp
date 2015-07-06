<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Create Order</h2>
						
					</div>
                    <?php ?>
					<div class="box-content">
                         <input type="hidden" id="num" value="1"/>
                        <div class="control-group">
                        
                        <?php echo $this->Form->label('category_name'); ?>
                         <select id="restaurant_select" onchange="get_menucat(this.value);">
                        <option value="">Select Restaurant</option>
                       <?php foreach($restaurant as $rs){ ?>
                       	<option value="<?php echo $rs['Restaurant']['id'];?>"><?php echo $rs['Restaurant']['restaurant_name'];?></option>
                       <?php } ?>
                        </select>
                       <select id="categories" onchange="get_menus(this.value);">
                       <option>Select Category</option>
                        <?php foreach($category as $ct){ ?>
                       	<option value="<?php echo $ct['MenuCategory']['id'];?>"><?php echo $ct['MenuCategory']['name'];?></option>
                       <?php } ?>
                       </select>
                        </form>
                          </div>
            <section id="deals_data" class="main_box deals_data">
            	
            </section>
            
            
           </div>    
           
           </div>
           </div>
    <div  class="box">
    <div class="box-header well" data-original-title>
    <h2><i class="icon-edit"></i>Your Order</h2>
    </div>
    
    <div id="box-content" class="box-content">
     <?php 
	 echo $this->Form->create('Orderitems',array('url'=>array('controller'=>'agents','action'=>'proceed'))); ?>
    <table class="table table-striped table-bordered">
  		<thead>                         
      		<tr>
          	<th><?php echo __('Menu Item'); ?></th>
          	<th>Title</th>							 
          	<th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
            </tr>
            </thead>   
            <tbody id="test" class="tbody">
			</tbody>
            </table>
          <?php echo $this->Session->flash(); ?>
         <div class="form-actions none">
              <button type="submit" class="btn btn-success">Proceed</button>
                   </div>
                       <?php echo $this->Form->end(); ?> 
                         </div>           
    </div>
    </div>
    </div>
           
    <script type="text/javascript">
	 $(document).ready(function(e) {
     	$('#restaurant_select').val('');
	    $('#categories').val('');
});
    function get_menucat(val){
	    $('#categories').val('');
        $.post('<?php echo $this->webroot; ?>agents/get_category/'+val+'',{restaurant:val},function(data){
                $('#categories').html(data);
            });	
    }

    function get_menus(val){
        $.post('<?php echo $this->webroot; ?>agents/list_menus',{menu:val},function(data){
                $('#deals_data').html(data);
            });	
    }
	function get_order(val1,val2,val3,obj){
		   $('#test').append('<img id="loader2" src="<?php  echo $this->webroot;?>img/ajax-loaders/loading.gif" class="loading-image" />');
		    $(obj).parent().append('<img id="loader3" src="<?php  echo $this->webroot;?>img/ajax-loaders/loading.gif" class="loading-image" />');
			$.post('<?php echo $this->webroot; ?>agents/add_order/'+val1+'/'+val2+'/'+val3+'',function(data){
					$('#test').append(data);
					$('#loader2').remove();
					$('#loader3').remove();
			});
	}
  function remove_item(obj){
			$(obj).parent().parent().remove();
		}
		
</script>        



