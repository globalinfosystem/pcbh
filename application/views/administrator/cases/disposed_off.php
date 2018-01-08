<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/casehearing') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('administrator/cases/save_change_status/'); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<input type="hidden" name="case_id" value="<?php echo $case_id;?>" />
<input type="hidden" name="status_type" value="<?php echo $status_type;?>">
<?php if(!empty($case_id)){ ?> 
	<input type="hidden" name="hearing_update_date" value="<?php echo date('Y-m-d H:i:s');?>" />
<?php } else { ?>
	<input type="hidden" name="hearing_created_date" value="<?php echo date('Y-m-d H:i:s');?>" />
<?php } 

?>
<div class="col-md-12">
						<fieldset>
						           <?php
                                   if($status_type=="decided")
								   {
                                   ?>
						          <legend> Decided</legend>
							      <?php
								   }else
								   {
                                  ?>
								  <legend> Disposed Off</legend>
                                  <?php
								   }
                                   ?>								  
								  <div class="form-group  " >
									<label for="Case" class=" control-label col-md-4 text-left"> Case <span class="asterix">  </span></label>
									<div class="col-md-8">
									<?php echo $subject;?>
									  <input type="hidden" name='case_number' id="case_number"  value="<?php echo $subject;?>">
									 
									 <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
                                    								  
								  <div class="form-group  " >
									<label for="Officer" class=" control-label col-md-4 text-left"> Officer Name <span class="asterix"> </span></label>
									<div class="col-md-8">
									<input type="text" id="officer_number" name='officer_number' rows='5' value="<?php echo $officername;?>" disabled="disabled">
									<input type="hidden" value="<?php echo $officerid;?>" name="officer_id" id="officer_id"/>
									<br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
                                <div class="form-group  " >
									<label for="Date" class=" control-label col-md-4 text-left">Date <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control date' placeholder='' value='' name='disposed_off_date'
				style='width:150px !important;'	 required  /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 								  
								   					
								  					
								  <div class="form-group  " >
									<label for="remark" class=" control-label col-md-4 text-left"> Remark<span class="asterix"> * </span> </label>
									<div class="col-md-8">
									<textarea class="form-control custom-control" rows="6" style="resize:none" name="remark">
									</textarea>     
									 <br />
									  <i> <small></small></i>
									 </div> 
								  </div>
                                   <?php
                                   if($status_type=="decided"):
                                   ?>								  
								  <div class="form-group  " >
									<label for="remark" class=" control-label col-md-4 text-left">Attachment<br/>(Upload only only pdf file less then 5MB)<span class="asterix"> * </span> </label>
									<div class="col-md-8">
									<input type="file" name="attachment" id="attachment" accept="application/pdf"/>     
									 <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
                                  <?php
                                  endif;
                                  ?>								  
								   </fieldset>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
			<a href="<?php echo site_url('administrator/case');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#hearing_case_id").jCombo("<?php echo site_url('administrator/casehearing/comboselect?filter=tbl_case:case_id:case_id|case_letter_number|case_petitioner_name') ?>",
		{  selected_value : '<?php echo $row["hearing_case_id"] ?>' });
		
		$("#hearing_officer_id").jCombo("<?php echo site_url('administrator/casehearing/comboselect?filter=tb_users:id:name|mobile') ?>",
		{  selected_value : '<?php echo $row["hearing_officer_id"] ?>' });
		
		$("#hearing_address_id").jCombo("<?php echo site_url('administrator/casehearing/comboselect?filter=addresses:address_id:address_address') ?>",
		{  selected_value : '<?php echo $row["hearing_address_id"] ?>' });
		
		$("#hearing_status").jCombo("<?php echo site_url('administrator/casehearing/comboselect?filter=tb_status:status_id:status_name') ?>",
		{  selected_value : '<?php echo $row["hearing_status"] ?>' });
		 	 
});
</script>		 