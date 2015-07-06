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
           <table class="table table-striped table-bordered bootstrap-datatable datatable">
           <thead>                         
           <tr>
           <th>S.No.</th>
           <th><?php echo __('Menu Item'); ?></th>
            <th>Title</th>							 
            <th>Description</th>
            <th>Price</th>
            <th>Orders</th>
            </tr>
            </thead>   
                
                  <tbody>
                <?php $i=1; 
     if(!empty($menu)){ ?>
                <?php 
        foreach($menu as $mn){ ?>     
            <tr>
            <td><?php echo $i; ?></td>
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
 
                <?php $i++;
                 }
                 } ?>
        </tr>
    
           
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
  
