<?php if ($searchdata) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME;?>/datatables/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME;?>/datatables/tabletools-2.2.0/css/dataTables.tableTools.css" />
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME;?>/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME;?>/datatables/js/datatable-search.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME;?>/datatables/tabletools-2.2.0/js/dataTables.tableTools.js"></script>
    <script type="text/javascript">
		$(document).ready(function () {
            var table = $('#reporttable').dataTable({
                "sDom": 'T<"clear">lfrtip',
                "oColVis": {
                    "activate": "mouseover"
                },
                "sPaginationType": "full_numbers",
                "aLengthMenu": [10, 25, 50, 100],
                "oTableTools": {
                    "sSwfPath": "<?php echo base_url() ?>design/themes/<?php echo CNF_THEME;?>/datatables/tabletools-2.2.0/swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "xls",
                            "sButtonText": "<i class='fa fa-save'></i> EXCEL",
                        },
                        {
                            "sExtends": "pdf",
                            "sButtonText": "<i class='fa fa-save'></i> PDF",
                            "sPdfOrientation": "landscape",
                            "sPdfSize": "tabloid",
                        }
                    ]
                }
            });


        });

        /*$(window).resize();
        $("#heading").find('button').on('click', function () {
            //Print ele4 with custom options
            $(".printTable").print({
                //Use Global styles
                globalStyles: false,
                //Add link with attrbute media=print
                mediaPrint: false,
                //Custom stylesheet
                stylesheet: "<?php echo base_url(); ?>datatables/css/jquery.dataTables.css",
                //Print in a hidden iframe
                iframe: true,
                //Don't print this
                noPrintSelector: ".avoid-this",
                //Add this at top
                prepend: "",
                //Add this on bottom
                append: ""
            });
        });*/
    </script>
    <?php $getSic= $this->Hiceoms_model->get_all_sic(); ?>
    <?php $getDepartment= $this->Hiceoms_model->get_all_departments(); ?>
    <?php $getDistricts= $this->Hiceoms_model->get_all_districts(); ?>
    <?php $getbench = $this->Hiceoms_model->get_all_bench(); ?>
    <?php $getSubStage = $this->Hiceoms_model->get_all_sub_stage(); ?>
    <?php $getStage = $this->Hiceoms_model->get_all_stage(); ?>
    <?php $getHearingDetails = $this->Hiceoms_model->get_all_hearing_bench(); ?>

    <div id="collapse-head">
        <?php $i = 1; ?>
        <div class="title-bar blue-bar top-space" id="heading">
            Decisions 
            <!--<button class="avoid-this pintbutton floatRight"> Print </button>-->
        </div>
        <div>
			<?php if(count($searchdata) > 1) { ?>
            <table <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] < 500){ ?> style="font-size:10px;" <?php } ?> id="reporttable" class="table table-bordered table-striped table-condensed table-responsive cf printTable">
                <thead>
                    <tr>
                        <th>Registration No</th>
                        <th>Name</th>
						<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
							<th>Subject</th>
							<th>Address</th>
						<?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($searchdata as $key => $value) { ?>
                            <tr <?php if ($i % 2 == 0) { ?> class="odd"<?php } else { ?>class="even"<?php } ?>>
                                <td><?php echo !empty($value['file_no']) ? $value['file_no'] : ''; ?></td>
                                <td><?php echo !empty($value['applicant_name']) ? $value['applicant_name'] : ''; ?></td>
								<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
									<td><?php echo !empty($value['subject']) ? $value['subject'] : ''; ?></td>
									<td><?php echo !empty($value['from_whom_reciv']) ? $value['from_whom_reciv'] : ''; ?></td>
								<?php } ?>
                            </tr>
                            <?php $i++; ?>
                    <?php } ?>
                </tbody>
            </table>
			<?php } else { ?>
			 <?php foreach ($searchdata as $key => $value) { ?>
			 
					<table <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?> width="500" <?php } else { ?> style=" font-size: 11px;" <?php } ?> cellspacing="0" cellpadding="2" border="1" bgcolor="#FBCE6A" align="center">
							<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
							<tbody>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>Reg.No</b> </td> <td bgcolor="#ffffff" style="font-size: 12px;"><?php echo !empty($value['file_no']) ? $value['file_no'] : ''; ?></td>
									<td class="tablehead1">  <b>Registered On</b> </td> <td bgcolor="#ffffff" style="font-size: 12px;"><?php echo !empty($value['registration_date']) ? $value['registration_date'] : ''; ?> </td>
								</tr>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1" colspan="2"> <b>Subject</b></td><td bgcolor="#ffffff" style="font-size: 12px;" colspan="3"><font size="2" face="verdana" color="blue"><?php echo !empty($value['subject']) ? $value['subject'] : ''; ?></font></td>
								</tr>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1" colspan="2"> <b>Address</b></td><td bgcolor="#ffffff" style="font-size: 12px;" colspan="3"><?php echo !empty($value['from_whom_reciv']) ? $value['from_whom_reciv'] : ''; ?></td>
								</tr>
								
								<tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>Type of Case</b> </td><td bgcolor="#ffffff" style="font-size: 12px;"><font size="2" face="verdana" color="blue">Appeal</font> </td>
									<td class="tablehead1"> <b>Department</b> </td><td bgcolor="#ffffff" style="font-size: 12px;"> <?php echo !empty($value['dept_no']) && !empty($getDepartment[$value['dept_no']]) ? $getDepartment[$value['dept_no']] : ''; ?>, <?php echo !empty($value['dist_no']) && !empty($getDistricts[$value['dist_no']]) ? $getDistricts[$value['dist_no']] : ''; ?> </td>
								</tr>
								 <tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>District</b> </td><td bgcolor="#ffffff" style="font-size: 12px;"> <?php echo !empty($value['dist_no']) && !empty($getDistricts[$value['dist_no']]) ? $getDistricts[$value['dist_no']] : ''; ?> </td>
									<td class="tablehead1"> <b>Rural/Urban</b> </td><td bgcolor="#ffffff" style="font-size: 12px;"><?php echo !empty($value['area']) ? $value['area'] : ''; ?> </td>
								</tr>
								 <tr bgcolor="#eeeeee">
									<td colspan="2" class="tablehead1"> <b>Current Status</b> </td><td bgcolor="#ffffff" colspan="3" style="font-size: 12px;color: red"><b>
									<?php /*?><?php echo !empty($value['stage_no']) && $value['stage_no'] != 0 && !empty($value['substage_no']) && $value['substage_no'] != 6 ? $getStage[$value['stage_no']]['stage_desc'].' - ' : $getStage[1]['stage_desc'].' - '; ?>
									<?php echo !empty($value['substage_no']) ? $getSubStage[$value['substage_no']][$value['stage_no']]['sub_stage_desc'] : $getSubStage[1][$value['stage_no']]['sub_stage_desc']; ?> <?php */?>
					<?php $getRegHearing = $this->Hiceoms_model->hearing_detail_with_order($value['year'],$value['reg_no']); 
				 if (count($getRegHearing)>0)
				  { 
					  foreach ($getRegHearing as $getRegHearingk => $getRegHearinga)
					   {
							$hearingdetail = $this->Hiceoms_model->hearing_detail_on_check_status($getRegHearinga['id']);
							if(count($hearingdetail)=="")
							{
								echo "Order Passed"." - ".date("d-m-Y",strtotime($getRegHearinga['order_date']));
								echo '&nbsp;<a href="http://cicharyana.gov.in/uploads/orders/'.$getRegHearinga['uploaded_file_path'].'" target="_blank">Order</a><br />';
							}
							else{
							foreach ($hearingdetail as $hearingdetailkey => $hearingdetailarray) {
						  $hear= " - ".date("d-m-Y",strtotime($hearingdetailarray['hearing_date'])).", ".$hearingdetailarray['hearing_type'].", ";
							 ?><div style="border:1px solid #ccc;"><?php if($getRegHearinga['case_status']==1){ echo "Disposed Off"." - ".date("d-m-Y",strtotime($getRegHearinga['order_date'])); }elseif($getRegHearinga['case_status']=="0"){ echo "Order Passed"." - ".date("d-m-Y",strtotime($getRegHearinga['order_date'])); }else{ echo "Under Process".$hear.$hears; } 
 
						 echo '&nbsp;<a href="http://cicharyana.gov.in/uploads/orders/'.$getRegHearinga['uploaded_file_path'].'" target="_blank">Order</a><br /></div>';
						   } 
							}// else ends
                        
                          
					  } /////// foreach ends
						 
						 
				} ////// if ends
				else
				{ 
									$hearingdetail = $this->Hiceoms_model->hearing_detail_without_order($value['year'],$value['reg_no']);
									foreach ($hearingdetail as $hearingdetailkey => $hearingdetailarray) {
									?><div style="border:1px solid #ccc;"><?php echo  $hear= "Hearing Date : ".date("d-m-Y",strtotime($hearingdetailarray['hearing_date'])).", ".$hearingdetailarray['hearing_type']."<br /></div>"; 

					}
									
				} ?>
				  
				
				
									</b> </td>
								</tr>
								<?php if(empty($value['substage_no']) || $value['substage_no'] == 1) { ?>
								 <?php /*?><tr bgcolor="#eeeeee">
								     <?php $getHearingdate = $this->Hiceoms_model->get_all_hearing_date_with_perameter($value['year'],$value['reg_no']); ?>
									
									<td colspan="2" class="tablehead1"> <b>Date of Hearing </b> </td><td bgcolor="#ffffff" colspan="3" style="font-size: 12px;color: red"><b><?php  echo !empty($getHearingdate) && !empty($getHearingdate[$value['reg_no']][$value['year']]) ? $getHearingdate[$value['reg_no']][$value['year']] : ''; ?> </b> </td>
								</tr><?php */?>
								<?php } ?>
							
						</tbody>
							<?php } else { ?>
							
						<tbody>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>Reg.No</b> </td> <td bgcolor="#ffffff" style="font-size: 12px;"><?php echo !empty($value['file_no']) ? $value['file_no'] : ''; ?></td>
								</tr>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1">  <b>Registered On</b> </td> <td bgcolor="#ffffff" style="font-size: 12px;"><?php echo !empty($value['registration_date']) ? $value['registration_date'] : ''; ?> </td>
								</tr>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>Subject</b></td><td bgcolor="#ffffff" style="font-size: 12px;"><font size="2" face="verdana" color="blue"><?php echo !empty($value['subject']) ? $value['subject'] : ''; ?></font>
									</td>
								</tr>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>Address</b></td><td bgcolor="#ffffff" style="font-size: 12px;"><?php echo !empty($value['from_whom_reciv']) ? $value['from_whom_reciv'] : ''; ?></td>
								</tr>
								
								<tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>Type of Case</b> </td><td bgcolor="#ffffff" style="font-size: 12px;"><font size="2" face="verdana" color="blue">Appeal</font> </td>
								</tr>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>Department</b> </td><td bgcolor="#ffffff" style="font-size: 12px;">  <?php echo !empty($value['dept_no']) && !empty($getDepartment[$value['dept_no']]) ? $getDepartment[$value['dept_no']] : ''; ?>, <?php echo !empty($value['dist_no']) && !empty($getDistricts[$value['dist_no']]) ? $getDistricts[$value['dist_no']] : ''; ?>  </td>
								</tr>
								 <tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>District</b> </td><td bgcolor="#ffffff" style="font-size: 12px;"> <?php echo !empty($value['dist_no']) && !empty($getDistricts[$value['dist_no']]) ? $getDistricts[$value['dist_no']] : ''; ?> </td>
								</tr>
								<tr bgcolor="#eeeeee">
									<td class="tablehead1"> <b>Rural/Urban</b> </td><td bgcolor="#ffffff" style="font-size: 12px;"><?php echo !empty($value['area']) ? $value['area'] : ''; ?> </td>
								</tr>
								 <tr bgcolor="#eeeeee">
									<td colspan="2" class="tablehead1"> <b>Current Status</b> </td><td bgcolor="#ffffff" colspan="3" style="font-size: 12px;color: red"><b>
									<?php echo !empty($value['stage_no']) && $value['stage_no'] != 0 && !empty($value['substage_no']) && $value['substage_no'] != 6 ? $getStage[$value['stage_no']]['stage_desc'].' - ' : $getStage[1]['stage_desc'].' - '; ?>
									<?php echo !empty($value['substage_no']) ? $getSubStage[$value['substage_no']][$value['stage_no']]['sub_stage_desc'] : $getSubStage[1][$value['stage_no']]['sub_stage_desc']; ?> </b> </td>
								</tr>
								
								<?php if(empty($value['substage_no']) || $value['substage_no'] == 1) { ?>
								 <tr bgcolor="#eeeeee">
								     <?php $getHearingdate = $this->Hiceoms_model->get_all_hearing_date_with_perameter($value['year'],$value['reg_no']); ?>
									
									<td colspan="2" class="tablehead1"> <b>Date of Hearing </b> </td><td bgcolor="#ffffff" colspan="3" style="font-size: 12px;color: red"><b><?php  echo !empty($getHearingdate) && !empty($getHearingdate[$value['reg_no']][$value['year']]) ? $getHearingdate[$value['reg_no']][$value['year']] : ''; ?> </b> </td>
								</tr>
								<?php } ?>
							
						</tbody>
							<?php } ?> 
					</table>
				<?php } ?>
			<?php } ?>
        </div>
    </div>
<?php } ?>


