<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('administrator/caseattechments') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>File System #Id</td>
						<td><?php echo $row['file_attachment_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Case</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['file_attachment_case_id'],'file_attachment_case_id','1:tbl_case:case_id:case_id|case_letter_number|case_subject') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['file_attachment_user_id'],'file_attachment_user_id','1:tb_users:id:name|mobile') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Uploaded File</td>
						<td>
						<?php echo SiteHelpers::showUploadedFile($row['file_attachment_file_path'],'') ;?> 
						
						</td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created Date</td>
						<td><?php echo $row['file_attachment_created_date'] ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>    
		</div>
	</div>
	
</div>
	  