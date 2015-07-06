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
   // echo $this->Paginator->prev(__(''), array(), null, array('class' => 'left','tag'=>'a','disabledTag' => 'a')); ?>
    <ul>
    <?php echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentClass' => 'active','currentTag' => 'li')); ?>
    </ul>
    <?php 
   // echo $this->Paginator->next(__(''), array(), null, array('class' => 'right','tag'=>'a','disabledTag' => 'a'));
    
        ?>
</section>
        
 <?php echo $this->Js->writeBuffer();?>        