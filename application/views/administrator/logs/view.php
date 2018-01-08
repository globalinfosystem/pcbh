<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('administrator/logs') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>Log System #Id</td>
						<td><?php echo $row['log_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Case (Case id Case Number Subject)</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['log_case_id'],'log_case_id','1:tbl_case:case_id:case_id|case_letter_number|case_subject') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['log_user_id'],'log_user_id','1:tb_users:id:name|email') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Log Activity</td>
						<td><?php echo $row['log_active'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Log Generate Date</td>
						<td><?php echo $row['log_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Log Description</td>
						<td><?php echo $row['log_description'] ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>    
		</div>
	</div>
	
</div>
	  