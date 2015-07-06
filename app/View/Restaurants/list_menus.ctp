<div class="portlet">
	<h3 class="portlet-title">
       	<u>List Menu</u>
	</h3>
    <div class="portlet-body">
		<div role="grid" class="dataTables_wrapper form-inline" id="table-1_wrapper"><div class="row dt-rt"><div class="col-sm-6"></div><div class="col-sm-6"><div class="dataTables_filter" id="table-1_filter"><label><input type="text" aria-controls="table-1"></label></div></div></div><table id="table-1" class="table table-striped table-bordered dataTable" aria-describedby="table-1_info">
            <thead>
              <tr role="row">
              <?php if(isset($menu)){  ?>
              	<th style="width: 325px;" class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Browser: activate to sort column descending">S.No.</th>
                <th style="width: 211px;" class="sorting" role="columnheader" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Menu Item</th>
                <th style="width: 188px;" class="sorting" role="columnheader" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Title</th>
                <th style="width: 211px;" class="text-center sorting" role="columnheader" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Description</th>
                <th style="width: 120px;" class="text-center sorting" role="columnheader" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Price</th>
                <th style="width: 120px;" class="text-center sorting" role="columnheader" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Orders</th>
                
                <?php } ?>
                </tr>
            </thead>
            <tfoot>
              <tr><th rowspan="1" colspan="1">S.No</th><th rowspan="1" colspan="1">Menu Item</th><th rowspan="1" colspan="1">Title</th><th class="text-center" rowspan="1" colspan="1">Description</th><th class="text-center" rowspan="1" colspan="1">Price</th><th class="text-center" rowspan="1" colspan="1">Orders</th></tr>
            </tfoot>
          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
           $i=1; 
     if(!empty($menu)){ 
             
        foreach($menu as $mn){  
		?>
          <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty"><?php echo $i; ?></td></tr>
          
          <?php $i++; } ?>
          
          </tbody></table>
          
          
          <div class="row dt-rb"><div class="col-sm-6"><div class="dataTables_info" id="table-1_info">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#"> <i class="fa fa-angle-double-left"></i>&nbsp; Previous</a></li><li class="next disabled"><a href="#">Next &nbsp;<i class="fa fa-angle-double-right"></i> </a></li></ul></div></div></div></div>

        </div> <!-- /.portlet-body -->

      </div>




<div id="content" class="span10">
			<!-- content starts -->
             <div class="box-content">
       
              </div>
<section class="main_box deals_data">
    <div class="wrapper">
    <section class="left_container">
    <section class="food_sec">
    <ul>
     <section class="off_box">
     <section class="rating">
     <span class="title_tag">
<div class="box-content">
<?php if(isset($menu)){                   	
           echo '<table class="table table-striped table-bordered bootstrap-datatable datatable">';
           echo '<thead>';                         
           echo '<tr>';
           echo '<th>';echo 'S.No.'; echo '</th>';
           echo '<th>';echo __('Menu Item'); echo'</th>';
           echo '<th>';echo 'Title'; echo '</th>';							 
           echo '<th>';echo 'Description'; echo '</th>';
           echo '<th>';echo 'Price'; echo '</th>';
           echo '<th>';echo 'Orders'; echo '</th>';
           echo '</th>';
           echo '</thead>';     
           echo '<tbody>';
                 $i=1; 
     if(!empty($menu)){ 
             
        foreach($menu as $mn){     
           echo '<tr>';
           echo '<td>'; echo $i; echo '</td>';?>
            <?php if(!empty($mn['Docs'])){ ?>
            <td><small><img class="menu_img" src="<?php echo $this->webroot.'files/'.$mn['Menu']['restaurant_id'].'/'.$mn['Docs'][0]['name']; ?>" width="50" height="50"></small> <?php } ?>
            </td>
            <td><?php echo $mn['Menu']['title']; ?></td>
            <td><?php echo $mn['Menu']['description']; ?></td>
            <td><?php echo $mn['Menu']['price']; ?></td>
             <td><?php $cid=$mn['Menu']['menucategory_id']; ?>
             <?php $rid=$mn['Menu']['restaurant_id'];?>
             <?php $id=$mn['Menu']['id'];  ?>
    <a class="btn btn-info" onclick="get_order(<?php echo $cid ; ?>,<?php echo $rid ;?>,<?php echo $id ;?>,this)" >
       <i class="icon-edit icon-white"></i>  
     Add                                          
     </a> 
     </td>
    <?php $i++;}}
	else{
		 echo '<tr>';
           echo '<td colspan=6>';echo 'menu items are not available'; echo '</td>';
           echo '<tr>';		
		
	}?>
        </tr>
        </tbody>
        </table>
        <?php }?>
     </div>
     </span>
     </section>
        <!--<img src="common/images/off.png">-->
     </section>
        
        </a>
         </li>
                                                             
                              
                         
                  </ul>
                  <!--<a href="#" class="more">show more</a>-->
              </section>
              
          </section>
          
      </div>
  </section></div></div>
  </div>
  
