<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('administrator/caseassign') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>Asign Systems #Id</td>
						<td><?php echo $row['case_asign_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Case</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['case_asign_case_id'],'case_asign_case_id','1:tbl_case:case_id:case_id|case_letter_number|case_subject') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Officer</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['case_asign_officer_id'],'case_asign_officer_id','1:tb_users:id:name|mobile') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Date Of Assign</td>
						<td><?php echo $row['case_asign_date_of_assign'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created Date</td>
						<td><?php echo $row['case_asign_created_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Update Date</td>
						<td><?php echo $row['case_asign_update_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['case_asign_status_id'],'case_asign_status_id','1:tb_status:status_id:status_name') ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>    
		</div>
	</div>
	
</div>
	  