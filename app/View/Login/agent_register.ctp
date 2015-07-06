<style>
#flashMessage{ color:#f00; }
.form-horizontal .controls {margin-left: 141px;}
</style>
<div id="content" class="span10">
<div class="row-fluid">
				<div class="well span5 center login-box" id="sign_in">
					<div class="alert alert-info">
						Fill below form to complete registration.<br>
                        <?php echo $this->Session->flash(); ?>
					</div>
                    
                    <?php echo $this->Form->create('RegisterForm',array('url'=>array('controller'=>'login','action'=>'agentRegistration'),'class'=>'form-horizontal none')); ?>
						   <div class="control-group" >
                            <label class="control-label" >Name: * </label>								
                                <?php echo $this->Form->input('Agent.name',array('type'=>'text','label'=>false,'div'=>'controls','class'=>'input-large  validate[required]','id'=>'name')); ?>                            
							</div>
							<div class="clearfix"></div>

							<div class="control-group" title="Email" data-rel="tooltip">
                            <label class="control-label" >Email: * </label>								
                                <?php echo $this->Form->input('User.email',array('type'=>'text','label'=>false,'div'=>'controls','class'=>'input-large  validate[required,custom[email]]','id'=>'email')); ?>                            
							</div>
							<div class="clearfix"></div>
                            
                            <div class="control-group" title="Username" data-rel="tooltip">
                            <label class="control-label" >Username: * </label>								
                                <?php echo $this->Form->input('User.username',array('type'=>'text','label'=>false,'div'=>'controls','class'=>'input-large  validate[required]','id'=>'username')); ?>                                                    
							</div>                            
							<div class="clearfix"></div>
                            
                            <div class="control-group" title="Phone" data-rel="tooltip">
                            <label class="control-label" >Phone: </label>								
                                <?php echo $this->Form->input('Agent.phone',array('type'=>'text','label'=>false,'div'=>'controls','id'=>'phone')); ?>                            
							</div>
							<div class="clearfix"></div>
                            
                            <div class="control-group" title="Country" data-rel="tooltip">
                            <label class="control-label" >Country: * </label>								
                                <?php echo $this->Form->input('Agent.country_id',array('options'=>$countries,'label'=>false,'div'=>'controls','class'=>'input-large  validate[required]','id'=>'country','onchange'=>'get_cities(this.value);')); ?>                            
							</div>
							<div class="clearfix"></div>
                            
                            <div class="control-group" title="City" data-rel="tooltip">
                            <label class="control-label" >City: * </label>								
                                <?php echo $this->Form->input('Agent.city_id',array('options'=>array(''=>'Select City'),'label'=>false,'div'=>'controls','class'=>'input-large  validate[required]','id'=>'cities','onchange'=>'check_other_city(this.value);')); ?>                            
							</div>
							<div class="clearfix"></div>
                            
                            <div class="control-group city_div" title="City" data-rel="tooltip"  style="display:none;">
                            <label class="control-label" >Specify City: * </label>								
                                <?php echo $this->Form->input('Agent.city_other',array('type'=>'text','label'=>false,'div'=>'controls','class'=>'input-large','id'=>'cities_other')); ?>                            
							</div>
							<div class="clearfix"></div>                         
                                                 
                            
                             <div class="control-group" title="Password" data-rel="tooltip">
                            <label class="control-label" >Password: * </label>								
                                <?php echo $this->Form->input('User.password',array('type'=>'password','label'=>false,'div'=>'controls','class'=>'input-large  validate[required]','id'=>'password')); ?>                            
							</div>
							<div class="clearfix"></div>
                            
                            <div class="control-group" title="Confirm Password" data-rel="tooltip">
                            <label class="control-label" >Confirm Password: * </label>								
                                <?php echo $this->Form->input('User.confirm_password',array('type'=>'password','label'=>false,'div'=>'controls','class'=>'input-large  validate[required,equals[password]]','id'=>'confirm_password')); ?>                            
							</div>
							<div class="clearfix"></div>
                            
                            <div class="control-group" title="Security Code" data-rel="tooltip">
                            <label class="control-label" >Security Code: * </label>								
                                <?php echo $this->Form->input('User.security_code',array('type'=>'text','label'=>false,'div'=>'controls','class'=>'input-large  validate[required]','id'=>'code')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                                                         
							</div>
							<div class="clearfix"></div>
                            
                            <div class="control-group" title="Security Code" data-rel="tooltip">
                            
                             <?php echo $this->Html->image($this->Html->url(array('controller'=>'login', 'action'=>'captcha'), true),array('style'=>'','id'=>'img_captcha','vspace'=>2)); ?><br><a id="a-reload" href="javascript://"  style="margin-left:10px; color: #828284; font-size:14px;"><?php echo __('Reload security code'); ?>               
                            </div>							
							<div class="clearfix"></div>
                            
							<p class="center span5">
                            <?php echo $this->Form->button('Register',array('type'=>'submit','class'=>'btn btn-primary')); ?>
							</p>
						<?php echo $this->Form->end(); ?>                    
                    	<a href="<?php echo $this->webroot; ?>agent">Already have an account: Login here</a>                    
				</div>                             
			</div>
<script type="text/javascript">

$(document).ready(function(e) {
    $("#RegisterFormAgentRegistrationForm").validationEngine({promptPosition: "topRight"});
	 <?php if($this->Form->value('Agent.country_id')){?>
	 get_cities('<?php echo $this->Form->value('Agent.country_id');?>');
	 <?php }?>
	 $('#a-reload').click(function() {
          var $captcha = jQuery("#img_captcha");
            $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
          return false;
        });
});

function get_cities(country){
	if(country!=''){
		$.post('<?php echo $this->webroot; ?>users/get_cities',{country_code:country},function(data){
			$('#cities').html(data);
			 <?php if($this->Form->value('Agent.city_id')){?>
	 				$('#cities option[value=<?php echo $this->Form->value('Agent.city_id');?>]').attr('selected',true);
	 		<?php }?>	
		});	
	}	
}

function check_other_city(val){
	if(val=='others'){
		$('#cities').removeClass('validate[required]');
		$('#cities_other').addClass('validate[required]');
		$('.city_div').show();	
	}else{
		$('#cities_other').removeClass('validate[required]');
		$('#cities').addClass('validate[required]');
		$('.city_div').hide();	
	}	
}

</script>            