<?php $pagepdfs = SiteHelpers::pageInfo($pageId,'pdf'); ?>
<?php $i = 1; ?>
<?php foreach ($pagepdfs as $pagepdf) : ?>
<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
	<?php if($pagepdf->th_page_pdf_display_type == 'New Window') { ?>
		<a  class="page_current" href="<?php echo base_url();?>uploads/pdf/<?php echo $pagepdf->tb_page_pdf_path;?>" target="_blank" title="<?php echo $pagepdf->tb_page_pdf_title;?>"><?php echo $pagepdf->tb_page_pdf_title;?></a><br>
	<?php } ?>
	
	<?php if($pagepdf->th_page_pdf_display_type == 'Open Popup') { ?>
		<a href="javascript:void(0);" class="page_current" onclick="popups('<?php echo base_url();?>page/popup/<?php echo $pagepdf->tb_page_pdf_id;?>/pdf');"><?php echo $pagepdf->tb_page_pdf_title;?></a><br>
	<?php } ?>
	
	<?php if($pagepdf->th_page_pdf_display_type == 'Same Window') { ?>
		<div class="title-bar green-bar"><?php echo $pagepdf->tb_page_pdf_title;?></a></div>
		<iframe width="1000px" height="1000px" src="<?php echo base_url();?>uploads/pdf/<?php echo $pagepdf->tb_page_pdf_path;?>"></iframe>
	<?php } ?>
<?php } else { ?>
<a  class="page_current" href="<?php echo base_url();?>uploads/pdf/<?php echo $pagepdf->tb_page_pdf_path;?>" target="_blank" title="<?php echo $pagepdf->tb_page_pdf_title;?>"><?php echo $pagepdf->tb_page_pdf_title;?></a><br>
<?php } ?>  
<?php endforeach; ?>
