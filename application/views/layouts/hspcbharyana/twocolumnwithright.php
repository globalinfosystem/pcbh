<?php $this->load->view('layouts/' . CNF_THEME . '/header', array('pageAlias' => (!empty($pageAlias)) ? $pageAlias : '', 'pageTitle' => (!empty($pageTitle)) ? $pageTitle : '')); ?>
<div class="row">
     <?php if (!empty($is_slider)) { ?>
        <?php //$this->load->view('layouts/' . CNF_THEME . '/tableformat/slider', array('posttype' => $is_slider), false); ?>
    <?php } else { ?>
        <?php if (!empty($headerImage)) { ?>
            <div class = "inner-page">
                <img src = "<?php echo base_url(); ?>uploads/headerImage/<?php echo $headerImage; ?>" alt = "HNRC Header " class = "img-responsive">
            </div><!--/.full-banner-->
        <?php } else if (!empty($featureImage)) { ?>
            <div class = "inner-page">
                <img src = "<?php echo base_url(); ?>uploads/featureImage/<?php echo $featureImage; ?>" alt = "HNRC Feature " class = "img-responsive">
            </div><!--/.full-banner-->
        <?php } else { ?>
           
        <?php } ?>
    <?php } ?>
</div>
<div id="skip_to_main"></div>
    <div class="wt-block top-space">
		<?php if($pageAlias != 'home'){?>
        <ol class="breadcrumb">
			<?php $menus = SiteHelpers::get_menu_name($this->uri->segment(1)); ?>
			<li><a href="javascript: history.go(-1)">Back</a></li>
			<?php if(!empty($menus)){ ?>
				<?php
				if(!empty($menus)){
					foreach(array_keys($menus) as $key) {
						if(!empty($key)){
                                                   echo "<li>";
						   echo SiteHelpers::get_menu_name_by_parent_id($key);
                                                  echo "</li>";
						}
					}
				}
				?>
				<?php
				if(!empty($menus)){
					foreach(array_values($menus) as $value) {
 echo "<li>";
					   echo $value;
 echo "</li>";
					}
				}
				?>
<?php } else { ?>
<?php 

$pageNameB = SiteHelpers::get_page_name($this->uri->segment(1));
if(!empty($pageNameB)){
                                                   echo "<li>";
						   echo $pageNameB;
                                                  echo "</li>";
						}
?>
<?php } ?>
		</ol>
		<?php } else {  ?>

		<?php } ?>
            <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8" id="center">
                        <?php if(!empty($is_gallery)){ ?>
                        <?php $this->load->view('layouts/' . CNF_THEME . '/galleryformat/gallery', array('gallery_id' => $is_gallery), false); ?>
                        <?php } ?>
                        <?php if(!empty($is_gallery_video)){ ?>
                        <?php $this->load->view('layouts/' . CNF_THEME . '/galleryformat/gallery_video', array('gallery_id' => $is_gallery_video), false); ?>
                        <?php } ?>
                        <?php if(!empty($is_gallery_audio)){ ?>
                        <?php $this->load->view('layouts/' . CNF_THEME . '/galleryformat/gallery_audio', array('gallery_id' => $is_gallery_audio), false); ?>
                        <?php } ?>
                        <?php echo $content; ?>
						<?php if(!empty($pageId)) { ?>
							<?php $this->load->view('layouts/' . CNF_THEME . '/page/file', array('pageId' => $pageId)); ?><br>
							<?php $this->load->view('layouts/' . CNF_THEME . '/page/image', array('pageId' => $pageId)); ?><br>
							<?php $this->load->view('layouts/' . CNF_THEME . '/page/text', array('pageId' => $pageId)); ?><br>
							<?php $this->load->view('layouts/' . CNF_THEME . '/page/pdf', array('pageId' => $pageId)); ?>
						<?php } ?>
						
                    </div>
                
                <div class="col-xs-12 col-sm-4 col-md-4" style="position:relative" id="right">
                    <div  id="sidebar">
						<?php $this->load->view('layouts/' . CNF_THEME . '/sideMenu', array('position' => 'rightSide')); ?>	
						<?php $this->load->view('layouts/' . CNF_THEME . '/widget', array('position' => 'right', 'dynamicPosition' => !empty($right_widget) ? $right_widget : '')); ?>
                    </div>
                    </div>
            </div>
    </div>
    <?php $this->load->view('layouts/' . CNF_THEME . '/footer'); ?>   
