<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/casedecision') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('administrator/casedecision/save/'.$row['disposed_id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

<div class="col-md-12">
						<fieldset><legend> Case Decision</legend>
						<?php
						$casedecisiontype=($row['case_current_status']==5?"decided":"disposeoff");
						?>
					           <input type='hidden'  value='<?php echo $casedecisiontype;?>' name='casedecisiontype' /> <br /> 						
								<input type='hidden'  value='<?php echo $row['disposed_id'];?>' name='disposed_id' /> <br /> 					
								  <div class="form-group  " >
									<label for="Disposed Case Id" class=" control-label col-md-4 text-left"> Disposed Case Id <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='disposed_case_id' rows='5' id='disposed_case_id' code='{$disposed_case_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div>
                                  <input type="hidden" value="<?php echo $row["disposed_case_id"]; ?>" name="case_id">									 
								  </div> 					
								  <div class="form-group  " >
									<label for="Disposed Officer Id" class=" control-label col-md-4 text-left"> Disposed Officer Id <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='disposed_officer_id' rows='5' id='disposed_officer_id' code='{$disposed_officer_id}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Disposed Date" class=" control-label col-md-4 text-left"> Disposed Date <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control date' placeholder='' value='<?php echo $row['disposed_date'];?>' name='disposed_date'
				style='width:150px !important;'	  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Disposed Remark" class=" control-label col-md-4 text-left"> Disposed Remark <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <textarea name='disposed_remark' rows='2' id='disposed_remark' class='form-control '  
				         required  ><?php echo $row['disposed_remark'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
                                  <?php
								  if($row['case_current_status']==5):
                                  ?>								  
								  <div class="form-group  " >
									<label for="Attachment" class=" control-label col-md-4 text-left"> Attachment </label>
									<div class="col-md-8">
									  <input  type='file' name='attachment' id='attachment' <?php if($row['attachment'] =='') echo 'class="required"' ;?> style='width:150px !important;'  />
					<?php echo SiteHelpers::showUploadedFile($row['attachment'],'') ;?>
				 <br />
									  <i> <small></small></i>
									 </div>
<input type="hidden"  name="fileattechment_path" value="<?php echo $row['attachment'];?>">									 
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
			<a href="<?php echo site_url('administrator/casedecision');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#disposed_case_id").jCombo("<?php echo site_url('administrator/casedecision/comboselect?filter=tbl_case:case_id:case_id|case_letter_number|case_subject:case_id:'.$row["disposed_case_id"].'') ?>",
		{  selected_value : '<?php echo $row["disposed_case_id"] ?>' });
		
		$("#disposed_officer_id").jCombo("<?php echo site_url('administrator/casedecision/comboselect?filter=tb_users:id:username:id:'.$row["disposed_officer_id"].'') ?>",
		{  selected_value : '<?php echo $row["disposed_officer_id"] ?>' });
		 	 
});
</script>		 