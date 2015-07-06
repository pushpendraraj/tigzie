
<section id="body_container">
<section class="white_box">
            	<div class="wrapper">
                	<section class="gray_box">
                        <div class="restuarent_logo">
                    	<strong><img src="<?php echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$restaurant['Restaurant']['logo']; ?>" width="299" height="162"></strong>
                        </div>
                        <ul>
                        	<li>
                            	<span>Phone No.</span>
                                <small><?php echo $restaurant['Restaurant']['phone']; ?></small>
                            </li>
                            <li>
                            	<span>Address</span>
                                <small><?php echo $restaurant['Restaurant']['street'].' '.$restaurant['Restaurant']['street_no'].',<br>'.$restaurant['City']['city_name'].', '.$restaurant['Country']['country_name'].' - '.$restaurant['Restaurant']['zip_code']; ?></small>
                            </li>
                            
                            <li>
                            	<span>Highlights</span>
                                <ul>
                                	<?php if(isset($facilities) && !empty($facilities)){ 
											foreach($facilities as $fc){
												if(!empty($fc['Facility']['name'])){
												echo '<li>'.$fc['Facility']['name'].'</li>';	
											}}										
										 }else{ echo '<li>N/A</li>'; } 
									?>
                                </ul>
                            </li>
                        </ul>
                        <section class="red_box">
                        	<span>Rating</span>
                            <img src="<?php echo $this->webroot; ?>img/frontend/rating.png">
                        	<span>268 Reviews</span>
                        </section>
                    </section>
                </div>
            </section>
            
     	<section class="category_box">
            	<h3>Choose a category</h3>
                <section class="menu">
                	<div class="wrapper">
                    	<?php if(!empty($menuCat)){ ?>
                            <a href="#" class="left"></a>  
                           <div class="carousel">                      
                            <ul class="all_cats">
                                <?php $i=0; foreach($menuCat as $key=>$index){ if($i==0){ $selected=$key; } ?>
                               		<li class="<?php if($i==0) echo 'active'; ?>" onclick="get_menu(<?php echo $key; ?>); $('.all_cats li').removeClass('active'); $(this).addClass('active');"><a href="javascript://"><?php echo $index; ?></a></li>
                                <?php $i++; } ?>
                            </ul>
                            </div>
                            <a href="#" class="right"></a>
                        <?php } ?>
                    </div>
                </section>
         	</section>            
            
         <section class="main_box">
            	<div class="wrapper">
                	<section class="left_container">
                    	<section class="view_sec">
                        	<section class="choose">
                               <!-- <small>Sort by</small>
                                <select id="sort_by" onchange="get_sorted_data(this.value,<?php echo $restaurant['Restaurant']['id']; ?>);">
                                    <option value="0">Price (low to high)</option>
                                    <option value="1">Price (high to low)</option>
                                </select>-->
                            </section>
                            
                        </section>
                        <?php 
							 if(!empty($restaurant['Menu'])){ ?>
                             
                          <section class="food_sec">
                        	<ul> 
                             <?php 
								foreach($restaurant['Menu'] as $menu){
									if($menu['menucategory_id']==$key){ ?>
                       
                            	<li id="key_<?php echo $key; ?>" class="draggable">
                                	<section class="off_box"  id="menu_<?php echo $menu['id']; ?>">
                                    	<section class="rating">
                                    		<span class="title_tag"><?php echo $menu['title']; ?></span>
                                            <ul>
                                            	<li><a href="#"></a></li>
                                            	<li><a href="#"></a></li>
                                            	<li><a href="#"></a></li>
                                            	<li><a href="#"></a></li>
                                            	<li><a href="#"></a></li>
                                            </ul>
                                        </section>
                                        <!--<img src="<?php echo $this->webroot; ?>img/frontend/off.png">-->
                                    </section>
                                    <section class="detail_box">
                                  
                                    	<small><img class="menu_img" src="<?php echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$menu['Docs'][0]['name']; ?>" width="179" height="132"></small>
                                        <section class="info description_tag">
                                        	<p><?php echo $menu['description']; ?></p>
                                            <a href="#"><span class="price_tag"><?php if(isset($deal)){ echo calculate_price($menu['price'],$deal['Deal']['value'],$deal['Deal']['discount_type']); }else{ echo $menu['price'];} ?></span>&nbsp;<span class="currency_tag"><?php echo $restaurant['Restaurant']['currency']; ?></span></a>
                                        </section>
                                    </section>
                                </li>
                                                           
                            
                        <?php }} ?>
                        	</ul>
                            <!--<a href="#" class="more">show more</a>-->
                        </section>
                        <?php } ?>
                    </section>
                	<section class="right_container">
                    	<div class="title_row">
                    		<span></span>
                            <h3>What’s in your basket?</h3>
                        </div>
                        <ul class="droppable"> 
                        	
                            <?php if(isset($basket)){ 
								foreach($basket['menu'] as $in=>$mn){
									$in+=1;
							?>	          
                      		<li class="piece_<?php echo $in; ?>"><div class="left_itm"><img src="<?php echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$mn['Docs'][0]['name']; ?>" width="22" height="22"/><span class="bqty_<?php echo $in; ?>"><?php echo $mn['Menu']['qty']; ?></span><div class="controls"><a href="javascript://" onclick="add_quantity(<?php echo $in; ?>);" class="plus"><img src="<?php echo $this->webroot; ?>img/plus.jpg"></a><a href="javascript://" onclick="delete_quantity(<?php echo $in; ?>);" class="minus"><img src="<?php echo $this->webroot; ?>img/minus.jpg"></a></div></div><h5 class="btitle_<?php echo $in; ?>"><?php echo $mn['Menu']['title']; ?></h5><h5 class="bprice_<?php echo $in; ?> pricenum" style="display:inline;"><?php if(isset($deal)){ echo calculate_price($mn['Menu']['price'],$deal['Deal']['value'],$deal['Deal']['discount_type']); }else{ echo $mn['Menu']['price'];} ?></h5><h5 class="bcurrency_<?php echo $in; ?>' pricenum" style="display:inline;"><?php echo $restaurant['Restaurant']['currency']; ?></h5><a href="javascript://" class="rem_<?php echo $in; ?>" onclick="remove_from_basket(<?php echo $in; ?>);"></a>
                            </li>
                            <?php }} ?>
                            <li>
                            	<h4 class="total_pieces_tag"><?php if(isset($basket)){ echo $basket_totalqty; }else{ echo 0; }?> pcs in total price: </h4>
                                <h6><span class="total_price_tag"><?php if(isset($basket)){ echo $basket_totalprice; }else{ echo 0; }?><?php echo $restaurant['Restaurant']['currency']; ?> </span><small>(including VAT)</small></h6>
                            </li>
                        </ul>
                        <form id="basketForm" name="basketForm" method="post" action="<?php echo $this->webroot; ?>orders/checkout<?php if(isset($this->request->query['agent_id'])){
							echo "?agent_id=".$this->request->query['agent_id'];}?>">
                        <input type="hidden" name="restaurant_id" value="<?php echo $restaurant['Restaurant']['id']; ?>"/>
                        <div class="basketFormDiv">
                        <?php if(isset($basket)){ 
								foreach($basket['menu'] as $in=>$mn){
						?> 
                        	<input id="menu_inp_<?php echo $in; ?>" type="hidden" name="data[item][<?php echo $in; ?>][<?php echo $mn['Menu']['id']; ?>]" value="<?php echo $mn['Menu']['qty']; ?>"/>
                        <?php }} ?>
                         <?php if(isset($this->request->query['agent_id'])){
							 echo $this->Form->input('agent_id',array('type'=>'hidden','value'=>$this->request->query['agent_id'])); }?>
                        </div>     	
                        	<strong><a href="javascript://" onclick="$('#basketForm').submit();">Confirm order</a></strong>
                        </form>
                    </section>
                </div>
            </section>
            
            
            <section class="bottom_container">
            	<div class="wrapper">
                	<section class="top_sec">
                    	<section class="left_content">
                        	<?php echo $restaurant['Restaurant']['block_1_text']; ?>
                        </section>
                        <?php if(!empty($restaurant['Restaurant']['block_1_image'])){ ?>
                            <section class="right_content">
                                <img src="<?php echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$restaurant['Restaurant']['block_1_image']; ?>" width="419" height="160">
                            </section>
                        <?php } ?>
                    </section>
                    <section class="bottom_sec">
                    	<ul>
                        	<li>
                            	<?php if(!empty($restaurant['Restaurant']['block_2_image'])){ ?>
                            		<span><img src="<?php echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$restaurant['Restaurant']['block_2_image']; ?>" width="127" height="127"></span>
                                <?php }
									echo  $restaurant['Restaurant']['block_2_text']; 
										
                                ?>
                                <a <?php if(!empty($restaurant['Restaurant']['block_2_link'])){ echo 'href="'.$restaurant['Restaurant']['block_2_link'].'" target="_blank"'; }else{ echo 'href="#"';}?>>Learn more</a>
								
                            </li>
                           <li class="last">
                            	<?php if(!empty($restaurant['Restaurant']['block_3_image'])){ ?>
                            		<span><img src="<?php echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$restaurant['Restaurant']['block_3_image']; ?>" width="127" height="127"></span>
                                <?php }
									echo  $restaurant['Restaurant']['block_3_text']; 
										
                                ?>
                                <a <?php if(!empty($restaurant['Restaurant']['block_3_link'])){ echo 'href="'.$restaurant['Restaurant']['block_3_link'].'" target="_blank"'; }else{ echo 'href="#"';}?>>Learn more</a>
								
                            </li>
                        </ul>
                    </section>
                </div>
            </section>        
            
</section>

<script type="text/javascript">
var restaurant_id='<?php echo $restaurant['Restaurant']['id']; ?>';
var totAmount=parseInt(<?php if(isset($basket)){ echo $basket_totalprice; }else{ echo 0; }?>);
var pieces=parseInt(<?php if(isset($basket)){ echo $basket_totalqty; }else{ echo 0; }?>);
var num=<?php if(isset($basket)){ echo count($basket['menu']); }else{ echo 0; }?>;

$(document).ready(function(e) {
    $( ".draggable" ).draggable({ helper:"clone", revert:"invalid",containment:"document", cursor: "move", cursorAt: { top: 56, left: 56 } });
	 $(".droppable").droppable({ accept: ".draggable", activeClass: "ui-state-highlight", 
	 					drop: function( event, ui ) {
								add_menu( ui.draggable );
							}
					 });
});

function add_menu($data){

		var price=parseInt($data.find('span.price_tag').html());
		var currency=$data.find('span.currency_tag').html();
		var title=$data.find('span.title_tag').html();
		var src=$data.find('.menu_img').attr('src');
		console.log(src);
		var menu_id=$data.find('.off_box').attr('id');
		menu_id=menu_id.split('_');
		menu_id=menu_id[1];
		//alert(src);
		totAmount=totAmount+parseInt(price);
		pieces+=1;
		num=num+1;
		$('.droppable li:last').before('<li class="piece_'+num+'"><div class="left_itm"><img src="'+src+'" width="22" height="22"/><span class="bqty_'+num+'">1</span><div class="controls"><a href="javascript://" onclick="add_quantity('+num+');" class="plus"><img src="<?php echo $this->webroot; ?>img/plus.jpg"></a><a href="javascript://" onclick="delete_quantity('+num+');" class="minus"><img src="<?php echo $this->webroot; ?>img/minus.jpg"></a></div></div><h5 class="btitle_'+num+'">'+title+'</h5><h5 class="bprice_'+num+' pricenum" style="display:inline;">'+price+'</h5><h5 class="bcurrency_'+num+' pricenum" style="display:inline;">'+currency+'</h5><a href="javascript://" class="rem_'+num+'" onclick="remove_from_basket('+num+');"></a></li>').fadeIn('slow');
		
		$('.basketFormDiv').prepend('<input id="menu_inp_'+num+'" type="hidden" name="data[item]['+num+']['+menu_id+']" value="1"/>');
		$('.total_pieces_tag').html(pieces+' pcs in total price: ');
		$('.total_price_tag').html(totAmount+currency);
		
}

function remove_from_basket(num){
	$item=$('.droppable').find('.piece_'+num);
	var price=parseInt($item.find('.bprice_'+num).html());
	var currency=$item.find('.bcurrency_'+num).html();
	var qty=$item.find('.bqty_'+num).html();
	
	$item.fadeOut('slow');
	totAmount=totAmount-(parseInt(price)*parseInt(qty));
	pieces-=parseInt(qty);
	$('.total_pieces_tag').html(pieces+' pcs in total price: ');
	$('.total_price_tag').html(totAmount+currency);	
}

function get_menu(cat_id){
	$.post('<?php echo $this->webroot; ?>restaurants/get_menu_items',{category_id:cat_id,restaurant_id:restaurant_id},function(data){
		$('.left_container').html(data).fadeIn('slow');	
	});	
}

function add_quantity(num){
	var qty=$('.bqty_'+num).html();
	qty=parseInt(qty)+1;	
	if(qty<10){
		var price=$('.bprice_'+num).html();
		//var newprice=parseInt(price)*qty;
		var currency=$('.bcurrency_'+num).html();
		pieces+=1;
		totAmount=totAmount+parseInt(price);
		$('.bqty_'+num).html(qty);
		$('#menu_inp_'+num).val(qty);
		$('.total_pieces_tag').html(pieces+' pcs in total price: ');
		$('.total_price_tag').html(totAmount+currency);
	}else{
		alert('Max. quantity is limited to 9 pieces');	
	}
}

function delete_quantity(num){
	var qty=$('.bqty_'+num).html();
	qty=parseInt(qty)-1;	
	if(qty>0){
		var price=$('.bprice_'+num).html();
		//var newprice=parseInt(price)*qty;
		var currency=$('.bcurrency_'+num).html();
		pieces-=1;
		totAmount=totAmount-parseInt(price);
		$('.bqty_'+num).html(qty);
		//$('.bprice_'+num).html(newprice);
		$('.total_pieces_tag').html(pieces+' pcs in total price: ');
		$('.total_price_tag').html(totAmount+currency);
	}else{
		alert('Min. quantity should be 1');	
	}
}

function get_sorted_data(val){
		
}
$(function(){
	$(".carousel").jCarouselLite({
      btnNext: ".right",
      btnPrev: ".left",
	   visible: 5,
	   scroll: 2
  });
});

</script>