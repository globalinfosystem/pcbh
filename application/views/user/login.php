<script type='text/javascript' src='<?php echo base_url() ?>design/js/jquery.crypt.js'></script>
<style>
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
</style>
<?php $key = SB_controller::encodekey(); ?>
<div class="sbox">
    <div class="sbox-title">

        <h3 ><?php echo CNF_APPNAME . '<small> ' . CNF_APPDESC . ' </small>'; ?></h3>

    </div>
    <div class="sbox-content">
        <div class="text-center">
            <img src="<?php echo base_url(); ?>design/themes/mango/img/logo.png" width="100" />
        </div>	
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open('user/postlogin', array('id' => 'login_form')); ?>

        <div class="form-group has-feedback">
            <label> Email Address	</label>
            <input type="text" name="email" id="email" value="" autocomplete="off" class="form-control" placeholder="Email Address">
            <i class="fa fa-envelope form-control-feedback"></i>
        </div>

        <div class="form-group has-feedback">
            <label> Password	</label>
            <input type="password" name="password" id="password" autocomplete="off" value="" class="form-control"  placeholder="Password">
            <i class="icon-lock form-control-feedback"></i>
        </div>	
        <div class="form-group has-feedback">
            <label> Captcha	</label>
            <?php $captchaCode = rand(10000, 10000000); ?>
            <input name="captcha" required="required" type="text" id="captcha" autocomplete="off" class="form-control input-sm" placeholder="please enter below text here" />  
            <br><i style="font-weight:bold; font-size:30px;" unselectable="on" class="unselectable"><?php echo $captchaCode; ?></i>
            <input type="hidden" name="captchatext" id="captchatext" readonly="readonly" value="<?php echo $captchaCode; ?>" style="border:none;" />

        </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input type="hidden" name="loginval" id="loginval" />
        <div class="form-group  has-feedback text-center" style=" margin-bottom:20px;" >

            <button type="button" class="btn btn-primary btn-sm btn-block" id="loginbutton" > Sign In</button>

            <a href="<?php echo base_url()?>user/forget_password">Forget Password</a>

            <div class="clr"></div>

        </div>	
<!--        <p class="text-center"><a  id="or"  href="javascript://ajax"><small>Forgot password?</small></a></p>
        <p class="text-muted text-center">Do not have an account?</p>				
        <a class="btn btn-default btn-white btn-white btn-block"  href="<?php echo site_url('user/register'); ?>"> Create an account </a>

        <p style="padding:10px 0" class="text-center">
            <a href="<?php echo site_url(); ?>"> Back to Site </a>  
        </p>-->			
    </div>		  


    <?php echo form_close(); ?>  
    <!--<div style="padding:20px;">
        <form class="form-vertical box" action="<?php echo site_url('user/saveRequest'); ?>" id="fr" method="post" style="margin-top:20px; display:none;">


            <div class="form-group has-feedback">
                <div class="">
                    <label> Email Address </label>
                    <input type="text" name="credit_email" value="" class="form-control">
                    <i class="icon-envelope form-control-feedback"></i>
                </div> 	
            </div>
            <div class="form-group has-feedback">        
                <button type="submit" class="btn btn-danger ">Reset My Password  </button>        
            </div>

            <div class="clr"></div>

        </form>
    </div>-->

    <div class="clr"></div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#or').click(function () {
            $('#fr').toggle();
        });
    });

    $(document).ready(function () {



        $('#password').change(function () {
            var encpass = $().crypt({method: "b64enc", source: $("#password").val()});
            var data = $().crypt({method: "b64enc", source: encpass});
            data += '<?php echo $key; ?>&' + data;
            $('#loginval').val(data);
            $('#password').val(data);
        });
        $("#loginbutton").click(function () {
            var user = $('#user').val();
            var password = $('#password').val();
            var captchatext = $('#captchatext').val();
            var captcha = $('#captcha').val();

//            if (password) {
//                var encpass = $().crypt({method: "b64enc", source: $("#password").val()});
//                var data = $().crypt({method: "b64enc", source: encpass});
//                data += '<?php echo $key; ?>&' + data;
//                $('#loginval').val(data);
//                $('#password').val(data);
//            }
            if (captchatext) {
                var enccaptcha = $().crypt({method: "b64enc", source: captcha});
                var captcha_data = $().crypt({method: "b64enc", source: enccaptcha});
                captcha_data += '<?php echo $key; ?>&' + captcha_data;
                $('#captcha').val(captcha_data);
            }

            if (captchatext) {
                var enccaptchatext = $().crypt({method: "b64enc", source: captchatext});
                var captchatext_data = $().crypt({method: "b64enc", source: enccaptchatext});
                captchatext_data += '<?php echo $key; ?>&' + captchatext_data;
                $('#captchatext').val(captchatext_data);
            }

            $('#login_form').submit();

        });
    });



    $(function () {
        $("[name=captcha]").keyup(function ()
        {
            var yourInput = $(this).val();
            re = /[<\>]/gi;
            var isSplChar = re.test(yourInput);
            if (isSplChar)
            {
                var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                $(this).val(no_spl_char);
            }
        });


        $("[name=password]").keyup(function ()
        {
            var yourInput = $(this).val();
            re = /[<\>]/gi;
            var isSplChar = re.test(yourInput);
            if (isSplChar)
            {
                var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                $(this).val(no_spl_char);
            }
        });


        $("[name=email]").keyup(function ()
        {
            var yourInput = $(this).val();
            re = /[<\>(\)]/gi;
            var isSplChar = re.test(yourInput);
            if (isSplChar)
            {
                var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                $(this).val(no_spl_char);
            }
        });
    });





</script>