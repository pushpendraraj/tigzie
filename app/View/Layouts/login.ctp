<?php
$siteDescription = __d('cake_dev', 'Menu Composer');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $siteDescription ?>: <?php echo 'Admin Panel'; ?></title>
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css(array('admin/font-awesome.min','admin/bootstrap.min','admin/mvpready-admin','admin/mvpready-flat','validation'));
            echo $this->Html->script(array('admin/libs/jquery-1.10.2.min','admin/libs/bootstrap.min','admin/mvpready-core','admin/mvpready-admin','admin/mvpready-account','admin/jquery.validationEngine','admin/validation-en')); 
        ?>
    </head>
    <body>
        <?php echo $content_for_layout; ?>
    </body>
</html>



