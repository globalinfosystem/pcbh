<?php $pagefiles = SiteHelpers::pageInfo($pageId,'file'); ?>
<?php $i = 1; ?>
<?php foreach ($pagefiles as $pagefile) : ?>
<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
	<?php if($pagefile->th_page_file_display_type == 'New Window') { ?>
		<a href="<?php echo base_url();?>uploads/file/<?php echo $pagefile->tb_page_file_path;?>" target="_blank" title="<?php echo $pagefile->tb_page_file_title;?>"><?php echo $pagefile->tb_page_file_title;?></a><br>
	<?php } ?>
	
	<?php if($pagefile->th_page_file_display_type == 'Open Popup') { ?>
		<a href="javascript:void(0);" class="page_current" onclick="popups('<?php echo base_url();?>page/popup/<?php echo $pagefile->tb_page_file_id;?>/file');"><?php echo $pagefile->tb_page_file_title;?></a><br>
	<?php } ?>
	
	<?php if($pagefile->th_page_file_display_type == 'Same Window') { ?>
		<div class="title-bar green-bar"><?php echo $pagefile->tb_page_file_title;?></a></div>
		<iframe width="1000px" height="1000px" src="<?php echo base_url();?>uploads/file/<?php echo $pagefile->tb_page_file_path;?>"></iframe>
	<?php } ?>
    <?php } else { ?>
<a href="<?php echo base_url();?>uploads/file/<?php echo $pagefile->tb_page_file_path;?>" target="_blank" title="<?php echo $pagefile->tb_page_file_title;?>"><?php echo $pagefile->tb_page_file_title;?></a><br>
<?php } ?> 
<?php endforeach; ?>
