<?php $pageimages = SiteHelpers::pageInfo($pageId,'image'); ?>
<?php $i = 1; ?>
<?php foreach ($pageimages as $pageimage) : ?>
<?php if(isset($_SESSION['screen_width']) && $_SESSION['screen_width'] > 500){ ?>
	<?php if($pageimage->th_page_image_display_type == 'New Window') { ?>
		<a href="<?php echo base_url();?>uploads/image/<?php echo $pageimage->tb_page_image_path;?>" target="_blank" title="<?php echo $pageimage->tb_page_image_title;?>"><?php echo $pageimage->tb_page_image_title;?></a><br>
	<?php } ?>
	
	<?php if($pageimage->th_page_image_display_type == 'Open Popup') { ?>
		<a href="javascript:void(0);" class="page_current" onclick="popups('<?php echo base_url();?>page/popup/<?php echo $pageimage->tb_page_image_id;?>/image');"><?php echo $pageimage->tb_page_image_title;?></a><br>
	<?php } ?>
	
	<?php if($pageimage->th_page_image_display_type == 'Same Window') { ?>
		<div class="title-bar green-bar"><?php echo $pageimage->tb_page_image_title;?></a></div>
		<img src="<?php echo base_url();?>uploads/image/<?php echo $pageimage->tb_page_image_path;?>" class="img-responsive" />
	<?php } ?>
 <?php } else { ?>
<div class="title-bar green-bar"><?php echo $pageimage->tb_page_image_title;?></a></div>
		<img src="<?php echo base_url();?>uploads/image/<?php echo $pageimage->tb_page_image_path;?>" class="img-responsive" />
<?php } ?>  
<?php endforeach; ?>
