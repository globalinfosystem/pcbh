<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/pagefile') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('administrator/pagefile/save/'.$row['tb_page_file_id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

<div class="col-md-12">
						<fieldset><legend> Page Pdf</legend>
									
								  <input type='hidden' class='form-control' placeholder='' value='<?php echo $row['tb_page_file_id'];?>' name='tb_page_file_id'   /> <br />	
									<?php if(empty($row['tb_page_file_id'])) { ?>
									<input type='hidden' class='form-control' placeholder='' value='<?php echo date('Y-m-d H:i:s');?>' name='tb_page_file_created_date'   /> <br />
									<?php } else {  ?>
									<input type='hidden' class='form-control' placeholder='' value='<?php echo date('Y-m-d H:i:s');?>' name='tb_page_file_updated_date'   /> <br />
									<?php } ?>
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['tb_page_file_title'];?>' name='tb_page_file_title'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Path" class=" control-label col-md-4 text-left"> Path </label>
									<div class="col-md-8">
									  <input  type='file' name='tb_page_file_path' id='tb_page_file_path' <?php if($row['tb_page_file_path'] =='') echo 'class="required"' ;?> style='width:150px !important;'  />
										<?php echo SiteHelpers::showUploadedFile($row['tb_page_file_path'],'/uploads/file/') ;?>
										<br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
					<?php $tb_page_file_status = explode(',',$row['tb_page_file_status']);
					$tb_page_file_status_opt = array( 'Disabled' => 'Disabled' ,  'Enabled' => 'Enabled' , ); ?>
					<select name='tb_page_file_status' rows='5' required  class='select2 '  > 
						<?php 
						foreach($tb_page_file_status_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['tb_page_file_status'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="PageId" class=" control-label col-md-4 text-left"> PageId <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='tb_page_file_pageId' rows='5' id='tb_page_file_pageId' code='{$tb_page_file_pageId}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
				
				
								  <div class="form-group  " >
									<label for="Display Type" class=" control-label col-md-4 text-left"> Display Type </label>
									<div class="col-md-8">
									  
					<?php $th_page_file_display_type = explode(',',$row['th_page_file_display_type']);
					$th_page_file_display_type_opt = array( 'New Window' => 'New Window' ,  'Open Popup' => 'Open Popup' ,  'Same Window' => 'Same Window' , ); ?>
					<select name='th_page_file_display_type' rows='5'   class='select2 '  > 
						<?php 
						foreach($th_page_file_display_type_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['th_page_file_display_type'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
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
			<a href="<?php echo site_url('administrator/pagefile');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#tb_page_file_pageId").jCombo("<?php echo site_url('administrator/pagefile/comboselect?filter=tb_pages:pageID:title') ?>",
		{  selected_value : '<?php echo $row["tb_page_file_pageId"] ?>' });
		 	 
});
</script>		 