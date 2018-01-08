<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/caseassign') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('administrator/caseassign/save/'.$row['case_asign_id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

<div class="col-md-12">
						<fieldset><legend> Case Assign</legend>
								<input type='hidden'  value='<?php echo $row['case_asign_id'];?>' name='case_asign_id'/>	
								  <div class="form-group  " >
									<label for="Case" class=" control-label col-md-4 text-left"> Case <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='case_asign_case_id' rows='5' id='case_asign_case_id' code='{$case_asign_case_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Officer" class=" control-label col-md-4 text-left"> Officer <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='case_asign_officer_id' rows='5' id='case_asign_officer_id' code='{$case_asign_officer_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Date Of Assign" class=" control-label col-md-4 text-left"> Date Of Assign <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control date' placeholder='' value='<?php echo $row['case_asign_date_of_assign'];?>' name='case_asign_date_of_assign'
				style='width:150px !important;'	  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " style="display:none;">
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='case_asign_status_id' rows='5' id='case_asign_status_id' code='{$case_asign_status_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
			<a href="<?php echo site_url('administrator/caseassign');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#case_asign_case_id").jCombo("<?php echo site_url('administrator/caseassign/comboselect?filter=tbl_case:case_id:case_id|case_letter_number|case_petitioner_name:case_id:'.$row["case_asign_case_id"].'') ?>",
		{  selected_value : '<?php echo $row["case_asign_case_id"] ?>' });
		
		$("#case_asign_officer_id").jCombo("<?php echo site_url('administrator/caseassign/comboselect?filter=tb_users:id:name|mobile:group_id:2') ?>",
		{  selected_value : '<?php echo $row["case_asign_officer_id"] ?>' });
		
		$("#case_asign_status_id").jCombo("<?php echo site_url('administrator/caseassign/comboselect?filter=tb_status:status_id:status_name') ?>",
		{  selected_value : '<?php echo $row["case_asign_status_id"] ?>' });
		 	 
});
</script>		 