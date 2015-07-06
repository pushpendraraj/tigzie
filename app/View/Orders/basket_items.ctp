<?php if(isset($menu) && !empty($menu)){																
		foreach($menu as $mn){	?>
<li>
	<?php if(!empty($mn['Docs'])){ ?>
		<small><img src="<?php  echo $this->webroot.'files/'.$restaurant['Restaurant']['id'].'/'.$mn['Docs'][0]['name']; ?>" width="27" height="27"></small>
	<?php } ?>
	<span><?php echo $mn['Menu']['qty']; ?></span>
	<div class="controls"><a href="javascript://" onclick="update_quantity(<?php echo $mn['Menu']['id']; ?>,<?php echo $mn['Menu']['qty']; ?>,1,<?php echo $restaurant['Restaurant']['id']; ?>);" class="plus"><img src="<?php echo $this->webroot; ?>img/plus.jpg"></a><a href="javascript://" onclick="update_quantity(<?php echo $mn['Menu']['id']; ?>,<?php echo $mn['Menu']['qty']; ?>,2,<?php echo $restaurant['Restaurant']['id']; ?>);" class="minus"><img src="<?php echo $this->webroot; ?>img/minus.jpg"></a></div>
	<h5><?php echo $mn['Menu']['title']; ?></h5>
	<p>(<?php echo wraptext($mn['Menu']['description'],40);?>)</p>
	<h6><?php echo $mn['Menu']['price']*$mn['Menu']['qty'].' '.$restaurant['Restaurant']['currency']; ?></h6>
	<a href="javascript://" onclick="update_quantity(<?php echo $mn['Menu']['id']; ?>,<?php echo $mn['Menu']['qty']; ?>,3,<?php echo $restaurant['Restaurant']['id']; ?>);"></a>
</li>
<input type="hidden" name="data[item][<?php echo $mn['Menu']['id']; ?>]" value="<?php echo $mn['Menu']['qty']; ?>"/>
<?php }}else{ ?>
<li><h4>No item in basket</h4></li>	
<?php } ?>

<li>
	<h4><?php if(isset($totalqty)) echo $totalqty; else echo 0;?> pcs in total price: </h4>
	<h6><?php if(isset($totalprice)) echo $totalprice; else echo 0; echo ' '.$restaurant['Restaurant']['currency']; ?> <small>(including VAT)</small></h6>
</li>
                       