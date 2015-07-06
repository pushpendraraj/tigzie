<?php
$siteDescription = __d('cake_dev', 'Menu Composer');
?>
<!DOCTYPE HTML>
<html>
<head>

<?php echo $this->Html->charset(); ?>
<title> <?php echo $siteDescription ?>: <?php echo $title_for_layout; ?> </title>
<?php
echo $this->Html->meta('icon');
echo $this->Html->css(array('frontend_restaurant','fonts','jquery-ui-1.9.2.custom.min','validation'));
echo $this->Html->script(array('jquery.min','jquery-ui-1.9.2.custom.min','jcarousal.pack','jquery.cycleall','validation-en','jquery.validationEngine'));
?>

</head>
<body>
	<?php 
		  echo $this->element('menu_header');
		  echo $content_for_layout;
		  echo $this->element('menu_footer');			  
	?>
</body>
</html>



