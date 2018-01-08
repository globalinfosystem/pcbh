<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/datepick/css/jquery.datepick.css"> 
<script type="text/javascript" src="<?php echo base_url() ?>design/datepick/js/jquery.plugin.js"></script> 
<script type="text/javascript" src="<?php echo base_url() ?>design/datepick/js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/js/checkfrontregisterform.js"></script>


<script type="text/javascript">
	$(document).ready(function (){
		$('.DatePicker').datepick({dateFormat: 'yyyy-mm-dd'});
	});
</script> 

        <?php
		    $districts = $this->Registration_model->get_all_districts_of_one_state();
			?>

<div class="page-content row">
    <!-- Page header -->
    <div class="page-content-wrapper m-t">
       <h3 class="success-message"> <?php echo $this->session->flashdata('success'); ?></h3>
       <h3 class="error-message"><?php echo $this->session->flashdata('errors'); ?></h3>
        <form name="myForm" action='<?php echo site_url("registration/register_save/"); ?>' class='form-horizontal' parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" onsubmit="return checkempty();"> 
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <div class="col-md-12 col-xs-12 table-responsive">
                <table class="table table-bordered table-striped table-condensed table-responsive">
					<tr>
						<td colspan="2" align="center"><h3>REGISTRATION&nbsp;FORM</h3>
						       <div class="mandatory">
                                    <span style="color: red;">Note:</span>&nbsp;<i>fields that are indicated with (<font color="red">*</font>) are mandatory</i>
                                </div>

						</td>
					</tr>
					<tr>
						<td colspan="2"><h4><legend>Appellant Details:</legend></h4></td>
					</tr>
					<tr>
						<td>
               					 <table class="table table-bordered table-striped table-condensed">
                                            <tbody><tr>
											       	<th>Organization:<font size="2" color="red">* </font></th>
                                                    <td><input required="required" type="text" style="width:200px" value="<?php echo!empty($row['applicant_organization']) ? $row['applicant_organization'] : ''; ?>" onkeyup="isAlphaKey1(this)" value="" maxlength="50" name="organization"  id="organization" class="form-control"><br /><div id="organization1" style="display:none; color:#FF0000;">Please Enter Organization</div></td>
													</tr>
													<tr>
                                                    <th>Applicant Name:<font size="2" color="red">* </font></th>
                                                    <td><input required="required" type="text" style="width:200px" value="<?php echo!empty($row['applicant_name']) ? $row['applicant_name'] : ''; ?>" onkeyup="isAlphaKey1(this)" value="" maxlength="50" name="aname"  id="aname" class="form-control"><br /><div id="aname1" style="display:none; color:#FF0000;">Please Enter Applicant Name</div></td>
													<th>Father's Name:<font size="2" color="red">* </font></th>
                                                    <td><input required="required" type="text" style="width:200px" value="<?php echo!empty($row['applicant_name']) ? $row['applicant_name'] : ''; ?>" onkeyup="isAlphaKey1(this)" value="" maxlength="50" name="fname"  id="fname" class="form-control"><br /><div id="fname1" style="display:none; color:#FF0000;">Please Enter Father Name</div></td>
													</tr>
													<tr>
													<th>Applicant's Address 1:<font size="2" color="red">*
                                                        </font></th>
                                                    <td><textarea  required="required" style="width:170px" rows="5" cols="25" name="address"  id="address" class="form-control"><?php echo!empty($row['from_whom_reciv']) ? $row['from_whom_reciv'] : ''; ?></textarea><br /><div id="address1" style="display:none; color:#FF0000;">Please Enter Address</div></td>
													<th>Applicant's Address 2:<font size="2" color="red">
                                                        </font></th>
                                                    <td><textarea  required="required" style="width:170px" rows="5" cols="25" name="address2" class="form-control"><?php echo!empty($row['from_whom_reciv']) ? $row['from_whom_reciv'] : ''; ?></textarea></td>
													</tr>
													<tr>
													<th>State:</th>
                                                    <td>
                                                        <select required="required" style="width:170px" id="state" name="state" class="form-control select2">
														<option value="1">Haryana</option>
														</select> 
															
                                                       
                                                    </td>
													<th>District:</th>
                                                    <td>
                                                        <select required="required" style="width:170px" id="district" name="district" class="form-control select2">
															<?php
															foreach($districts as $district)
															{
															?>
															<option value="<?php echo $district['dist_no']; ?>"><?php echo $district['dist_name']; ?></option>
															<?php
															}
															?>
                                                        </select>
                                                    </td>
													</tr>
													<tr>
													<th>E-mail:</th>
                                                    <td><input required="required" type="email" value="<?php echo!empty($row['application_email']) ? $row['application_email'] : ''; ?>" name="email" id="email"  class="form-control"><br /><div id="email1" style="display:none; color:#FF0000;">Please Enter Email</div></td>
													 <th><!--Applicant's Contact Details <br>Landline:(+91) <br>-->
                                                        <br> Mobile:(+91)
                                                    </th>
                                                    <td>
                                                       <input type="text" onkeypress="return isNumberKey(event)" onkeyup="checkzero(this)" value="<?php echo!empty($row['applicant_mobile']) ? $row['applicant_mobile'] : ''; ?>" maxlength="10" name="mobile"  id="mobile" class="form-control"><br /><div id="mobile1" style="display:none; color:#FF0000;">Please Enter Mobile No.</div></td>
														</tr>
														<tr>
                                                    <th>Gender:<font size="2" color="red">*</font></th>
                                                    <td>
                                                        <input type="radio" value="M" name="gender" checked="checked">Male
                                                        <input type="radio" value="F" name="gender">Female
                                                    </td>
                                                
                                                    

                                                   
                                                </tr>
                                              
                                               
                                            </tbody>
                                        </table>
						</td>
					</tr>
					
					
				</table>
            </div>
            <div style="clear:both"></div>	
            <div class="toolbar-line text-center">		
                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
                <a href="<?php echo site_url('apply-online'); ?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
            </div>
        </form>
    </div>	
</div>	
</div>
