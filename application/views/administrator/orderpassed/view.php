<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('administrator/orderpassed') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>System #Id</td>
						<td><?php echo $row['order_passed_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Case</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['order_passed_case_id'],'order_passed_case_id','1:tbl_case:case_id:case_id|case_letter_number|case_petitioner_name') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Officer</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['order_passed_officer_id'],'order_passed_officer_id','1:tb_users:id:name|mobile') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Order Passed Date</td>
						<td><?php echo $row['order_passed_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Uploaded FIle</td>
						<td><?php echo SiteHelpers::showUploadedFile($row['order_passed_file_path'],'uploads/orderfiles') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created Date</td>
						<td><?php echo $row['order_passed_created_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Update Date</td>
						<td><?php echo $row['order_passed_update_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['order_passed_status'],'order_passed_status','1:tb_status:status_id:status_name') ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>    
		</div>
	</div>
	
</div>
	  