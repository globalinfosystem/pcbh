<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
            <li><a href="<?php echo site_url('administrator/sms') ?>"><?php echo $pageTitle ?></a></li>
            <li class="active"> Form </li>
        </ul>  	  
    </div>

    <div class="page-content-wrapper m-t">
        <?php echo $this->session->flashdata('message'); ?>
        <ul class="parsley-error-list">
            <?php echo $this->session->flashdata('errors'); ?>
        </ul>
        <form action="<?php echo site_url('administrator/sms/save/' . $row['sms_id']); ?>" class='form-horizontal' 
              parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?php if (!empty($row['sms_id'])) { ?>
                <input type="hidden" name="sms_id" value="<?php echo $row['sms_id']; ?>" />
            <?php } else { ?>
                <input type="hidden" name="sms_id" value="" />
            <?php } ?>
            <div class="col-md-12">
                <fieldset><legend> Sms</legend>
                    <a href="../email/form.php"></a>

                    <div class="form-group  " >
                        <label for="Sms Name" class=" control-label col-md-4 text-left"> Sms Name <span class="asterix"> * </span></label>
                        <div class="col-md-8">
                            <input type='text' class='form-control' placeholder='' value='<?php echo $row['sms_name']; ?>' name='sms_name'  required /> <br />
                            <i> <small></small></i>
                        </div> 
                    </div> 					
                    <div class="form-group  " >
                        <label for="Sms Data" class=" control-label col-md-4 text-left"> Sms Data <span class="asterix"> * </span></label>
                        <div class="col-md-8">
                            <textarea name='sms_data' rows='2' id='sms_data' class='form-control '  
                                      required  ><?php echo $row['sms_data']; ?></textarea> <br />
                            <i> <small></small></i>
                        </div> 
                    </div> 					
                    <div class="form-group  " >
                        <label for="Sms Status" class=" control-label col-md-4 text-left"> Sms Status </label>
                        <div class="col-md-8">

                            <?php
                            $sms_status = explode(',', $row['sms_status']);
                            $sms_status_opt = array('1' => 'Enable', '2' => 'Disable',);
                            ?>
                            <select name='sms_status' rows='5'   class='select2 '  > 
                                <?php
                                foreach ($sms_status_opt as $key => $val) {
                                    echo "<option  value ='$key' " . ($row['sms_status'] == $key ? " selected='selected' " : '' ) . ">$val</option>";
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
                <a href="<?php echo site_url('administrator/sms'); ?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
            </div>

        </form>

    </div>	
</div>	
</div>

<script type="text/javascript">
    $(document).ready(function () {

    });
</script>		 