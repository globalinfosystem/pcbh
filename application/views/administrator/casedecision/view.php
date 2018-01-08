<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('administrator/casedecision') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>Disposed Id</td>
						<td><?php echo $row['disposed_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Case (Case id Case Number Subject)</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['disposed_case_id'],'disposed_case_id','1:tbl_case:case_id:case_id|case_letter_number|case_subject') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Officer Name</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['disposed_officer_id'],'disposed_officer_id','1:tb_users:id:name') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Date</td>
						<td><?php echo $row['disposed_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Remark</td>
						<td><?php echo $row['disposed_remark'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Attachment</td>
						<td><?php echo $row['attachment'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status Current Date</td>
						<td><?php echo $row['status_current_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Case Current Status</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['case_current_status'],'case_current_status','1:tbl_current_status:current_status_id:current_status_name') ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>    
		</div>
	</div>
	
</div>
	  