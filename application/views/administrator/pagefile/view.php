<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('administrator/pagefile') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>File Id</td>
						<td><?php echo $row['tb_page_file_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>File Title</td>
						<td><?php echo $row['tb_page_file_title'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>File Path</td>
						<td><?php echo $row['tb_page_file_path'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>File Status</td>
						<td><?php echo $row['tb_page_file_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>File PageId</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['tb_page_file_pageId'],'tb_page_file_pageId','1:tb_pages:pageID:title') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>File Created Date</td>
						<td><?php echo $row['tb_page_file_created_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>File Updated Date</td>
						<td><?php echo $row['tb_page_file_updated_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>File Display Type</td>
						<td><?php echo $row['th_page_file_display_type'] ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>    
		</div>
	</div>
	
</div>
	  