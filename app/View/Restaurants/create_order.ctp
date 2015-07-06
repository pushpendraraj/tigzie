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
                   		<?php echo $this->Form->create('Order',array('type'=>'file','url'=>array('controller'=>'restaurants','action'=>'add_menu'),'method'=>'post','class'=>'form-horizontal none')); ?>
						
                       <?php echo $this->Form->input('Order.restaurant_id',array('type'=>'hidden','value'=>$this->Session->read('User.2.restaurant_id'))); ?>
                         <input type="hidden" id="num" value="1"/>
                        <div class="control-group">
                        
                        <?php echo $this->Form->label('category_name'); ?>
                         <select id="category_select" onchange="get_menus(this.value);">
                        <option value="">Select Category</option>
                       <?php foreach($category as $cn){ ?>
                       	<option value="<?php echo $cn['MenuCategory']['id'];?>"><?php echo $cn['MenuCategory']['name'];?></option>
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
     <?php echo $this->Form->create('Orderitems',array('url'=>array('controller'=>'restaurants','action'=>'proceed'))); ?>
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
                       <button type="submit" onsubmit="validateForm()" class="btn btn-success">Proceed</button>
                     </div>
                   <?php echo $this->Form->end(); ?> 
               </div>     
           </div>
        </div>
      </div>
   <script type="text/javascript">
		function get_order(val1,val2,val3,obj){
		   $('#test').append('<img id="loader2" src="<?php  echo $this->webroot;?>img/ajax-loaders/loading.gif" class="loading-image" />');
		    $(obj).parent().append('<img id="loader3" src="<?php  echo $this->webroot;?>img/ajax-loaders/loading.gif" class="loading-image" />');
			$.post('<?php echo $this->webroot; ?>restaurants/add_order/'+val1+'/'+val2+'/'+val3+'',function(data){
					$('#test').append(data);
					$('#loader2').remove();
					$('#loader3').remove();
			});
	}
	  function get_menus(val){
        $.post('<?php echo $this->webroot; ?>restaurants/list_menus',{menu:val},function(data){
                $('#deals_data').html(data);
            });	
    }
  function remove_item(obj,obj1){
	   $(obj1).parent().append('<img id="loader4" src="<?php  echo $this->webroot;?>img/ajax-loaders/loading.gif" class="loading-image" />');
			$(obj).parent().parent().remove();
			  $('#loader4').remove();
		}
		 function change_order(val){
	  $.post('<?php echo $this->webroot;?>restaurants/filter_orders/'+val+'',function(data){
	  	 $('#test').html(data); })
  }
function validateForm(val) {
	alert(val); 
//$(#val).val();
	//alert(x);
//    if (x==null || x=="") {
//        alert("First name must be filled out");
//        return false;
//    }
}

  
</script>        



