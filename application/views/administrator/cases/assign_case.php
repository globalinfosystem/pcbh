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
<form action="<?php echo site_url('administrator/cases/assign_case_save/'); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<input type="hidden" name="case_id" value="<?php echo $case_asign_id;?>" />
<?php if(!empty($case_asign_id)){ ?> 
	<input type="hidden" name="case_asign_update_date" value="<?php echo date('Y-m-d H:i:s');?>" />
<?php } else { ?>
	<input type="hidden" name="case_asign_created_date" value="<?php echo date('Y-m-d H:i:s');?>" />
<?php } ?>
<div class="col-md-12">
						<fieldset><legend> Case Assign</legend>
									
								  <div class="form-group  " >
									<label for="Case" class=" control-label col-md-4 text-left"> Case <span class="asterix"> * </span></label>
									<div class="col-md-8">
									<?php echo  $subject;?>
									 <!---<input type="hidden" value="<?php //echo  $subject;?>">---->
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Officer" class=" control-label col-md-4 text-left"> Officer <span class="asterix"> * </span></label>
									<div class="col-md-8">
							<select name='officer_id' rows='5' id='officer_id' class='select2'>
							<?php
							foreach($officer_data as $officer):
							?>
							<option value="<?php echo $officer["id"];?>">
							<?php
							echo $officer["name"];
							?>
							</option>
							<?php
							endforeach;
							?>
							</select>
							
							<br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Date Of Assign" class=" control-label col-md-4 text-left"> Date Of Assign <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control date' id="datetimepicker" placeholder='' value='' name='case_asign_date_of_assign'
				style='width:150px !important;'	  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " style="display:none;">
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-8" >
									  <select name='case_asign_status_id' rows='5' id='case_asign_status_id'>
									  <?php
									  foreach($status_data as $status):
									  ?>
									  <option value="<?php echo $status["status_id"];?>">
									  <?php
									  echo $status["status_name"];
									  ?>
									  </option>
									  <?php
									  endforeach;
									  ?>
									  
									  </select>
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
<script>
/*var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
currentdate=yyyy+"-"+mm+"-"+dd;
$("#datetimepicker").datetimepicker({
          
        startDate: currentdate,
        
    }); 
*/
</script>			 
	 