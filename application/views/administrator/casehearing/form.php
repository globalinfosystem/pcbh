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
		 <form action="<?php echo site_url('administrator/casehearing/save/'.$row['hearing_id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

<div class="col-md-12">
						<fieldset><legend> Case Hearing</legend>
									
								  <div class="form-group  " >
									<label for="Hearing Id" class=" control-label col-md-4 text-left"> Hearing Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['hearing_id'];?>' name='hearing_id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hearing Case Id" class=" control-label col-md-4 text-left"> Hearing Case Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['hearing_case_id'];?>' name='hearing_case_id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hearing Officer Id" class=" control-label col-md-4 text-left"> Hearing Officer Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['hearing_officer_id'];?>' name='hearing_officer_id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hearing Time" class=" control-label col-md-4 text-left"> Hearing Time </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['hearing_time'];?>' name='hearing_time'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hearing Next Date" class=" control-label col-md-4 text-left"> Hearing Next Date </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['hearing_next_date'];?>' name='hearing_next_date'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hearing Address Id" class=" control-label col-md-4 text-left"> Hearing Address Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['hearing_address_id'];?>' name='hearing_address_id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Remark" class=" control-label col-md-4 text-left"> Remark </label>
									<div class="col-md-8">
									  <textarea name='remark' rows='2' id='remark' class='form-control '  
				           ><?php echo $row['remark'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hearing Created Date" class=" control-label col-md-4 text-left"> Hearing Created Date </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control datetime' placeholder='' value='<?php echo $row['hearing_created_date'];?>' name='hearing_created_date'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hearing Update Date" class=" control-label col-md-4 text-left"> Hearing Update Date </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control datetime' placeholder='' value='<?php echo $row['hearing_update_date'];?>' name='hearing_update_date'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hearing Status" class=" control-label col-md-4 text-left"> Hearing Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['hearing_status'];?>' name='hearing_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
			<a href="<?php echo site_url('administrator/casehearing');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 
});
</script>		 