<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/logs') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('administrator/logs/save/'.$row['log_id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

<div class="col-md-12">
						<fieldset><legend> logs</legend>
									
								  <div class="form-group  " >
									<label for="Case (Case id Case Number Subject)" class=" control-label col-md-4 text-left"> Case (Case id Case Number Subject) <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='log_case_id' rows='5' id='log_case_id' code='{$log_case_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="User" class=" control-label col-md-4 text-left"> User <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='log_user_id' rows='5' id='log_user_id' code='{$log_user_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Log Activity" class=" control-label col-md-4 text-left"> Log Activity </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['log_active'];?>' name='log_active'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Log Generate Date" class=" control-label col-md-4 text-left"> Log Generate Date </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control datetime' placeholder='' value='<?php echo $row['log_date'];?>' name='log_date'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Log Description" class=" control-label col-md-4 text-left"> Log Description </label>
									<div class="col-md-8">
									  <textarea name='log_description' rows='2' id='log_description' class='form-control '  
				           ><?php echo $row['log_description'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
			<a href="<?php echo site_url('administrator/logs');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#log_case_id").jCombo("<?php echo site_url('administrator/logs/comboselect?filter=tbl_case:case_id:case_id|case_letter_number|case_subject') ?>",
		{  selected_value : '<?php echo $row["log_case_id"] ?>' });
		
		$("#log_user_id").jCombo("<?php echo site_url('administrator/logs/comboselect?filter=tb_users:id:name|mobile') ?>",
		{  selected_value : '<?php echo $row["log_user_id"] ?>' });
		 	 
});
</script>		 