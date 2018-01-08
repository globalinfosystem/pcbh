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
	.success-message {
		color:#00CC66;
		 text-align:center;
		 width:100%;
   }
  .error-message {
		color:red;
		 text-align:center;
		 width:100%;
   }
</style>
<?php $key = SB_controller::encodekey(); ?>
<div class="sbox">
    <div class="sbox-title">

        <h3 ><?php echo CNF_APPNAME . '<small> ' . CNF_APPDESC . ' </small>'; ?></h3>

    </div>
    <div class="sbox-content">
	<h3 class="success-message"> <?php echo $this->session->flashdata('success'); ?></h3>
       <h3 class="error-message"><?php echo $this->session->flashdata('errors'); ?></h3>
        <div class="text-center">
            <img src="<?php echo base_url(); ?>design/themes/mango/img/logo.png" width="100" />
        </div>	
       
        <?php echo form_open('user/forget_password', array('id' => 'forget_form')); ?>

        <div class="form-group has-feedback">
            <label> Email Address	</label>
            <input type="email" name="email" id="email" value="" autocomplete="off" class="form-control" placeholder="Email Address" required>
            <i class="fa fa-envelope form-control-feedback"></i>
        </div>

        	
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input type="hidden" name="loginval" id="loginval" />
        <div class="form-group  has-feedback text-center" style=" margin-bottom:20px;" >
          <button type="submit" class="btn btn-primary btn-sm btn-block" id="loginbutton" > Submit</button>

         <div class="clr"></div>

        </div>	
		
    </div>		  


    <?php echo form_close(); ?>  
    
    <div class="clr"></div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#or').click(function () {
            $('#fr').toggle();
        });
    });

</script>