
            <?php
     if(!empty($menuitem)){ ?>
    <tr>
	<td><small><img class="menu_img" src="<?php echo $this->webroot.'files/'.$menuitem[0]['Menu']['restaurant_id'].'/'.$menuitem[0]['Docs'][0]['name']; ?>" width="50" height="50"></small>
	</td>
	<td><?php echo $menuitem[0]['Menu']['title']; ?></td>
	<td><?php echo $menuitem[0]['MenuCategory']['name']; ?></td>
	<td><?php echo $menuitem[0]['Menu']['price']; ?><?php $a=$menuitem[0]['Menu']['price']; ?><?php $b=$menuitem[0]['Menu']['id']; ?></td>
	<td><?php echo $this->Form->input('quantity.'.$menuitem[0]['Menu']['id'],array('label'=>false,'id'=>'quantity_'.$menuitem[0]['Menu']['id'],'onkeyup'=>'get_total(this.value,'.$a.','.$b.')'))?> </td>
	<td><?php echo $this->Form->input('total.'.$menuitem[0]['Menu']['id'], array('label'=>false,'readonly' => 'readonly','id'=>'total_'.$b));?>
        <?php $cid=$menuitem[0]['Menu']['menucategory_id']; ?>
        <?php $rid=$menuitem[0]['Menu']['restaurant_id'];?>
        <?php $id=$menuitem[0]['Menu']['id'];  ?></td> 
    <td> <a class="btn btn-info" onclick="remove_item(this,this)" >
                               <i class="icon-edit icon-white"></i>  
                             Remove                                       
                             </a>  </td> 
	 <?php 
		
		 } ?>
         
   </tr>
<script type="text/javascript">
	function get_total(var1,var2,var3){
		var res=(parseInt(var1))*(parseInt(var2));
		$('#total_'+var3).val(res);
	}
	

	 

</script>   

       
          