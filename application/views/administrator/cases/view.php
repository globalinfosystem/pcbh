<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('administrator/cases') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>System #Id</td>
						<td><?php echo $row['case_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['case_user_id'],'case_user_id','1:tb_users:id:name|mobile') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Letter Number</td>
						<td><?php echo $row['case_letter_number'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Date</td>
						<td><?php echo $row['case_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Petitioner Name</td>
						<td><?php echo $row['case_petitioner_name'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Respondent Name</td>
						<td><?php echo $row['case_respondent_name'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Subject</td>
						<td><?php echo $row['case_subject'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created Date</td>
						<td><?php echo $row['case_created_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Update Date</td>
						<td><?php echo $row['case_update_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['case_status'],'case_status','1:tb_status:status_id:status_name') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Cuttent Status</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['case_cuttent_status'],'case_cuttent_status','1:tbl_current_status:current_status_id:current_status_name') ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>
</div>
		
        <?php
        if(isset($assign_detail) && !empty($assign_detail)):
		?>
		<div class="table-responsive">	
		<h3>Case Assign Detail</h3>
		
        <table class="table table-striped table-bordered">
		<thead>
		<th width='30%'>
		Assign To
		</th>
		<th>
		Assign Date
		</th>
		</thead>
		<tbody>
		<?php
		foreach($assign_detail as $a_d):
		?>
		<tr>
		<td><?php echo $a_d["username"];?></td>
		<td><?php echo $a_d["case_asign_date_of_assign"];?></td>
		</tr>
		<?php
		endforeach;
		?>
		</tbody>
		</table>
		</div>
		
		<?php
        endif;
		?>	
         <?php
        if(isset($hearing_detail) && !empty($hearing_detail)):
		?>
		<div class="table-responsive">	
		<h3>Case Hearing Detail</h3>
		
        <table class="table table-striped table-bordered">
		<thead>
		<th>
		Office Name
		</th>
		<th>
		Hearing Date
		</th>
		<th>
		Hearing Time
		</th>
		<th>
		Address
		</th>
		<th>
		Remark
		</th>
		</thead>
		<tbody>
		<?php
		foreach($hearing_detail as $h_d):
		?>
		<tr>
		<td><?php echo $h_d["username"];?></td>
		<td><?php echo $h_d["hearing_next_date"];?></td>
		<td><?php echo $h_d["hearing_time"];?></td>
		<td><?php echo $h_d["address_address"];?></td>
		<td><?php echo $h_d["remark"];?></td>
		</tr>
		<?php
		endforeach;
		?>
		</tbody>
		</table>
		</div>
		<?php
        endif;
		?>
         <?php
        if(isset($case_status_detail) && !empty($case_status_detail)):
		?>
		<div class="table-responsive">	
		<h3>Case Status</h3>
		
        <table class="table table-striped table-bordered">
		<thead>
		<th>
		Office Name
		</th>
		<th>
		Case Status
		</th>
		<th>
		Date
		</th>
		<th>
		Remark
		</th>
		<th>
		Attachment
		</th>
		</thead>
		<tbody>
		<?php
		foreach($case_status_detail as $s_d):
		?>
		<tr>
		<td><?php echo $s_d["username"];?></td>
		<td><?php echo $s_d["case_status"];?></td>
		<td><?php echo $s_d["disposed_date"];?></td>
		<td><?php echo $s_d["disposed_remark"];?></td>
		<td>
		<?php
		if(!empty($s_d["attachment"])):
		?>
		<a href="<?php echo base_url().$s_d["attachment"];?>" target="_blank"><?php echo base_url().$s_d["attachment"];?></a>
		<?php
		endif;
		?>
		</td>
		</tr>
		<?php
		endforeach;
		?>
		</tbody>
		</table>
		</div>
		<?php
        endif;
		?>		
		
	</div>
	
</div>
	  