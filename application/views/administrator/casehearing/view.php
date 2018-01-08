<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('administrator/casehearing') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>Hearing Id</td>
						<td><?php echo $row['hearing_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Case (Case id Case Number Subject)</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['hearing_case_id'],'hearing_case_id','1:tbl_case:case_id:case_id|case_letter_number|case_subject') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Officer Name</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['hearing_officer_id'],'hearing_officer_id','1:tb_users:id:name') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hearing Time</td>
						<td><?php echo $row['hearing_time'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hearing Next Date</td>
						<td><?php echo $row['hearing_next_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Address</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['hearing_address_id'],'hearing_address_id','1:addresses:address_id:address_address') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Remark</td>
						<td><?php echo $row['remark'] ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>    
		</div>
	</div>
	
</div>
	  