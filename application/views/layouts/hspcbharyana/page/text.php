<?php $pagetexts = SiteHelpers::pageInfo($pageId,'text'); ?>
<?php $i = 1; ?>
<?php foreach ($pagetexts as $pagetext) : ?>
	<?php if($pagetext->th_page_text_display_type == 'Accordian') { ?>
		<div class="title-bar green-bar"><?php echo $pagetext->tb_page_text_title;?></a></div>
		<p><?php echo $pagetext->tb_page_text_text;?></p>
	<?php } ?>
	
	<?php if($pagetext->th_page_text_display_type == 'Non Accordian') { ?>
		<div class="title-bar green-bar"><?php echo $pagetext->tb_page_text_title;?></a></div>
		<p><?php echo $pagetext->tb_page_text_text;?></p>
	<?php } ?>
    
<?php endforeach; ?>
