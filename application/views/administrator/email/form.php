<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
            <li><a href="<?php echo site_url('administrator/email') ?>"><?php echo $pageTitle ?></a></li>
            <li class="active"> Form </li>
        </ul>  	  
    </div>

    <div class="page-content-wrapper m-t">
        <?php echo $this->session->flashdata('message'); ?>
        <ul class="parsley-error-list">
            <?php echo $this->session->flashdata('errors'); ?>
        </ul>
        <form action="<?php echo site_url('administrator/email/save/' . $row['email_id']); ?>" class='form-horizontal' 
              parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
             <?php if (!empty($row['email_id'])) { ?>
                <input type="hidden" name="email_id" value="<?php echo $row['email_id']; ?>" />
            <?php } else { ?>
                <input type="hidden" name="email_id" value="" />
            <?php } ?>
            <div class="col-md-12">
                <fieldset><legend> Email</legend>

                    <div class="form-group  " >
                        <label for="Email Name" class=" control-label col-md-4 text-left"> Email Name <span class="asterix"> * </span></label>
                        <div class="col-md-8">
                            <input type='text' class='form-control' placeholder='' value='<?php echo $row['email_name']; ?>' name='email_name'  required /> <br />
                            <i> <small></small></i>
                        </div> 
                    </div> 					
                    <div class="form-group  " >
                        <label for="Email Data" class=" control-label col-md-4 text-left"> Email Data <span class="asterix"> * </span></label>
                        <div class="col-md-8">
                            <textarea name='email_data' rows='2' id='email_data' class='form-control '  
                                      required  ><?php echo $row['email_data']; ?></textarea> <br />
                            <i> <small></small></i>
                        </div> 
                    </div> 					
                    <div class="form-group  " >
                        <label for="Email Status" class=" control-label col-md-4 text-left"> Email Status </label>
                        <div class="col-md-8">

                            <?php $email_status = explode(',', $row['email_status']);
                            $email_status_opt = array('1' => 'Enable', '2' => 'Disable',);
                            ?>
                            <select name='email_status' rows='5'   class='select2 '  > 
                                <?php
                                foreach ($email_status_opt as $key => $val) {
                                    echo "<option  value ='$key' " . ($row['email_status'] == $key ? " selected='selected' " : '' ) . ">$val</option>";
                                }
                                ?></select> <br />
                            <i> <small></small></i>
                        </div> 
                    </div> </fieldset>
            </div>



            <div style="clear:both"></div>	

            <div class="toolbar-line text-center">		
                <input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
                <a href="<?php echo site_url('administrator/email'); ?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
            </div>

        </form>

    </div>	
</div>	
</div>

<script type="text/javascript">
    $(document).ready(function () {

    });
</script>		 