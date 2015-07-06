<?php
$siteDescription = __d('cake_dev', 'Menu Composer');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php echo $this->Html->charset(); ?>
<title> <?php echo 'Tigzie'; ?> </title>
<?php
echo $this->Html->meta('icon');
echo $this->Html->css(array('bootstrap-cerulean','bootstrap-responsive','index-app','jquery-ui-1.8.21.custom','fullcalendar','fullcalendar.print','chosen','uniform.default','colorbox','jquery.cleditor','jquery.noty','noty_theme_default','elfinder.min','elfinder.theme','jquery.iphone.toggle','opa-icons','uploadify','validation'));
echo $this->Html->script(array('jquery.min','jquery-ui-1.8.21.custom.min','bootstrap-transition','bootstrap-alert','bootstrap-modal','bootstrap-dropdown','bootstrap-scrollspy','bootstrap-tab','bootstrap-tooltip','bootstrap-popover','bootstrap-button','bootstrap-collapse','bootstrap-carousel','bootstrap-typeahead','bootstrap-tour','jquery.cookie','fullcalendar.min','jquery.dataTables.min','excanvas','jquery.flot.min','jquery.flot.pie.min','jquery.flot.stack','jquery.flot.resize.min','jquery.chosen.min','jquery.uniform.min','jquery.colorbox.min','jquery.cleditor.min','jquery.noty','jquery.elfinder.min','jquery.raty.min','jquery.iphone.toggle','jquery.autogrow-textarea','jquery.uploadify-3.1.min','jquery.history','jquery.validationEngine','validation-en','index','custom'));
?>
<style type="text/css">
body{padding-bottom: 20px; }
.sidebar-nav {padding: 9px 0; }
</style>
</head>
<body>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo $this->webroot; ?>admin/dashboard">
				<?php echo $this->Html->image('logo/logo-gastrogroup.png',array('escape'=>false)); ?></a>
				<?php echo $this->element('headerbar');?>
					
                <div class="title">Welcome To Admin Panel</div><!--/.title -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
<div class="container-fluid">
		<div class="row-fluid height">
		<!-- left menu starts -->
		<?php echo $this->element('admin_sidebar');?>
        <!-- left menu ends -->
   <?php echo $content_for_layout; ?>
   </div>
</div>

</body>
</html>



