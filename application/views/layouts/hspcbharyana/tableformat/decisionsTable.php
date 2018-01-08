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
					{"bSortable": false},
					{"bSortable": false},
					{"bSortable": false},
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
					{"bSortable": false},
					<?php } ?>
					{"bSortable": false}
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
					{type: "text"},
					{type: "text"},
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
					{type: "text"},	
					<?php } ?>
					{type: "text",id: "orderdate"}, 
				
					{type: "text"}



				]

			});


        });
    </script>
    <?php $getSic = $this->Hiceoms_model->get_all_sic(); ?>
    <?php $getbench = $this->Hiceoms_model->get_all_bench(); ?>
    <?php $getSubStage = $this->Hiceoms_model->get_all_sub_stage(); ?>
    <?php $getHearingDetails = $this->Hiceoms_model->get_all_hearing_bench(); ?>
    <?php $getRespondentdetails = $this->Hiceoms_model->get_all_respondent_details(); ?>
    <div id="collapse-head">
        <?php $i = 1; ?>
        <div class="title-bar blue-bar top-space" id="heading">
            Decisions 
            <!--<button class="avoid-this pintbutton floatRight"> Print </button>-->
        </div>
        <div>
            <table id="reporttable" class="table table-bordered table-striped table-condensed table-responsive cf printTable" <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] < 500){ ?> style="font-size:9px;" <?php } ?>>
                <thead>
                    <tr>
                        <th>Reg No</th>
                        <th>Name of the Appellant / Complainant</th>
                        <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                        <th>Name of the Public Authority</th>
						<?php } ?>
                        <th>Order Date</th>
                        <th>Bench Name</th>
                    </tr>
					<tr>
                        <th>Reg No</th>
                        <th>Name of the Appellant / Complainant</th>
						<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                        <th>Name of the Public Authority</th>
						<?php } ?>
                        <th>Order Date</th>
                        <th>Bench Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($searchdata as $key => $value) { ?>
                        <tr <?php if ($i % 2 == 0) { ?> class="odd"<?php } else { ?>class="even"<?php } ?>>

                            <td><a href="<?php echo base_url();?>uploads/orders/<?php echo $value['uploaded_file_path']; ?>" title="<?php echo $value['reg_no']; ?>" target="_blank" ><?php echo $value['reg_no']; ?></a></td>
                            <td><?php echo!empty($getSic[$value['reg_no']][$value['year']][0]['applicant_name']) ? $getSic[$value['reg_no']][$value['year']][0]['applicant_name'] : ''; ?></td>
							<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
								<td>
									<?php echo!empty($getRespondentdetails[$value['reg_no']][$value['year']][0]) ? $getRespondentdetails[$value['reg_no']][$value['year']][0] : ''; ?><br>
									<?php echo!empty($getRespondentdetails[$value['reg_no']][$value['year']][1]) ? $getRespondentdetails[$value['reg_no']][$value['year']][1] : ''; ?>
								</td>
							<?php } ?>
                            <td><?php echo $value['order_date']; ?></td>
                            <td><?php if (!empty($getHearingDetails[$value['reg_no']][$value['year']]) && !empty($getbench[$getHearingDetails[$value['reg_no']][$value['year']]]['emp_name'])) {
										echo  $getbench[$getHearingDetails[$value['reg_no']][$value['year']]]['emp_name'];
									} else {
										if(!empty($getbench[$value['commissioner']]['emp_name'])){
											echo $getbench[$value['commissioner']]['emp_name'];
										}
									} ?>
								</td>
                        </tr>
                        <?php $i++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>


