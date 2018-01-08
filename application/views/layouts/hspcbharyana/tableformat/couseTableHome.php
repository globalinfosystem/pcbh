<?php $searchdata= $this->Hiceoms_model->get_couse_list_homepage(); ?>
<?php $getSic= $this->Hiceoms_model->get_all_sic(); ?>
<?php $getbench = $this->Hiceoms_model->get_all_bench(); ?>
<?php $getSubStage = $this->Hiceoms_model->get_all_sub_stage(); ?>
<?php $getHearingDetails = $this->Hiceoms_model->get_all_hearing_bench(); ?>
 <script type="text/javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/tabletools-2.2.0/js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/jquery.dataTables.columnFilter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/datatables-1.9.4/tabletools-2.2.0/css/dataTables.tableTools.css" />
<script>
 function ShowHideTables(count){
	  $('.hidetables').hide();
	  $('#responsiveTable'+count).show();
	  $('.title-bar').removeClass('blue-bar');
	  $('.title-bar').removeClass('green-bar');
	  $('.title-bar').addClass('blue-bar');
	  $('#heading'+count).removeClass('blue-bar');
	  $('#heading'+count).addClass('green-bar');
	  
 }
</script>
<?php if ($searchdata) { ?>
<?php $count = 1;?>
    <?php foreach ($searchdata as $key => $valueAllValue) { ?>		
    <script type="text/javascript">
		$(document).ready(function () {
			
           $('#reporttable<?php echo $count;?>').dataTable();
		   $('.hidetables').hide();
       });
	   
	  
    </script>
	
<div id="collapse-head" style="cursor:pointer;">
        <?php $i = 1; ?>
        <div class="title-bar blue-bar top-space" id="heading<?php echo $count;?>" onclick="ShowHideTables(<?php echo $count;?>)">
            <?php if($count == 1){ ?> Today cases <?php } else { ?> Tomorrow Cases <?php } ?>(<?php echo $key;?>)
        </div>
<div>
<div id="responsiveTable<?php echo $count;?>" class="hidetables">
            <table id="reporttable<?php echo $count;?>"
			<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] < 1000){ ?> 
				style="font-size:9px;" 
			<?php } ?> class="table table-bordered table-striped table-condensed table-responsive cf printTable ">
                <thead>
                    <tr>
					<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
						<th>S.No</th>
					<?php } ?>
                        <th>File Number/Year</th>
                        <th>Applicant Name</th>
                         <th>Bench</th>
						 <th>Bench Type</th>
					
                    </tr>
                </thead>
                <tbody>
				<?php if ($valueAllValue) { ?>
                    <?php foreach ($valueAllValue as $key => $value) { ?>				
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
								
							?>
							
							</td>
							
                           
							
							
							<td><?php echo !empty($getbench[$value['bench']]['emp_name']) ? $getbench[$value['bench']]['emp_name'] : '';?></td>
							<td><?php echo !empty($value['bench_type']) && $value['bench_type'] == 1 ? 'Single' : '';?></td>
                            </tr>
                            <?php $i++; ?>
                    <?php } ?>
					<?php } else { ?>
						<tr class="odd">
						<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 1000){ ?>
							<td colspan="5" align="center" >No Case Record Available</td>
						<?php } else {  ?>
						<td colspan="3" align="center"></td>
						<?php } ?>
						</tr>
					<?php } ?>
                </tbody>
            </table>
        </div>
       </div>
    </div>
<?php $count++;?>
<?php } ?>
<?php } ?>

