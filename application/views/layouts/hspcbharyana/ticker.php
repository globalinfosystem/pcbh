<link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME;?>/ticker/ticker-style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME;?>/ticker/jquery.ticker.js" type="text/javascript"></script>
	 
	 <?php $ticker = SiteHelpers::getTickers();
		 if(!empty($ticker)) { ?> 
			<?php foreach ($ticker as $key => $value) { ?>
				<div class="news_wrap">
					<?php if (!empty($value['ticker_path'])) { ?>
					 <span><?php echo $value['ticker_title'];?></span>
						<a href="<?php echo base_url();?>uploads/ticker/<?php echo $value['ticker_path'];?>" target="_blank">Read More...</a>
					<?php } else { ?>
						<span><?php echo $value['ticker_title'];?></span>
					<?php } ?>
				 </div>
		   <?php } ?>
	   <?php } ?>