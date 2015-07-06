<?php
$siteDescription = __d('cake_dev', 'Tigzie');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title> <?php echo 'Tigzie'; ?> </title>
		<?php
            echo $this->Html->meta('icon');
            echo $this->Html->css(array('admin/font-awesome.min','admin/bootstrap.min','admin/mvpready-admin','admin/mvpready-flat','validation'));
            echo $this->Html->script(array('admin/libs/jquery-1.10.2.min','admin/libs/bootstrap.min','admin/plugins/flot/jquery.flot','admin/plugins/flot/jquery.flot.tooltip.min','admin/plugins/flot/jquery.flot.pie','admin/plugins/flot/jquery.flot.resize','admin/mvpready-core','admin/mvpready-admin'/*'admin/demos/flot/line','admin/demos/flot/pie','admin/demos/flot/auto'*/,'admin/jquery.validationEngine','admin/validation-en')); 
        ?>
	</head>
	<body>
    	<div id="wrapper">
        	<?php echo $this->element('restaurant_header'); ?>
            <div class="mainnav">
                <div class="container">
  					<?php echo $this->element('restaurant_sidebar'); ?>
                </div> <!-- /.container -->
            </div> <!-- /.mainnav -->  
            <div class="content">
    			<div class="container">
                    <?php echo $content_for_layout; ?>
                </div>
           </div>
		</div> <!-- /.wrapper -->
        <footer class="footer">
          	<div class="container">
            	<p class="pull-left">Copyright &copy; 2015</p>
          	</div>
        </footer>
	</body>
</html>




