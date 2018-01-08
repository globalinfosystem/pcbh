<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/tblusers') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('administrator/tblusers/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

<div class="col-md-12">
						<fieldset><legend> Custom User</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Group Id" class=" control-label col-md-4 text-left"> Group Id <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='group_id' rows='5' id='group_id' code='{$group_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Username" class=" control-label col-md-4 text-left"> Username <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['username'];?>' name='username'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Password" class=" control-label col-md-4 text-left"> Password <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['password'];?>' name='password'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Email" class=" control-label col-md-4 text-left"> Email <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['email'];?>' name='email'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-4 text-left"> Name <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['name'];?>' name='name'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Gender" class=" control-label col-md-4 text-left"> Gender <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
					<?php $gender = explode(',',$row['gender']);
					$gender_opt = array( 'M' => 'Male' ,  'F' => 'Female' , ); ?>
					<select name='gender' rows='5' required  class='select2 '  > 
						<?php 
						foreach($gender_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['gender'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Father Name" class=" control-label col-md-4 text-left"> Father Name <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['father_name'];?>' name='father_name'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Mobile" class=" control-label col-md-4 text-left"> Mobile <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['mobile'];?>' name='mobile'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="District" class=" control-label col-md-4 text-left"> District <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='district' rows='5' id='district' code='{$district}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="State" class=" control-label col-md-4 text-left"> State <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='state' rows='5' id='state' code='{$state}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Address1" class=" control-label col-md-4 text-left"> Address1 <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['address1'];?>' name='address1'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Address2" class=" control-label col-md-4 text-left"> Address2 </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['address2'];?>' name='address2'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Organization" class=" control-label col-md-4 text-left"> Organization <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['organization'];?>' name='organization'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
			<a href="<?php echo site_url('administrator/tblusers');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#group_id").jCombo("<?php echo site_url('administrator/tblusers/comboselect?filter=tb_groups:group_id:name') ?>",
		{  selected_value : '<?php echo $row["group_id"] ?>' });
		
		$("#district").jCombo("<?php echo site_url('administrator/tblusers/comboselect?filter=tbl_districts:dist_no:dist_name') ?>",
		{  selected_value : '<?php echo $row["district"] ?>' });
		
		$("#state").jCombo("<?php echo site_url('administrator/tblusers/comboselect?filter=states_name:state_id:state_name') ?>",
		{  selected_value : '<?php echo $row["state"] ?>' });
		 	 
});
</script>		 