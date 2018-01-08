<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/datepick/css/jquery.datepick.css"> 
 
<script type="text/javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/js/checkfrontregisterform.js"></script>



  <div class="page-content row">
    <!-- Page header -->
    <div class="page-content-wrapper m-t">
	   <?php 
	   $message=$this->session->flashdata('success');
	   if(!empty($message))
	   {
	   ?>
       <div class="well well-lg div_reg_message_class">
	   <h3 class="success-message" style="color:#fff;"><?php echo $this->session->flashdata('success'); ?></h3>
       </div>
	   <?php
	   }
	   else
	   {  
	   ?>
       <h3 class="error-message"><?php echo $this->session->flashdata('errors'); ?></h3>
        <form name="myForm" action='<?php echo site_url("usercase/savecase/"); ?>' class='form-horizontal' parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" onsubmit="return checkemptycase();"> 
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <div class="col-md-2 col-xs-2">
		  </div>
            <div class="col-md-8 col-xs-8 table-responsive">
                <table class="table table-bordered table-striped table-condensed ">
					<tr>
						<td colspan="4" align="center">
						
						<h3>APPLY&nbsp;CASE</h3>
						
						       <div class="mandatory">
                                    <span style="color: red;">Note:</span>&nbsp;<i>fields that are indicated with (<font color="red">*</font>) are mandatory</i>
                                </div>

						</td>
					</tr>
					<tr>
						<td colspan="4"><h4><legend>Appeal Details:</legend></h4></td>
					</tr>
					<tr>
						<td>
               					 <table class="table table-bordered table-striped table-condensed">
                                            <tbody>
													<tr>
                                                    <th  colspan="4">Letter No:<font size="2" color="red">* </font></th></tr>
													</tr>
													<tr>
                                                    <td colspan="4"><input required="required" type="text"  value="" onkeyup="isAlphaKey1(this)" value="" maxlength="50" name="letter_number" placeholder="Enter Letter Number" id="letter_number" class="form-control"><br /><div id="letter_number1" style="display:none; color:#FF0000;">Please Enter Letter Number</div></td>
													</tr>
													<tr>
													<th  colspan="4">Dated:<font size="2" color="red">*
                                                        </font></th></tr>
												    <tr>
                                                    <td colspan="4">
													<input required="required" type="text"  value="" onkeyup="isAlphaKey1(this)" value="" maxlength="50" name="date"  id="casedate" class="form-control" placeholder="YYYY-MM-DD"><br /><div id="date1" style="display:none; color:#FF0000;">Please Enter Date</div>
											        </td>
													
													</tr>
													<tr>
													<th  colspan="4">Subject:<font size="2" color="red">*
                                                    </font>
													</th>
													</tr>
													<tr>
                                                    <td colspan="4">
													<div class="col-md-4 col-xs-4">
													<input type="text" required="required" style="width:100%" value=""  onkeyup="isAlphaKey1(this)" name="subjectone" placeholder="Enter Petitioner Name"  id="subjectone" class="form-control">
													<br /><div id="subjectone1" style="display:none; color:#FF0000;">Please Enter Petitioner Name</div>
													</div><div class="col-md-1 col-xs-1">Vs</div><div class="col-md-4 col-xs-4"><input type="text" style="width:100%" required="required"  value="" onkeyup="isAlphaKey1(this)" name="subjecttwo" placeholder="Enter Respondent Name"  id="subjecttwo" class="form-control">
												<br /><div id="subjecttwo1" style="display:none; color:#FF0000;">Please Enter Respondent Name</div></div>
                                                   </td>
														
												</tr>
												<tr id="fileuploaderrormessage" style="display:none;">
												<td colspan="4">
												<div  style="color:#FF0000;">Upload Only Pdf File.Each File Limit Less Then 5MB.</div>
												</td>
												</tr>
                                              <tr >
											  <th colspan="4">Attachment (Appeal):<font size="2" color="red">*
                                              </font>
											  </th>
												</tr>
   												<tr id="imageupperrow1">
												<td colspan="3" >
												<input type="file" accept="application/pdf" name="userFiles[]" class="pdfupload"//>
                                                 </td>
                                                <td>
												<button  type="button" id="addpdf" >Add More</button>
                                                </td>												 
											  </tr>
                                               </tbody>
                                        </table>
						</td>
					</tr>
					
					
				</table>
				
            </div>
			 <div class="col-md-2 col-xs-2">
		     </div>
            <div style="clear:both"></div>	
            <div class="toolbar-line text-center">		
                <input type="submit" name="submit" id="appealsubmit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.btn_submit'); ?>" />
                <a href="<?php echo site_url('usercase/applycase'); ?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.btn_cancel'); ?> </a>
            </div>
			
        </form>
		<?php
	   }
		?>
    </div>	
</div>
<script>
count=1;
fileuploaderror=0;
pdfid='';
$("#addpdf").click(function(event){
	event.stopPropagation();
	
	
	if(count<5)
	{		
      var selecterid= "imageupperrow"+count;
	  count=count+1;
      var adddomwithhtml='<tr id="imageupperrow'+count+'"><td>&nbsp;</td>'+
			                                    '<td colspan="2" >'+
												'<input type="file" name="userFiles[]" class="pdfupload"/>'+
                                                 '</td>'+
                                                  '<td>'+
                                                '<button  type="button" onclick="deleteimg('+count+')">Delete</button>'+
                                                '</td>'+
											  '</tr>';	
	  $('#'+selecterid).after(adddomwithhtml);
	  
	}
	if(count>=5)
	{
		$("#addpdf").attr("disabled", "disabled");
		$("#addpdf").hide();
	}
});
$('.pdfupload').live( 'change', function() {
   myfile= $( this ).val();
   pdfid=$( this ).id;
   var ext = myfile.split('.').pop();
    var iSize = ($(this)[0].files[0].size / 1024);

  // alert(iSize)
    iSize = (Math.round((iSize / 1024) * 100) / 100)
   fileuploaderror=0;
  if(ext=="pdf" && iSize<5)
   {
       $("#fileuploaderrormessage").hide();
	  
	    $("#appealsubmit").removeAttr("disabled");
	   fileuploaderror=1;
   } else{
	   
       $("#fileuploaderrormessage").show();
	    $("#appealsubmit").attr("disabled", "disabled");
	   fileuploaderror=0;
   }
   
});
function deleteimg(sendcount)
{
	var selecterid="imageupperrow"+sendcount;
	$('#'+selecterid).remove();
	 count=count-1;
	 
	 if(pdfid==selecterid && fileuploaderror==0)
	 {
	  $("#fileuploaderrormessage").hide();
	 
	 }
	  $("#addpdf").removeAttr("disabled");	 
	$("#addpdf").show();
		
}

</script>

