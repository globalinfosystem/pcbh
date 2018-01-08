<script type="text/javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/tabletools-2.2.0/js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/jquery.dataTables.columnFilter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/tabletools-2.2.0/css/dataTables.tableTools.css" />

<div class="table-responsive">
    <table id="datatable_ajax" <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] < 500){ ?> style="font-size:9px;" <?php } ?> class="table table-bordered table-striped table-condensed table-responsive">
        <thead>
            <tr>
				
                <th>Reg No</th>
                <th>Case Type</th>
                <th>Year</th>
                <th>Name</th>
				<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
					<th>Address</th>
					<th>Respondent</th>
					<th>Subject</th>
					<th>Status</th>
				<?php } ?>
					<th>Decision</th>
            </tr>
            <tr>
                <th>Reg No</th>
                <th>Case Type</th>
                <th>Year</th>
                <th>Name</th>
				<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
					<th>Address</th>
					<th>Respondent</th>
					<th>Subject</th>
					<th>Status</th>
				<?php } ?>
					<th>Decision</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<script class="init">
    var JS = jQuery.noConflict();
    JS(document).ready(function (JS) {
        var baseformUrl = "<?php echo base_url(); ?>administrator/registration/getform/";
        var table = JS('#datatable_ajax').dataTable({
            "sDom": 'T<"clear">lfrtip',
			"aoColumnDefs": [
            {
                "mRender": function (data, type, row) {
					if(data){
						data = data.replace('../writereaddata', '<?php echo base_url();?>uploads/orders/old');
						data = data.replace('./writereaddata', '<?php echo base_url();?>uploads/orders/old');
						var $href = $("<a target='_blank'>Click to View</a>").prop("href", data);
						//var $href = $("<a target='_blank'>Click to View</a>").prop("href", data);
						return $("<div/>").append($href).html();
					} else { 
						data = data.replace('./writereaddata', '<?php echo base_url();?>uploads/orders/old');
						var $href = $("<a target='_blank'></a>").prop("href", data);
						
						return $("<div/>").append($href).html();
					}
                },
				<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                "aTargets": [8]
				<?php } else { ?>
				"aTargets": [4]
				<?php } ?>
            }],
           
            "aLengthMenu": [[10, 25, 50], [10, 25, 50]],
            "aoColumns": [
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
				<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
				<?php } ?>
                {"bSortable": false}
            ],
            "oTableTools": {
                "sSwfPath": "<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/tabletools-2.2.0/swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "sButtonText": "<i class='fa fa-save'></i> EXCEL",
						<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8]
						<?php } else { ?>
						"mColumns": [0, 1, 2, 3,4]
						<?php } ?>
                    },
                    {
                        "sExtends": "csv",
                        "sButtonText": "<i class='fa fa-save'></i> CSV",
                       <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8]
						<?php } else { ?>
						"mColumns": [0, 1, 2, 3,4]
						<?php } ?>
                    },
                    {
                        "sExtends": "pdf",
                        "sButtonText": "<i class='fa fa-save'></i> PDF",
                        "sPdfOrientation": "landscape",
                        "sPdfSize": "tabloid",
                       <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8]
						<?php } else { ?>
						"mColumns": [0, 1, 2, 3,4]
						<?php } ?>
                    },
                    {
                        "sExtends": "print",
                        "sButtonText": "<i class='fa fa-save'></i> PRINT",
                        "sPdfOrientation": "landscape",
                        "sPdfSize": "tabloid",
                     <?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8]
						<?php } else { ?>
						"mColumns": [0, 1, 2, 3,4]
						<?php } ?>
                    }
                ]
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo base_url(); ?>page/get_old_registration_list",
            "sPaginationType": "full_numbers",
            'fnServerData': function (sSource, aoData, fnCallback) {
                JS.ajax
                        ({
                            'dataType': 'json',
                            'type': 'POST',
                            'url': sSource,
                            'data': aoData,
                            'success': fnCallback
                        });
            },
        });
        table.columnFilter({
            aoColumns: [
                {type: "text"},
                {type: "text"},
                {type: "text"},
                {type: "text"},
				<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
                {type: "text"},
                {type: "text"},
                {type: "text"},
                {type: "text"},
                {type: "text"}
				<?php } ?>



            ]

        });
    });
</script>
