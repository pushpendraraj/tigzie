<header class="main_header">
    <div class="wrapper">
     <a href="<?php echo $this->webroot; ?>"><span><img src="<?php echo $this->webroot; ?>img/logo/logo-gastrogroup.png" height="50" width="200" align="left" class="logo"></span></a>
        <nav>
        	<?php $cont=$this->params['controller'];
					$action=$this->params['action'];
			 ?>
             
            <ul>
                <li class="<?php if($cont=='restaurants' && $action=='index') echo 'active'; ?>"><a href="<?php echo $this->webroot; ?>"><img src="<?php echo $this->webroot; ?>img/frontend/restaurent.png"><span>Restaurants</span></a></li>
                <li class="<?php if($cont=='deals') echo 'active'; ?>"><a href="<?php echo $this->webroot; ?>deals/index"><img src="<?php echo $this->webroot; ?>img/frontend/bestdeal.png"><span>Best Deals</span></a></li>
                <li class="<?php if(($cont=='restaurants' && $action=='compose_menu') || ($cont=='orders')) echo 'active'; ?>"><a href="<?php if(isset($cookie_basket)) echo $this->webroot.'restaurants/compose_menu'; else echo 'javascript://';  ?>" onclick="<?php if($cont=='restaurants' && $action=='index' && !isset($cookie_basket)) echo " $('html,body').animate({scrollTop: $('.product_sec').offset().top-100},'slow');";?>"><img src="<?php echo $this->webroot; ?>img/frontend/your_menu.png"><span>Your Menu</span></a></li>
                <li class="<?php if($cont=='info') echo 'active'; ?>"><a href="<?php echo $this->webroot; ?>info/support"><img src="<?php echo $this->webroot; ?>img/frontend/support.png"><span>support</span></a></li>
                <li class="login_menu">
                	<a href="#"><img src="<?php echo $this->webroot; ?>img/frontend/login.png"><span class="basket">Login</span></a>
                	<section class="submenu_sec">
                    <form name="LoginForm" id="LoginForm" action="<?php echo $this->webroot; ?>login/verify_login" method="post">
                        <section class="menu_space">
                            <ul>
                                <li>                                	
                                	<input type="text" name="data[Login][username]" class="validate[required]" placeholder="Username"/>
                                    
                                </li>
                                <li>
                                    <input type="password" name="data[Login][password]" class="validate[required]" placeholder="Password"/>
                                </li>
                                <li class="last">
                                    <select name="data[Login][user_role_id]" class="validate[required]">
                                    <option value="">Select Role</option>
                                    <option value="2">Restaurant</option>
                                    <option value="3">Agent</option>
                                    </select>
                                </li>
                            </ul>
                            <a href="javascript://" onclick="submit_login();" class="check">Login</a>
                        </section>
                        </form>
                    </section>
                </li>
            </ul>
        </nav>
    </div>
</header>

<script type="text/javascript">
$(document).ready(function(e) {
	$('body').click(function(d){
		var clickedOn = $(d.target);
		if (clickedOn.parents().andSelf().is('.submenu_sec') || clickedOn.parents().andSelf().is('.login_menu') || clickedOn.parents().andSelf().is('#LoginForm')){  }else{
			 $('.submenu_sec').hide('slow');
		}
	});
	
    $("#LoginForm").validationEngine({promptPosition: "topRight"});
	$('.login_menu').click(function(e) {
        $('.submenu_sec').show('slow');
    });
	
	
});

function submit_login(){
	var valid = $("#LoginForm").validationEngine('validate');	
	if(valid){		
		$('#LoginForm').submit();		
	}else{
		$("#LoginForm").validationEngine({promptPosition: "topRight"});	
	}
}
</script>