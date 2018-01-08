<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/orderpassed') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('administrator/orderpassed/save/'.$row['order_passed_id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

<input type="hidden" name="order_passed_id" value="<?php echo $row['order_passed_id'];?>" />
<?php if(!empty($row['order_passed_id'])){ ?> 
	<input type="hidden" name="order_passed_update_date" value="<?php echo date('Y-m-d H:i:s');?>" />
<?php } else { ?>
	<input type="hidden" name="order_passed_created_date" value="<?php echo date('Y-m-d H:i:s');?>" />
<?php } ?>

<div class="col-md-12">
						<fieldset><legend> Case Order Passed</legend>
									
								  <div class="form-group  " >
									<label for="Case" class=" control-label col-md-4 text-left"> Case <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='order_passed_case_id' rows='5' id='order_passed_case_id' code='{$order_passed_case_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Officer" class=" control-label col-md-4 text-left"> Officer <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='order_passed_officer_id' rows='5' id='order_passed_officer_id' code='{$order_passed_officer_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Order Passed Date" class=" control-label col-md-4 text-left"> Order Passed Date <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control date' placeholder='' value='<?php echo $row['order_passed_date'];?>' name='order_passed_date'
				style='width:150px !important;'	  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Upload FIle" class=" control-label col-md-4 text-left"> Upload FIle </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['order_passed_file_path'];?>' name='order_passed_file_path'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Order Passed Status" class=" control-label col-md-4 text-left"> Order Passed Status <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='order_passed_status' rows='5' id='order_passed_status' code='{$order_passed_status}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
			<a href="<?php echo site_url('administrator/orderpassed');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#order_passed_case_id").jCombo("<?php echo site_url('administrator/orderpassed/comboselect?filter=tbl_case:case_id:case_id|case_letter_number|case_petitioner_name') ?>",
		{  selected_value : '<?php echo $row["order_passed_case_id"] ?>' });
		
		$("#order_passed_officer_id").jCombo("<?php echo site_url('administrator/orderpassed/comboselect?filter=tb_users:id:name|mobile') ?>",
		{  selected_value : '<?php echo $row["order_passed_officer_id"] ?>' });
		
		$("#order_passed_status").jCombo("<?php echo site_url('administrator/orderpassed/comboselect?filter=tb_status:status_id:status_name') ?>",
		{  selected_value : '<?php echo $row["order_passed_status"] ?>' });
		 	 
});
</script>		 