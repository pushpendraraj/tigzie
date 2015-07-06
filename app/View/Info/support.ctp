<section id="body_container">

            <section class="order_box order_box_1">
            	<div class="wrapper">
                	<div class="title_row">
                        <span></span>
                        <h3>Leave your message</h3>
                    </div> 
                    <div id="msgDiv" style="display:none;">Thank you for leaving a message. We'll get back to you soon</div>
                    <form id="messageForm" name="messageForm" action="<?php echo $this->webroot; ?>info/support" method="post">                                       
                    <ul>
                    	<li class="first"><span><input type="text" name="first_name" class="validate[required]" placeholder="First Name"></span></li>
                        <li class="first"><span><input type="text" name="last_name" class="validate[required]" placeholder="Last Name"></span></li>
                         <li><span><input type="text" name="email" class="validate[required,custom[email]]" placeholder="Email"></span></li>
                         <li><span><input type="text" name="phone" class="validate[required]" placeholder="Phone"></span></li>
                        
                        <li class="full"><strong class="msg"><textarea placeholder="Message" name="message"></textarea></strong></li>
                        <li class="full"><a href="javascript://" id="message_submit" onclick="submit_frm();">Submit</a></li>
                        
                    </ul>
                   	 
                    </form> 
                    
                    <section class="support_box">
                    	<h4>Contact us</h4>
                        <ul>
                        	<li>Menu composer</li>
                        	<li>1400 abc Street</li>
                        	<li>ABC Estates, AB 123456</li>
                        </ul>
                        <ul>
                        	<li>Phone: 1234567890</li>
                        	<li>Fax: 1234567899</li>
                        </ul>
                        <ul>
                        	<li>support@menucomposer.com</li>
                        </ul>
                    </section>                 
                </div>
            </section>            
            
            
            
            <section class="bottom_container">
            	<div class="wrapper">
                	
                    
                </div>
            </section>
            </form>
        </section>
        
<script type="text/javascript">
$(document).ready(function(e) {
    $("#messageForm").validationEngine({promptPosition: "topRight"});
});

function submit_frm(){
	var valid = $("#messageForm").validationEngine('validate');
	if(valid)
	{
		$('#message_submit').hide();
		$.post('<?php echo $this->webroot; ?>info/support',$('#messageForm').serialize(),function(data){
			$('#messageForm').fadeOut();
			$('#msgDiv').fadeIn();	
		});
		
	}else{
		$("#messageForm").validationEngine({scroll:false,focusFirstField : false});
	}
}
</script>        