<section class="left_container">
                    	<section class="view_sec">
                        	<section class="choose">
                               <!-- <small>Sort by</small>
                                <select>
                                    <option>Price (low to high)</option>
                                </select>-->
                            </section>
                          
                        </section>
                        <?php 
							 if(!empty($menu)){ ?>
                             
                          <section class="food_sec">
                        	<ul> 
                             <?php 
								foreach($menu as $mn){	 ?>
                                                       
                            	<li id="key_<?php echo $mn['MenuCategory']['id']; ?>" class="draggable">
                                	<section class="off_box"  id="menu_<?php echo $mn['Menu']['id']; ?>">
                                    	<section class="rating">
                                    		<span class="title_tag"><?php echo $mn['Menu']['title']; ?></span>
                                            <ul>
                                            	<li><a href="#"></a></li>
                                            	<li><a href="#"></a></li>
                                            	<li><a href="#"></a></li>
                                            	<li><a href="#"></a></li>
                                            	<li><a href="#"></a></li>
                                            </ul>
                                        </section>
                                        <!--<img src="common/images/off.png">-->
                                    </section>
                                    <section class="detail_box">
                                    <?php if(!empty($mn['Docs'])){ ?>
                                    	<small><img class="menu_img" src="<?php echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$mn['Docs'][0]['name']; ?>" width="179" height="132"></small>
                                        <?php } ?>
                                        <section class="info description_tag">
                                        	<p><?php echo $mn['Menu']['description']; ?></p>
                                            <a href="#"><span class="price_tag"><?php echo $mn['Menu']['price']; ?></span>&nbsp;<span class="currency_tag"><?php echo $restaurant['Restaurant']['currency']; ?></span></a>
                                        </section>
                                    </section>
                                </li>
                                                           
                            
                        <?php } ?>
                        	</ul>
                            <!--<a href="#" class="more">show more</a>-->
                        </section>
                        <?php } ?>
                    </section>
<script type="text/javascript">
$(document).ready(function(e) {
    $( ".draggable" ).draggable({ helper:"clone", revert:"invalid",containment:"document", cursor: "move", cursorAt: { top: 56, left: 56 } });
	 $(".droppable").droppable({ accept: ".draggable", activeClass: "ui-state-highlight", 
	 					drop: function( event, ui ) {
								add_menu( ui.draggable );
							}
					 });
});
</script>                    