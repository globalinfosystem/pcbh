  <?php usort($tableGrid, "SiteHelpers::_sort"); ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>design/css/table_responsive.css" type="text/css"  />
  <style>
  .tablebutton{list-style:none;}
	.tablebutton li{float:left;margin-right: 0.3%;}
	.innerfrom{
		float:left;
	}
	
  @media
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
		.tablebuttonmoble{list-style:none;width:185px; position:fixed; right:0px; z-index:9999;display:none;}
		.tablebutton{display:none;}
		.tablebuttonmoble li{float:none;display: block}
		.table-actions form{float:left;}
        .mobileicon{color:#106B58;font-size:1.5em;cursor: pointer;} 
        .mobileicon{display:none;}
		/*
		Label the data
		*/
		td:nth-of-type(1):before { content: "No"; }
		td:nth-of-type(2):before { content: ""; }
		td:nth-of-type(3):before { content: ""; }
		<?php 
				foreach ($tableGrid as $k => $t) : ?>
					<?php if($t['view'] =='1'): ?>
					 
					td:nth-of-type(<?php echo $k+3;?>):before { content: "<?php echo $t['label'] ?>"; }
                         
					<?php endif; ?>
				<?php endforeach; ?>
		td:nth-of-type(10):before { content: "Status"; }
		td:nth-of-type(11):before { content: "Cuttent Status"; }
		
	}
	
  </style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
        <li class="active"><?php echo $pageTitle ?></li>
      </ul>

    </div>


	<div class="page-content-wrapper m-t">
    <div class="toolbar-line ">		
    <ul class="tablebuttonmoble" style="display:none;">
	   
	   <li class="fa fa-eye view mobileicon"  data-toggle="tooltip" 
	   title="View">
	   </li>
	   <li class="fa fa-file-pdf-o attechments mobileicon"  data-toggle="tooltip" 
	   title="Attechments">
	   </li>
	   <li class="fa fa-pencil-square-o edit mobileicon" data-toggle="tooltip" 
	   title="Edit">
	   </li>
	   <li class="fa fa-times disposeoff mobileicon"  data-toggle="tooltip" 
	   title="Dispose Off">
	   </li>
	   <li class="fa fa-arrow-right assign mobileicon"  data-toggle="tooltip" 
	   title="Assign">
	   </li>
	   
	   <li class="fa fa-user hearing mobileicon"  data-toggle="tooltip" 
	   title="Hearing">
	   </li>
	   <li class="fa fa-user edit_hearing mobileicon"  data-toggle="tooltip" 
	   title="Edit Hearing">
	   </li>
	   <li class="fa fa-check decided mobileicon"  data-toggle="tooltip" 
	   title="Decided">
	    </li>
      </ul>
		
	<ul class="tablebutton">
	   
	   <li>
	   <button type="button" class="btn-xs upper_button view viewadd" id="view" disabled="disabled">View</button>
	   </li>
	   <li>
	   <button type="button" class="btn-xs upper_button attechments attechmentsadd" id="attechments" disabled="disabled">Attechments</button>
	   </li>
	   <li>
	   <button type="button" class="btn-xs upper_button edit editadd" id="edit" disabled="disabled">Edit</button>
	   </li>
	   <li>
	   <button type="button" class="btn-xs upper_button disposeoff disposeoffadd" id="disposeoff" disabled="disabled">Dispose Off</button>
	   </li>
	   <li>
	   <button type="button" class="btn-xs upper_button assign assignadd" id="assign" disabled="disabled">Assign</button>
	   </li>
	   <li>
	   <button type="button" class="btn-xs upper_button hearing hearingadd" id="hearing" disabled="disabled">Hearing</button>
	   </li>
	   <li>
	   <button type="button" class="btn-xs upper_button edit_hearing edit_hearingadd" id="edit_hearing" disabled="disabled">Edit Hearing</button>
	   </li>
	   <li>
	    <button type="button" class="btn-xs upper_button decided decidedadd" id="decided" disabled="disabled">Decided</button>
	   </li>
      </ul>
	  
       <?php if($this->access['is_add'] ==1) : ?>
		<a href="<?php echo site_url('/usercase') ?>" class="tips btn btn-xs btn-info"  title="<?php echo $this->lang->line('core.btn_new'); ?>">
		<i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('core.btn_new'); ?> </a>
		<?php endif;
		if($this->access['is_remove'] ==1) : ?>		
		<a href="javascript:void(0);"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="<?php echo $this->lang->line('core.btn_remove'); ?>">
		<i class="fa fa-trash-o"></i>&nbsp;<?php echo $this->lang->line('core.btn_remove'); ?> </a>
		<?php endif;
		if($this->access['is_excel'] ==1) : ?>	
		<a href="<?php echo site_url('administrator/cases/download') ?>" class="tips btn btn-xs btn-default" title="<?php echo $this->lang->line('core.btn_download'); ?>">
		<i class="fa fa-download"></i>&nbsp;<?php echo $this->lang->line('core.btn_download'); ?></a>
		<?php endif;?>
	  
	  
	</div>
	<div class="innerfrom">
	<?php
	$success_message=$this->session->flashdata('message');
    $error_message=$this->session->flashdata('errors');
	?>
	<?php
	 if(!empty($success_message)):
	?>
	<div class="alert alert-success">
	<?php echo $success_message;?>
	</div>
	<?php
	 endif;
	?>
	<?php
	 if(!empty($error_message)):
	?>
	<div class="alert alert-danger">
	<?php echo $error_message;?>
	</div>
	<?php
	 endif;
	?>
	 <form action='<?php echo site_url('administrator/cases/destroy') ?>' class='form-horizontal' id ='SximoTable' method="post" >
	 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	 <div>
    <table class="table table-striped " width="100%">
        <thead>
			<tr>
				<th> No </th>
				<th>&nbsp;</th>

				<?php 
				
				foreach ($tableGrid as $k => $t) : ?>
					<?php if($t['view'] =='1'): ?>
					 
						<th><?php echo $t['label'] ?></th>
                         
					<?php endif; ?>
				<?php endforeach; ?>
				
	      </tr>
        </thead>

        <tbody>
			<tr id="sximo-quick-search" >
				<td> # </td>
				<td><input type="hidden"  value="Search">
				<button type="button"  class=" do-quick-search btn btn-xs btn-info" ><i class="fa fa-search" ></i> </button> </td>
				<?php foreach ($tableGrid as $t) :?>
					<?php if($t['view'] =='1') :?>
					<td>						
						<?php echo SiteHelpers::transForm($t['field'] , $tableForm) ;?>								
					</td>
					<?php endif;?>
				<?php endforeach;?>
				
				
			  </tr>			
			<tr >
			<?php 
			
			foreach ( $rowData as $i => $row ) :
			$nextdate=$case_next_date[$row->case_id];
			
			$current_time_stamp=strtotime(date('Y-m-d'));
			$nextdate_time_stamp=strtotime($nextdate);
			
			?>
                <tr>
					<td width="50"> <?php echo ($i+1+$page) ?> </td>
					<td width="50">
					<input type="checkbox" class="ids" name="id[]" value="<?php echo $row->case_id ?>" />  
					</td>
				 <?php foreach ( $tableGrid as $j => $field ) :?>
					 <?php if($field['view'] =='1'): ?>
					 <td>
					 	<?php if($field['attribute']['image']['active'] =='1'): ?>
							<?php echo SiteHelpers::showUploadedFile($row->$field['field'] , $field['attribute']['image']['path'] ) ?>
						<?php else: ?>
							<?php 
							$conn = (isset($field['conn']) ? $field['conn'] : array() ) ;
							echo SiteHelpers::gridDisplay($row->$field['field'] , $field['field'] , $conn ) ?>
						<?php endif; ?>
					 </td>

					 <?php endif; ?>
				 <?php endforeach; ?>
				 	</tr>			 	
						<?php 
						if($access['is_detail'] ==1) : 
						?>
						<input type="hidden" value="<?php echo site_url('administrator/cases/show/'.$row->case_id)?>" id="view_<?php echo $row->case_id; ?>">
						
						<?php 
					    endif;
						?>
						<?php
						if($access['is_edit'] ==1 && ($groupid==1 && $row->case_cuttent_status==1) || ($groupid==3 && $row->case_cuttent_status==1 && $row->case_status==1) ): 
						?>
						<input type="hidden" value="<?php echo site_url('administrator/cases/add/'.$row->case_id)?>" id="edit_<?php echo $row->case_id; ?>">
						
						<?php 
						endif;
						?>
						<?php
						
						if((($groupid==2 || $groupid==1) && ($row->case_cuttent_status!=5 && $row->case_cuttent_status!=4) && $row->case_status==1)):
						?>
						<input type="hidden" value="<?php echo site_url('administrator/cases/change_status/'.$row->case_id.'/disposeoff')?>" id="disposeoff_<?php echo $row->case_id; ?>">
						
						<?php 
						endif;
						?>
						<?php
						if($row->case_cuttent_status==1 && $groupid==1 && $row->case_status==1):
						?>
						<input type="hidden" value="<?php echo site_url('administrator/cases/case_assign/'.$row->case_id)?>" id="assign_<?php echo $row->case_id; ?>">
				       
                        <?php
						endif;
                        ?>
						<?php 
						if((($groupid==2 || $groupid==1) && $row->case_cuttent_status==2 ) && $row->case_status==1 && $nextdate!=0 && ($current_time_stamp>=$nextdate_time_stamp)):
						?>
					   <input type="hidden" value="<?php echo site_url('administrator/cases/case_hearing/'.$row->case_id)?>" id="hearing_<?php echo $row->case_id; ?>">	
					   
					   <?php
						endif;
						?>
						<?php
						if(($groupid==2 || $groupid==1) && $row->case_cuttent_status==3 && $row->case_status==1):
						?>
						<input type="hidden" value="<?php echo site_url('administrator/cases/edithearing/'.$row->case_id)?>" id="edit_hearing_<?php echo $row->case_id; ?>">	
						 
						<?php
						if($nextdate!=0 && ($current_time_stamp>=$nextdate_time_stamp))
						{	
						?>
					   <input type="hidden" value="<?php echo site_url('administrator/cases/change_status/'.$row->case_id.'/decided')?>" id="decided_<?php echo $row->case_id; ?>">		
					   
		               <?php
						}
					   ?>
						<?php
						endif;
						?>
						
			<input type="hidden" value="<?php echo base_url()?>administrator/caseattechments/files/<?php echo $row->case_id;?>" id="attechments_<?php echo $row->case_id;?>">          

            <?php endforeach; ?>

        </tbody>

    </table>
	</div>
	</div>
	</form>
	</div>
	<?php echo $this->load->view('footer');?>
	</div>
</div>

<script>
function add_remove_attr()
{

	    $view_url=null;
		$attechments_url=null;
        $edit_url=null;
        $dispose_url=null;
        $assign_url=null;
        $hearing_url=null;
        $edit_hearing_url=null;
        $decided_url=null;
		$(".mobileicon").hide();
	    $(".icheckbox_square-green").removeClass("checked");
		$(".ids").prop('checked', false);
		$(".view").removeClass("btn-warning");
		$('.view').prop("disabled", true);
		$(".attechments").removeClass("btn-primary");
		$(".attechments").prop("disabled", true);
		$(".edit").removeClass("btn-success");
		$('.edit').prop("disabled", true);
		$(".assign").removeClass("btn-primary");
		$('.assign').prop("disabled", true);
		$(".disposeoff").removeClass("btn-danger");
		$('.disposeoff').prop("disabled", true);
		$(".hearing").removeClass("btn-primary");
		$('.hearing').prop("disabled", true);
		$(".edit_hearing").removeClass("btn-primary");
		$('.edit_hearing').prop("disabled", true);
		$(".decided").removeClass("btn-primary");
		$('.decided').prop("disabled", true);
	
}
$view_url=null;
$edit_url=null;
$dispose_url=null;
$assign_url=null;
$hearing_url=null;
$edit_hearing_url=null;
$decided_url=null;
$attechments_url=null;
$check_id=0;
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','<?php echo site_url("administrator/cases/multisearch");?>');
		$('#SximoTable').submit();
	});
	$(".mobileicon").hover(function(){
		
	});
	$(".iCheck-helper").on("click",function()
	{
		add_remove_attr();
		
		var next_dom=$(this).prev();
		var parrent_dom=next_dom.parent();
		var row_id=next_dom.val();
		
		if($check_id==row_id)
		{
			$check_id=0;
			return false;
		}
		$check_id=row_id;
		var i_x=false;
		if($("#view_"+row_id).length)
		{
			 $view_url=$("#view_"+row_id).val();
			 $(".viewadd").addClass("btn-warning");
			 $('.view').prop("disabled", false);
			  $('.view').show();
			 i_x=true;
		}
        if($("#edit_"+row_id).length)
        {
			$edit_url=$("#edit_"+row_id).val(); 
			$(".editadd").addClass("btn-success");
			$('.edit').prop("disabled", false);
			$('.edit').show();
			i_x=true;
		}
        if($("#assign_"+row_id).length)
        {
			 $assign_url=$("#assign_"+row_id).val(); 
			 $(".assignadd").addClass("btn-primary");
			 $('.assign').prop("disabled", false);
			 $('.assign').show();
			 i_x=true;
		}
        if($("#disposeoff_"+row_id).length)
        {
			$dispose_url=$("#disposeoff_"+row_id).val();
			$(".disposeoffadd").addClass("btn-danger");
			$('.disposeoff').prop("disabled", false);
			$('.disposeoff').show();
			i_x=true;
		}
        if($("#hearing_"+row_id).length)
        {
			$hearing_url=$("#hearing_"+row_id).val();
			$(".hearingadd").addClass("btn-primary");
			$('.hearing').prop("disabled", false);
			$('.hearing').show();
			i_x=true;
		}
        if($("#edit_hearing_"+row_id).length)
        {
			$edit_hearing_url=$("#edit_hearing_"+row_id).val();
			$(".edit_hearingadd").addClass("btn-primary");
			$('.edit_hearing').prop("disabled", false);
			$('.edit_hearing').show();
			i_x=true;
		}
        if($("#decided_"+row_id).length)
        {
			$decided_url=$("#decided_"+row_id).val();
			$(".decidedadd").addClass("btn-primary");
			$('.decided').prop("disabled", false);
			$('.decided').show();
			i_x=true;
		}
		if(i_x)
		{
		    $attechments_url=$("#attechments_"+row_id).val();
           $(".attechmentsadd").addClass("btn-primary");
		    $(".attechments").prop("disabled", false);
			$(".attechments").show();
	
		}	
		next_dom.prop('checked', true);		
		var parrent_dom=next_dom.parent();
		parrent_dom.addClass("checked");
		
		//if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) 
		if($(window).width()<700) 
		{
          $('.tablebuttonmoble').show();
        }else
		{
			
		$('.tablebutton').show();	
		}	
	});
   	$(".view").click(function()
	{
		document.location.href=$view_url;
	});
	$(".edit").click(function(){
		
		document.location.href=$edit_url;
	});
	$(".assign").click(function(){
		
		document.location.href=$assign_url;
	});
	$(".hearing").click(function(){
		
		document.location.href=$hearing_url;
	});
	$(".edit_hearing").click(function(){
		
		document.location.href=$edit_hearing_url;
	});
	$(".decided").click(function(){
		
		document.location.href=$decided_url;
	});
	$(".disposeoff").click(function()
	{
		document.location.href=$dispose_url;
	});
	$(".attechments").click(function(){
		
		document.location.href=$attechments_url;
	});
	$("button").live("change", function(){
    $("p").slideToggle();
   });
});	


</script>
