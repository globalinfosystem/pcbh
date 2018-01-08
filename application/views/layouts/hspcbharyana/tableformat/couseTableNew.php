<?php if ($searchdata) { ?>
  <script type="text/javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/tabletools-2.2.0/js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/jquery.dataTables.columnFilter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/tabletools-2.2.0/css/dataTables.tableTools.css" />
    <script type="text/javascript">
		$(document).ready(function () {
            var table = $('#reporttable').dataTable({
                "sDom": 'T<"clear">lfrtip',
                "oColVis": {
                    "activate": "mouseover"
                },
                "sPaginationType": "full_numbers",
				"aoColumns": [
				<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
					{"bSortable": false},
				<?php } ?>
					{"bSortable": false},
					{"bSortable": false},
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
					{"bSortable": false},
					<?php } ?>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
					{"bSortable": false},
					
					{"bSortable": false},
					<?php } ?>
					{"bSortable": false},
					{"bSortable": false},
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
					{"bSortable": false},
					{"bSortable": false}
					<?php } ?>
				],
                "aLengthMenu": [10, 25, 50, 100],
                "oTableTools": {
                    "sSwfPath": "<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/tabletools-2.2.0/swf/copy_csv_xls_pdf.swf",
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
			
			 table.columnFilter({
				aoColumns: [
				<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
					{type: null},
				<?php } ?>
					{type: "text"},
					{type: "text"},
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
					{type: "text"},
					<?php } ?>
				<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
					{type: "text"},
					
					{type: "text"},
					<?php } ?>
					{type: "text"},
					{type: "text"},
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
					{type: "text"},
					{type: "text"}
					<?php } ?>



				]

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
	
	
	<?php 
		// echo "<pre>";
		//print_r($getSic);
		//echo "</pre>"; 
	?>
    <?php $getbench = $this->Hiceoms_model->get_all_bench(); ?>
    <?php $getSubStage = $this->Hiceoms_model->get_all_sub_stage(); ?>
    <?php $getHearingDetails = $this->Hiceoms_model->get_all_hearing_bench(); ?>
    <div id="collapse-head">
        <?php $i = 1; ?>
        <div class="title-bar blue-bar top-space" id="heading">
            Decisions 
            <!--<button class="avoid-this pintbutton floatRight"> Print </button>-->
        </div>
        <div>
            <table <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] < 1000){ ?> style="font-size:9px;" <?php } ?> id="reporttable" class="table table-bordered table-striped table-condensed table-responsive cf printTable">
                <thead>
                    <tr>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
						<th>S.No</th>
					<?php } ?>
                        <th>File Number/Year</th>
                        <th>Applicant Name</th>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
                        <th>Registration Date</th>
					<?php } ?>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
						<th>Subject</th>
					
                       
                        <th>Current Status</th>
					<?php } ?>
                        <th>Hearing Date</th>
                        <th>Bench</th>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
						<th>Bench Type</th>
						<th>Hearing Type</th>
					<?php } ?>
                    </tr>
					 <tr>
						<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
						<th>S.No</th>
					<?php } ?>
                        <th>File Number/Year</th>
                        <th>Applicant Name</th>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
                        <th>Registration Date</th>
					<?php } ?>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
						<th>Subject</th>
					
                       
                        <th>Current Status</th>
					<?php } ?>
                        <th>Hearing Date</th>
                        <th>Bench</th>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
						<th>Bench Type</th>
						<th>Hearing Type</th>
					<?php } ?>
                    </tr>
                </thead>
                <tbody>
				
                    <?php foreach ($searchdata as $key => $value) { ?>
					
					
                        <tr <?php if ($i % 2 == 0) { ?> class="odd"<?php } else { ?>class="even"<?php } ?>>
							<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
								<td><?php echo $i;?></td>
							<?php } ?>
                                
							<td> 
								<?php 
								echo $value['reg_no'].'/'.$value['year'];
								//get_applicant_name($value['reg_no'],$value['year'],'year','1');
								?>
							</td>
                                
							<td>
								<?php 
								get_applicant_name($value['reg_no'],$value['year'],'applicant_name','1');
								/* if(!empty($getSic[$value['reg_no']][$value['year']][0]['applicant_name'])) {
									echo $getSic[$value['reg_no']][$value['year']][0]['applicant_name']; 
								} else {
									if(!empty($getSic[$value['reg_no']][$value['year']][0]['applicant_name'])) {
										echo $getSic[$value['reg_no']][$value['year']][0]['applicant_name'];
									} else {
										get_applicant_name($value['reg_no'],$value['year'],'applicant_name','1');
									}
								} */
							?>
							
							</td>
							
                            <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
							
							<td>
							<?php 
								get_applicant_name($value['reg_no'],$value['year'],'registration_date','1');
								/* if(!empty($getSic[$value['reg_no']][$value['year']][0]['registration_date'])) {
									echo $getSic[$value['reg_no']][$value['year']][0]['registration_date'];
								} else { 
									if(!empty($getSic[$value['reg_no']][$value['year']][0]['registration_date'])){
										get_applicant_name($value['reg_no'],$value['year'],'subject','1');
									} else {
										get_applicant_name($value['reg_no'],$value['year'],'registration_date','1');
									}
									 
								} */
							?>
							</td>
								
								
							<?php } ?>
							
							<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>   
								
							<td>
							<?php
							if(!empty($getSic[$value['reg_no']][$value['year']][0]['subject'])){
								echo $getSic[$value['reg_no']][$value['year']][0]['subject'];
							} else {
								if(!empty($getSic[$value['reg_no']][$value['year']][0]['subject'])){
									get_applicant_name($value['reg_no'],$value['year'],'subject','1');
								} else {
									get_applicant_name($value['reg_no'],$value['year'],'subject','1');
								}
								
							}
							?>
							</td>
                             
								
							<td>
							<?php 
							get_applicant_name($value['reg_no'],$value['year'],'substage_no','2');
							//echo !empty($getSic[$value['reg_no']][$value['year']][0]['substage_no']) ? $getSubStage[$getSic[$value['reg_no']][$value['year']][0]['substage_no']][$getSic[$value['reg_no']][$value['year']][0]['stage_no']]['sub_stage_desc'] : ''; 
							
							?>
							</td>
							
							
							 <?php } ?>
							
							<td><?php echo $value['hearing_date'];?></td>
                                
							<td><?php echo !empty($getbench[$value['bench']]['emp_name']) ? $getbench[$value['bench']]['emp_name'] : '';?></td>
							
							<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
                                
							<td><?php echo !empty($value['bench_type']) && $value['bench_type'] == 1 ? 'Single' : '';?></td>
                                
							<td><?php echo $value['hearing_type'];?></td>
							
							<?php } ?>
                            </tr>
                            <?php $i++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>


