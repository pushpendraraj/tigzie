<header class="navbar navbar-inverse" role="banner">
	<div class="container">
      	<div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <i class="fa fa-cog"></i>
            </button>
            <a href="<?php echo $this->webroot; ?>admin" class="navbar-brand navbar-brand-img">
              	<img src="<?php echo $this->webroot; ?>img/logo/logo-gastrogroup.png" alt="Admin Ready">
            </a>
      	</div> <!-- /.navbar-header -->
     	<?php
			$panel='';
			 if(isset($user_role_id)){
				if($user_role_id=='1')	$panel='<br>Super Admin Panel';
				if($user_role_id=='2')	$panel='<br>Business Admin Panel';
				if($user_role_id=='3')	$panel='<br>Agent Panel';
			}
		?>
      	<nav class="collapse navbar-collapse" role="navigation">   
        	<ul class="nav navbar-nav navbar-right">     
          		<li>
            		<a target="_blank" href="<?php echo $this->webroot; ?> "><i class="fa fa-angle-double-left"></i> &nbsp;Back to Home</a>
          		</li>   
        	</ul>
      	</nav>
    </div> <!-- /.container -->
</header>
<div id="sign_in" class="account-wrapper">
	<div class="account-body">
      	<h3>Welcome to <?php echo $panel; ?></h3>
     	<h5>Please login with your Username and Password.</h5>
      	<?php echo $this->Session->flash(); ?>
       	<?php echo $this->Form->create('LoginForm',array('url'=>array('controller'=>'login','action'=>'verify_login'),'class'=>'form account-form')); ?>
       	<?php echo $this->Form->input('Login.user_role_id',array('type'=>'hidden','value'=>$user_role_id)); ?>
        <?php echo $this->Form->input('Login.username',array('type'=>'text','label'=>false,'div'=>array('class'=>'form-group'),'class'=>'form-control validate[required]','id'=>'username','placeholder'=>'Username')); 
		?>
        <?php echo $this->Form->input('Login.password',array('label'=>false,'div'=>array('class'=>'form-group'),'class'=>'form-control validate[required]','id'=>'password','placeholder'=>'Password')); ?>  
        <div class="form-group clearfix">
          	<div class="pull-left">					
                <label class="checkbox-inline">
                	<input type="checkbox" class="" value="" tabindex="3"> <small>Remember me</small>
                </label>
          	</div>
            <div class="pull-right">
                <?php if($user_role_id!=3){ ?>
                    <a href="javascript:void(0);" onclick="javascript:$('#sign_in').hide();$('#forgate_pass').show();">Forgot Password?</a>
                <?php }else{ ?>
                    <small><a href="<?php echo $this->webroot; ?>agent-registration">New Agent : Register here</a></small>
                <?php } ?>
            </div>
		</div> <!-- /.form-group -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg">
                    <i class="fa fa-play-circle"></i> Sign In
            </button>
        </div> <!-- /.form-group -->
     	<?php echo $this->Form->end(); ?>
    </div> <!-- /.account-body -->
</div> <!-- /.account-wrapper -->

<!-- Forgot password form #start --->

<div id="forgate_pass" class="account-wrapper">
	<div class="account-body">
		<h3>Password Reset</h3>
      	<h5>Please enter your Username.</h5>
     	<div id="forgot_status"><?php echo $this->Session->flash(); ?></div>
        <?php echo $this->Form->create('ForgetPassForm',array('url'=>array('controller'=>'login','action'=>'forget_password'),'onsubmit'=>'return forget_pass()','class'=>'form account-form'));?>
       	<?php echo $this->Form->input('user_role_id',array('type'=>'hidden','value'=>$user_role_id)); ?>
        <?php echo $this->Form->input('username',array('type'=>'text','label'=>false,'div'=>array('class'=>'form-group'),'class'=>'form-control  validate[required]','id'=>'username','placeholder'=>'Username')); ?>   
        <?php echo $this->Form->input('code',array('type'=>'text','label'=>false,'div'=>array('class'=>'form-group'),'class'=>'form-control validate[required]','id'=>'code','placeholder'=>'Security Code')); ?>  
        <div class="form-group">
          	<?php echo $this->Html->image($this->Html->url(array('controller'=>'login', 'action'=>'captcha'), true),array('style'=>'','id'=>'img_captcha','vspace'=>2)); ?>
        </div> <!-- /.form-group -->
        <div class="form-group clearfix">
        	<div class="pull-left">
            	<a id="a-reload" href="javascript://"  style="margin-left:10px; color: #828284; font-size:14px;"><?php echo __('Reload security code'); ?> 
            </div>
        	<div class="pull-right">
         		<a href="javascript:void(0);" onclick="javascript:$('#sign_in').show();$('#forgate_pass').hide();"><i class="fa fa-angle-double-left"></i> Back to Login</a>
          	</div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-secondary btn-block btn-lg">
                    <i class="fa fa-refresh"></i> Reset Password   
            </button>
        </div> <!-- /.form-group -->
     	<?php echo $this->Form->end(); ?>  
    </div> <!-- /.account-body -->
</div> <!-- /.account-wrapper -->
         
<script type="text/javascript">
$(document).ready(function() {
	$('#forgate_pass').hide();
    $("#LoginFormRestaurantLoginForm").validationEngine({promptPosition: "topRight"});
	$("#ForgetPassFormRestaurantLoginForm").validationEngine({promptPosition: "topRight"});
	 $('#a-reload').click(function() {
          var $captcha = jQuery("#img_captcha");
            $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
          return false;
        });
});

function forget_pass(){
	var valid = $("#ForgetPassFormRestaurantLoginForm").validationEngine('validate');
	if(valid){
		$('#forgot_status').html('<img src="<?php echo $this->webroot; ?>img/loading1.gif" />');
		$.post('<?php echo $this->webroot; ?>login/forget_pass',$('#ForgetPassFormRestaurantLoginForm').serialize(),function(data){
			if(data=='success'){
				$('#forgot_status').html('<div class="alert alert-success"><strong> Thank You ! </strong> Password updated, a confirmation email has been send to you.  <button data-dismiss="alert" class="close" type="button">×</button></div>');				
			}else if(data=='code'){
				$('#forgot_status').html('<div class="alert alert-danger"><strong> Sorry ! </strong> Invalid Captcha Value.  <button data-dismiss="alert" class="close" type="button">×</button></div>');
			}else if(data=='error'){
				$('#forgot_status').html('<div class="alert alert-danger"><strong> Sorry ! </strong> Invalid Username.  <button data-dismiss="alert" class="close" type="button">×</button></div>');
			}else{
				$('#forgot_status').html('<div class="alert alert-danger"><strong> Sorry ! </strong> There is some issue. Please try again later.  <button data-dismiss="alert" class="close" type="button">×</button></div>');
			}	
		});		
	}else{
		$("#ForgetPassFormRestaurantLoginForm").validationEngine({promptPosition: "topRight"});
	}
	return false;
}
</script>            