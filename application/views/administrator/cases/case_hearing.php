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
		 <form action="<?php echo site_url('administrator/cases/save_case_hearing/'); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<input type="hidden" name="case_id" value="<?php echo $case_id;?>" />
<?php if(!empty($case_id)){ ?> 
	<input type="hidden" name="hearing_update_date" value="<?php echo date('Y-m-d H:i:s');?>" />
<?php } else { ?>
	<input type="hidden" name="hearing_created_date" value="<?php echo date('Y-m-d H:i:s');?>" />
<?php } 

?>
<?php
if(isset($hearing_data[0]["hearing_id"])):
?>
<input type="hidden" id="hearing_id" name="hearing_id" value="<?php echo $hearing_data[0]["hearing_id"];?>">
<?php
endif;
?>
<div class="col-md-12">
						<fieldset><legend> Case Hearing</legend>
									
								  <div class="form-group  " >
									<label for="Case" class=" control-label col-md-4 text-left"> Case <span class="asterix">  </span></label>
									<div class="col-md-8">
									<?php echo $subject;?>
									  <input type="hidden" name='case_number' id="case_number" rows='5' value="<?php echo $subject;?>" >
									 
							         <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
                                    <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-8">
									<input type="hidden" value="">
								   <select name='hearing_status' class='select2' rows='5' id='hearing_status'>
									<?php
									foreach($status as $getsatatus):
									$case_status=(isset($currentcase_status)?($currentcase_status==$getsatatus["current_status_id"]?"selected":''):'');
									?>
									<option value="<?php echo $getsatatus["current_status_id"] ?>" <?php echo $case_status;?>>
									<?php
									echo $getsatatus["current_status_name"];
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
									<label for="Officer" class=" control-label col-md-4 text-left"> Officer <span class="asterix"> * </span></label>
									<div class="col-md-8">
									
									<select name='officer_id' class='select2' rows='5' id='officer_id' required >
									<?php
									foreach($officer_data as $officer):
									$officer_selected=(isset($hearing_data[0]["hearing_officer_id"])?($hearing_data[0]["hearing_officer_id"]==$officer["id"]?"selected":''):'');
									?>
									<option value="<?php echo $officer["id"];?>" <?php echo $officer_selected;?>>
									<?php echo $officer["name"];?>
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
									<label for="Next Date" class=" control-label col-md-4 text-left"> Next Date <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control date' placeholder='' value='<?php echo (isset($hearing_data[0]["hearing_next_date"])?$hearing_data[0]["hearing_next_date"]:'');?>' name='hearing_next_date'
				style='width:150px !important;'	 required  /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 								  
								  <div class="form-group  " >
									<label for="Date" class=" control-label col-md-4 text-left"> Time Of Hearing <span class="asterix"> * </span></label>
									<div class="col-md-4">
									<span>
									<select name="hour">
								<?php
                                  for($i=1;$i<=12;$i++)
								  {
						$case_hour=(isset($hour)?($hour==$i?"selected":''):'');			  
								  ?>
								 <option value="<?php echo $i;?>" <?php echo $case_hour;?>>
								 <?php
								 echo $i;
								 ?>
                                  </option>								 
								  
                                 <?php
								  }
                                 ?>
                                 </select>								 
				                   
									 </span> 
									 <span>
									<select name="minute">
								<?php
                                  for($x=0;$x<=60;$x++)
								  {
							$case_minute=(isset($minute)?($minute==$x?"selected":''):'');			 		  
								  ?>
								 <option value="<?php echo $x;?>" <?php echo $case_minute;?>>
								 <?php
								 echo $x;
								 ?>
                                  </option>								 
								  
                                 <?php
								  }
                                 ?>
                                 </select>								 
				                   
									 </span>
                                 <span>
									<select name="second">
								<?php
                                  for($z=0;$z<=60;$z++)
								  {
							$case_second=(isset($second)?($second==$z?"selected":''):'');		  
								  ?>
								 <option value="<?php echo $z;?>" <?php echo $case_second;?>>
								 <?php
								 echo $z;
								 ?>
                                  </option>								 
								  
                                 <?php
								  }
                                 ?>
                                 </select>								 
				                   
									 </span> 
                                  <span>
								  
									<select name="timeformat">
								
								 <option value="am" <?php echo (isset($dateformat)?($dateformat=="am"?"selected":''):'');?>	>
								  AM
                                  </option>								 
								   <option value="pm" <?php echo (isset($dateformat)?($dateformat=="pm"?"selected":''):'');?>>
								   PM
                                  </option>	
                                                                
                                 </select>								 
				                   
									 </span> 
									</div>
																		 
								  </div> 					
								  					
								  <div class="form-group  " >
									<label for="remark" class=" control-label col-md-4 text-left"> Remark<span class="asterix"> * </span> </label>
									<div class="col-md-8">
									<textarea class="form-control custom-control" rows="6" style="resize:none" name="remark"><?php echo (isset($hearing_data[0]["remark"])?$hearing_data[0]["remark"]:'');?>
									</textarea>     
									 <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Address" class=" control-label col-md-4 text-left"> Address <span class="asterix"> * </span></label>
									<div class="col-md-8">
									<select name='hearing_address_id' rows='5' class='select2' id='hearing_address_id' required>
									<?php
									
                                     foreach($address_data as $address):
							$case_address=(isset($hearing_data[0]["hearing_address_id"])?($hearing_data[0]["hearing_address_id"]==$address["address_id"]?"selected":''):'');
							
                                     ?>
									 <option value="<?php echo $address["address_id"];?>" <?php echo $case_address;?>>
									 <?php
									 echo $address["address_address"];
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
								   </fieldset>
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

		$("#hearing_case_id").jCombo("<?php echo site_url('administrator/casehearing/comboselect?filter=tbl_case:case_id:case_id|case_letter_number|case_petitioner_name') ?>",
		{  selected_value : '<?php echo $row["hearing_case_id"] ?>' });
		
		$("#hearing_officer_id").jCombo("<?php echo site_url('administrator/casehearing/comboselect?filter=tb_users:id:name|mobile') ?>",
		{  selected_value : '<?php echo $row["hearing_officer_id"] ?>' });
		
		$("#hearing_address_id").jCombo("<?php echo site_url('administrator/casehearing/comboselect?filter=addresses:address_id:address_address') ?>",
		{  selected_value : '<?php echo $row["hearing_address_id"] ?>' });
		
		$("#hearing_status").jCombo("<?php echo site_url('administrator/casehearing/comboselect?filter=tb_status:status_id:status_name') ?>",
		{  selected_value : '<?php echo $row["hearing_status"] ?>' });
		 	 
});
</script>		 