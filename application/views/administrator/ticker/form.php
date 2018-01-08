<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('administrator/ticker') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('administrator/ticker/save/'.$row['ticker_id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<input type='hidden' class='form-control' placeholder='' value='<?php echo $row['ticker_id'];?>' name='ticker_id'   /> <br />
<div class="col-md-12">
						<fieldset><legend> Ticker</legend>
									
								  <div class="form-group  " >
									<label for="Ticker Title" class=" control-label col-md-4 text-left"> Ticker Title <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['ticker_title'];?>' name='ticker_title'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ticker Path" class=" control-label col-md-4 text-left"> Ticker Path </label>
									<div class="col-md-8">
									  <input  type='file' name='ticker_path' id='ticker_path' <?php if($row['ticker_path'] =='') echo 'class="required"' ;?> style='width:150px !important;'  />
					<?php echo SiteHelpers::showUploadedFile($row['ticker_path'],'/uploads/ticker/') ;?>
				 <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ticker Status" class=" control-label col-md-4 text-left"> Ticker Status <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
					<?php $ticker_status = explode(',',$row['ticker_status']);
					$ticker_status_opt = array( 'Enable' => 'Enable' ,  'Disable' => 'Disable' , ); ?>
					<select name='ticker_status' rows='5' required  class='select2 '  > 
						<?php 
						foreach($ticker_status_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['ticker_status'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
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
			<a href="<?php echo site_url('administrator/ticker');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 
});
</script>		 