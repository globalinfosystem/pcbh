    <script src="<?php echo base_url();?>design/themes/<?php echo CNF_THEME;?>/carouselengine/amazingcarousel.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/themes/<?php echo CNF_THEME;?>/carouselengine/initcarousel-1.css">
    <script src="<?php echo base_url();?>design/themes/<?php echo CNF_THEME;?>/carouselengine/initcarousel-1.js"></script>
	<style>
	#amazingcarousel-container-1 {
    padding: 0 !important;
}
.amazingcarousel-image > div {display:none !important;}
	</style>
<?php $getProfile = $this->Hiceoms_model->get_profiles(2);?>
<?php if(!empty($getProfile)) { ?>
<div id="amazingcarousel-container-1">
    <div id="amazingcarousel-1" style="display:none;position:relative;width:100%;max-width:240px;margin:0px auto 0px;">
        <div class="amazingcarousel-list-container">
            <ul class="amazingcarousel-list">
			
					<?php foreach($getProfile as $profile) { ?>
                <li class="amazingcarousel-item">
                    <div class="amazingcarousel-item-container">
					<?php if(!empty($profile['profile_pics'])) { ?>
												
												<div class="amazingcarousel-image"><a href="<?php echo base_url();?>uploads/Profiles/<?php echo trim($profile['profile_pics']);?>" title="arrowdown"  class="html5lightbox" data-group="amazingcarousel-1"><img src="<?php echo base_url();?>uploads/Profiles/<?php echo trim($profile['profile_pics']);?>"  alt="arrowdown"  /></a></div>
											<?php } ?>
					
					<div class="amazingcarousel-text">
						<div class="amazingcarousel-title"><?php echo trim($profile['profile_name']);?></div>
						<div class="amazingcarousel-description"><?php echo trim($profile['designation']);?></div>
					</div>                    
					</div>
                </li>
				<?php } ?>
            </ul>
            <div class="amazingcarousel-prev"></div>
            <div class="amazingcarousel-next"></div>
        </div>
        <div class="amazingcarousel-nav"></div>
        <div class="amazingcarousel-engine"><a href="http://amazingcarousel.com">JavaScript Scroller</a></div>
    </div>
</div>
<?php } ?>
