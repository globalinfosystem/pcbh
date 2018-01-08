<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/caseattechments') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 <?php
 $success_message=$this->session->flashdata('message');
 $error_message=$this->session->flashdata('errors');
 ?>
 	<div class="page-content-wrapper m-t">
	    <?php 
	     if(!empty($success_message)):
	    ?>
	      <div class="alert alert-success">
		  <?php echo $this->session->flashdata('message');?>
		  </div>
		<?php
		 endif;
		?>
		<ul class="parsley-error-list">
			<?php 
	         if(!empty($error_message)):
	        ?>
				<div class="alert alert-danger">
				<?php echo $this->session->flashdata('errors');?>
				</div>
			
			<?php
		     endif;
		    ?>	
			</ul>
	<?php $send_id= (isset($row['file_attachment_id'])?$row['file_attachment_id']:'');?>		
		 <form action="<?php echo site_url('administrator/caseattechments/save/'.$send_id); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<input type="hidden" name="formtype" value="<?php echo $formtype;?>">
<div class="col-md-12">
						<fieldset><legend> Case Attechments</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="File System #Id" class=" control-label col-md-4 text-left"> File System #Id <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo (isset($row['file_attachment_id'])?$row['file_attachment_id']:'');?>' name='file_attachment_id'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
                                  <?php
									if(isset($caseinfo)):
									?>								  
								  <div class="form-group  " >
									<label for="Case" class=" control-label col-md-4 text-left"> Case <span class="asterix"> * </span></label>
									<div class="col-md-8">
									
									  <input type='text' class='form-control' placeholder='' value='<?php echo $caseinfo;?>' name='caseinfo'  disabled="disabled"/>
																		
									  <input type='hidden' class='form-control' placeholder='' value='<?php echo (isset($row['file_attachment_case_id'])?$row['file_attachment_case_id']:(isset($file_attachment_case_id)?$file_attachment_case_id:''));?>' name='file_attachment_case_id'  required /> <br />
 <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
                                    <?php
									endif;
                                     ?>								  
								  <div class="form-group hidethis " style="display:none;">
									<label for="User" class=" control-label col-md-4 text-left"> User <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo (isset($row['file_attachment_user_id'])?$row['file_attachment_user_id']:(isset($file_attachment_user_id)?$file_attachment_user_id:''));?>' name='file_attachment_user_id'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Upload File" class=" control-label col-md-4 text-left"> Upload Pdf File </label>
									<div class="col-md-8">
									  <input  type='file' accept="application/pdf" name='file_attachment_file_path' id='file_attachment_file_path' <?php if(isset($row['file_attachment_file_path']) && $row['file_attachment_file_path'] =='') echo 'class="required"' ;?> style='width:150px !important;'  />
					<?php 
					if(isset($row['file_attachment_file_path']))
					echo SiteHelpers::showUploadedFile($row['file_attachment_file_path'],'') ;
					?>
					
				 <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			<input type="hidden" value="<?php echo (isset($row['file_attachment_file_path'])?$row['file_attachment_file_path']:'') ;?>" name="filename"/>
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
			<a href="<?php echo site_url('administrator/caseattechments');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 
});
</script>		 