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

        <h3 ><?php echo CNF_APPNAME; ?></h3>

    </div>
    <div class="sbox-content">
        <div class="text-center">
            <img src="<?php echo base_url(); ?>design/themes/mango/img/logo.png" width="100" />
        </div>	
        <?php echo $this->session->flashdata('message'); ?>	
        <ul class="parsley-error-list">
            <?php echo $this->session->flashdata('errors'); ?>
        </ul>
        <form class="form-signup" id="login_form" action="<?php echo site_url('user/create'); ?>" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <div class="form-group has-feedback">
                <label> First Name	<span class="asterix">*</span> </label>
                <?php echo form_input(array('name' => 'firstname', 'placeholder' => 'First Name', 'required' => 'true', 'class' => 'form-control')); ?>
                <i class="icon-users form-control-feedback"></i>
            </div>

            <div class="form-group has-feedback">
                <label> Last Name	 <span class="asterix">*</span></label><br />
                <?php echo form_input(array('name' => 'lastname', 'placeholder' => 'Last Name', 'required' => 'true', 'class' => 'form-control')); ?>
                <i class="icon-users form-control-feedback"></i>
            </div>

            <div class="form-group has-feedback">
                <label> Email Address	 <span class="asterix">*</span></label>
                <?php echo form_input(array('name' => 'email', 'placeholder' => 'Email Address', 'required' => 'true', 'class' => 'form-control')); ?>
                <i class="icon-envelop form-control-feedback"></i>
            </div>

            <div class="form-group has-feedback">
                <label> Password <span class="asterix">*</span></label>
                <?php echo form_password(array('name' => 'password', 'placeholder' => 'Password', 'required' => 'true', 'class' => 'form-control', 'id' => 'password', 'autocomplete' => 'off')); ?>
                <i class="icon-lock form-control-feedback"></i>
            </div>

            <div class="form-group has-feedback">
                <label>Confirm Password <span class="asterix">*</span></label>
                <?php echo form_password(array('name' => 'password_confirmation', 'placeholder' => 'Confirm Password', 'required' => 'true', 'class' => 'form-control', 'id' => 'cpassword', 'autocomplete' => 'off')); ?>
                <i class="icon-lock form-control-feedback"></i>
            </div>

            <div class="form-group has-feedback">
                <label> Captcha	</label>
                <?php $captchaCode = rand(10000, 10000000); ?>
                <input name="captcha" required="required" type="text" id="captcha" autocomplete="off" class="form-control input-sm" placeholder="please enter below text here" />  
                <br><i style="font-weight:bold; font-size:30px;" unselectable="on" class="unselectable"><?php echo $captchaCode; ?></i>
                <input type="hidden" name="captchatext" id="captchatext" readonly="readonly" value="<?php echo $captchaCode; ?>" style="border:none;" />

            </div>
            <div class="row form-actions">
                <div class="col-sm-12">
                    <button type="button" id="registerbutton" style="width:100%;" class="btn btn-primary pull-right"><i class="icon-user-plus"></i> Sign Up</button>
                </div>
            </div>
            <p style="padding:10px 0" class="text-center">
                <a href="<?php echo site_url('user/login'); ?>"> Back to Login </a> | <a href="<?php echo site_url(); ?>"> Back to Site </a> 
            </p>
        </form>
    </div>
</div> 
<script type="text/javascript">
    $(document).ready(function () {

        $('#password').change(function () {
            var encpass = $().crypt({method: "b64enc", source: $("#password").val()});
            var data = $().crypt({method: "b64enc", source: encpass});
            data += '<?php echo $key; ?>&' + data;

            $('#password').val(data);
        });



        $('#cpassword').change(function () {
            var enccpass = $().crypt({method: "b64enc", source: $("#cpassword").val()});
            var data = $().crypt({method: "b64enc", source: enccpass});
            data += '<?php echo $key; ?>&' + data;

            $('#cpassword').val(data);
        });



        $("#registerbutton").click(function () {
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();
            var captcha=$('#captcha').val();
             var captchatext=$('#captchatext').val();
            // var encpass = $().crypt({method: "b64enc", source: password});
            //  var encpassword = $().crypt({method: "b64enc", source: encpass});

            //   var enccpass = $().crypt({method: "b64enc", source: cpassword});
            //var enccpassword = $().crypt({method: "b64enc", source: enccpass});
            captcha=$().crypt({method: "b64enc", source: captcha});
            captcha=$().crypt({method: "b64enc", source: captcha});
                 captchatext=$().crypt({method: "b64enc", source: captchatext});
                  captchatext=$().crypt({method: "b64enc", source: captchatext});
            $('#captcha').val(captcha);
            $('#captchatext').val(captchatext);
         
        //    $('#cpassword').val(cpassword);
         //   $('#password').val(password);
            $('#login_form').submit();

        });
    });




    $(function () {
        $("[name=firstname]").keyup(function ()
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


        $("[name=lastname]").keyup(function ()
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



        $("[name=password]").keyup(function ()
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



        $("[name=password_confirmation]").keyup(function ()
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



        $("[name=captcha]").keyup(function ()
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