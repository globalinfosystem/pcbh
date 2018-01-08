<?php $this->load->view('layouts/'.CNF_THEME.'/header', array('pageAlias' => (!empty($pageAlias)) ? $pageAlias : '', 'pageTitle' => (!empty($pageTitle)) ? $pageTitle : '')); ?>
<script type='text/javascript' src='<?php echo base_url() ?>design/js/jquery.crypt.js'></script>
<link href="<?php echo base_url();?>design/themes/<?php echo CNF_THEME; ?>/checkboxcustom/skins/allf700.css?v=1.0.1" rel="stylesheet">
<script src="<?php echo base_url();?>design/themes/<?php echo CNF_THEME; ?>/checkboxcustom/icheckf700.js?v=1.0.1"></script>
<style>
#heading_text
{
	text-align:center;
}
*.unselectable {
   -moz-user-select: -moz-none;
   -khtml-user-select: none;
   -webkit-user-select: none;

   /*
     Introduced in IE 10.
     See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
   */
   -ms-user-select: none;
   user-select: none;
   
    font-family: Georgia;
    font-size: 55px;
    font-weight: bold;
    text-decoration: line-through;
	
}
.iradio_line-green{width: auto !important;}
</style>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12  top-space" id="center">
                <div class="suggestions">       
                    <div class="title-bar green-bar"> <h3 id="heading_text">Login Haryana State Pollution Control Board</h3></div>     
                    <div class="share-blk"> 
                        <div id="suggestionsuccessfull">
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-danger">
                                   <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>
                        </div>
						<?php
						if(isset($_GET['new']) && $_GET['new']=="y")
						{
						echo "<b style='color:red; text-align:center;'>Please check your mail for login details.</b>";
						}
						?>
                        <form method="post" id="login_form" class="form_login">   
							<input type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>">						
                            <div id="admin_login">
                                <div class="form-group">          
                                    <input type="text" placeholder="Username" name="username" id="username" autocomplete="off" class="form-control"> 
                                    <?php echo form_error('username'); ?>
                                </div> 
                                <div class="form-group">   
                                    <input placeholder="Password" name="admin_password" id="admin_login_password" autocomplete="off" type="password" class="form-control"> 
                                    <?php echo form_error('admin_password'); ?>
                                </div>   
                            </div>
							
							 <div class="form-group has-feedback">
								<?php $captchaCode = rand(10000,10000000);?>
								<input name="captcha" required="required" type="text" id="captcha" autocomplete="off" class="form-control input-sm" placeholder="please enter below text here" />  
								<br><i style="font-weight:bold; font-size:55px;" unselectable="on" class="unselectable"><?php echo $captchaCode; ?></i>
								<input type="hidden" name="captchatext" id="captchatext" readonly="readonly" value="<?php echo $captchaCode; ?>" style="border:none;" />
							</div>
								<button class="btn btn-primary ftbtn1" type="button" id="login_button">Login</button>   
								<br><br><br>
						</form>
                    </div>      
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#login_button").click(function () {
            var admin_login = $('#admin_login_password').val();
            var captchatext = $('#captchatext').val();
            var captcha = $('#captcha').val();
			
			
			if(admin_login){
				var encadmin_login_password = $().crypt({method: "b64enc", source: admin_login});
				var admin_login_password_data = $().crypt({method: "b64enc", source: encadmin_login_password});
				$('#admin_login_password').val(admin_login_password_data);
			}
			
			if(captchatext){
				var enccaptcha = $().crypt({method: "b64enc", source: captcha});
				var captcha_data = $().crypt({method: "b64enc", source: enccaptcha});
				$('#captcha').val(captcha_data);
			}
			
			if(captcha){
				var enccaptchatext = $().crypt({method: "b64enc", source: captchatext});
				var captchatext_data = $().crypt({method: "b64enc", source: enccaptchatext});
				$('#captchatext').val(captchatext_data);
			}
			
            $('#login_form').submit();

        });
    });

</script>

<?php $this->load->view('layouts/'.CNF_THEME.'/footer'); ?>   