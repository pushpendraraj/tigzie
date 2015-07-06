<section id="body_container">
        	<section class="slider_container">
            	<section class="main_slider">
                	<ul>
                    	<li>
                        	<img alt="" src="<?php echo $this->webroot; ?>img/frontend/sabores-building.jpg" width="1396" height="466">
                            <img alt="" src="<?php echo $this->webroot; ?>img/frontend/slide1.jpg" width="1396" height="466">
                            
                        </li>
                    </ul>
                </section>
                <section class="thumbnail_sec">
                	<div class="wrapper autoscroll">
                    	<ul>
                        	<li><img alt="" src="<?php echo $this->webroot; ?>img/frontend/logos/slide_img1.png" width="290" height="87"></li>
                        	<li><img alt="" src="<?php echo $this->webroot; ?>img/frontend/logos/slide_img2.png" width="290" height="87"></li>
                        	<li><img alt="" src="<?php echo $this->webroot; ?>img/frontend/logos/slide_img3.png" width="290" height="87"></li>
                            <li><img alt="" src="<?php echo $this->webroot; ?>img/frontend/logos/slide_img4.png" width="290" height="87"></li>
                        	<li><img alt="" src="<?php echo $this->webroot; ?>img/frontend/logos/slide_img5.png" width="290" height="87"></li>
                        	<li><img alt="" src="<?php echo $this->webroot; ?>img/frontend/logos/slide_img6.png" width="290" height="87"></li>
                        </ul>
                    </div>
                </section>
            </section>
            <section class="box_container">
            	<div class="wrapper">
                	<section class="tabbing_sec">
                    	<ul>
                        	<li class="active"><a href="javascript://" onclick="get_filtered_list(1);" class="loved"><span>Most Booked Restaurants</span></a></li>
                        	<li><a href="javascript://" onclick="get_filtered_list(2);" class="sellers"><span>Best Rated Restaurants</span></a></li>
                        	<li><a href="javascript://" onclick="get_filtered_list(3);" class="populars"><span>Special This Week</span></a></li>
                        </ul>
                    </section>
                    <section class="content_sec">
                    <section class="product_sec">
                    	<?php 
							$i=0;
						foreach($restaurants as $rest){   ?>
                    	<?php if($i==0||$i==3||$i==6||$i==9) echo '<ul>'; ?>
                        	
                        	<li <?php if($i==2||$i==5||$i==8) echo 'class="last"'; ?>><a href="<?php echo $this->webroot; ?><?php echo str_replace(' ','-',strtolower($rest['Restaurant']['restaurant_name'])); ?>"><img alt="" src="<?php echo $this->webroot.'files/'.$rest['Restaurant']['id'].'/'.$rest['Restaurant']['logo']; ?>" title="<?php echo $rest['Restaurant']['restaurant_name']; ?>"></a></li>
                        <?php if($i==2||$i==5||$i==8) echo '</ul>'; ?>
                        <?php $i++; } ?>
                       
                    </section>
                    
                    <section class="paging_sec">
                    <img alt="Loading" id="paging_loader" style="display:none;" src="<?php echo $this->webroot;?>img/loading.gif"/>
                    <?php 
					$url=array('controller'=>'restaurants','action'=>'paging_index');
					echo $this->Paginator->options(array('update'=>'.content_sec','evalScripts' => true,'url'=>$url,
								'before' => $this->Js->get('#paging_loader')->effect('fadeIn', array('speed' => 'fast')),
	    						'complete' => $this->Js->get('#paging_loader')->effect('fadeOut', array('speed' => 'fast'))
								));
					//echo $this->Paginator->prev(__(''), array(), null, array('class' => 'left','tag'=>'a','disabledTag' => 'a')); ?>
                    <ul>
                    <?php echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentClass' => 'active','currentTag' => 'li')); ?>
                    </ul>
               <?php //echo $this->Paginator->next(__(''), array(), null, array('class' => 'right','tag'=>'a','disabledTag' => 'a')); ?>
                        </section>
                    </section>                  
                </div>
            </section>
            
            <section class="bottom_container">
            	<div class="wrapper">
                	<section class="middle_box">
                    	<ul>
                        	<li class="active">
                            	<a href="#" class="rest"><span></span><img alt="" src="<?php echo $this->webroot; ?>img/frontend/border3.png" class="bor"></a>
                                <h4>Locate Restuarents</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
                                adipiscing elit. Quisque et nulla odio. 
                                In utor convallis tortor urpis ad.</p>
                            </li>
                        	<li>
                            <a href="#" class="browse"><span></span><img alt="" src="<?php echo $this->webroot; ?>img/frontend/border3.png" class="bor"></a>
                                <h4>Browse Menu</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
                                adipiscing elit. Quisque et nulla odio. 
                                In utor convallis tortor urpis ad.</p>
                            </li>
                        	<li>
                            	<a href="#" class="online"><span></span></a>
                                <h4>Book Online</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
                                adipiscing elit. Quisque et nulla odio. 
                                In utor convallis tortor urpis ad.</p>
                            </li>
                        </ul>
                    </section>
                </div>
            </section>
        </section>
       
<script type="text/javascript">
$(document).ready(function(e) {
	$(".autoscroll").jCarouselLite({
    	auto: 800,
    	speed: 1000
	});	
	$('.main_slider ul li').cycle();
});

function get_filtered_list(num){
	$('.tabbing_sec ul li').removeClass('active');
	$('.tabbing_sec ul li').eq(parseInt(num)-1).addClass('active');
	$.post('<?php echo $this->webroot; ?>restaurants/paging_index/'+num,function(data){
		$('.content_sec').html(data);		
	});	
}
</script>        
<?php echo $this->Js->writeBuffer();?>