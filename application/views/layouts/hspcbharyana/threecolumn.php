<?php $this->load->view('layouts/' . CNF_THEME . '/header', array('pageAlias' => (!empty($pageAlias)) ? $pageAlias : '', 'pageTitle' => (!empty($pageTitle)) ? $pageTitle : '')); ?>

<div class="row">
     <?php if (!empty($is_slider)) { ?>
        <?php //$this->load->view('layouts/' . CNF_THEME . '/tableformat/slider', array('posttype' => $is_slider), false); ?>
    <?php } else { ?>
        <?php if (!empty($headerImage)) { ?>
            <div class = "inner-page">
                <img src = "<?php echo base_url(); ?>uploads/headerImage/<?php echo $headerImage; ?>" alt = "CIC Header " class = "img-responsive">
            </div><!--/.full-banner-->
        <?php } else if (!empty($featureImage)) { ?>
            <div class = "inner-page">
                <img src = "<?php echo base_url(); ?>uploads/featureImage/<?php echo $featureImage; ?>" alt = "CIC Feature " class = "img-responsive">
            </div><!--/.full-banner-->
        <?php } else { ?>
           
        <?php } ?>
    <?php } ?>
</div>
<div id="skip_to_main"></div>
<div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3  top-space" id="left">
            <div id="sidebar">
		
			<?php //$this->load->view('layouts/' . CNF_THEME . '/sideMenu', array('position' => 'leftSide')); ?>	
			<?php //$this->load->view('layouts/' . CNF_THEME . '/sideMenu', array('position' => 'rightSide')); ?>	
			</div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6  top-space" id="center">
				<div class="container width-100">
				
				<div class="col-md-12 col-sm-12 ">
						 <div class="internal_content">
							<article class="item-page desktop_show">
									<div class="container-fluid" style="width:100%;">
										<?php echo $content; ?>
										</div>
										</article>
									</div>	
									</div>
			<?php if(!empty($pageId)) { ?>
			    <?php if($pageId == 428){ ?>
					<?php $this->load->view('layouts/' . CNF_THEME . '/page/file', array('pageId' => $pageId)); ?><br>
					<?php $this->load->view('layouts/' . CNF_THEME . '/page/image', array('pageId' => $pageId)); ?><br>
					<?php $this->load->view('layouts/' . CNF_THEME . '/page/text', array('pageId' => $pageId)); ?><br>
					<?php $this->load->view('layouts/' . CNF_THEME . '/page/pdf', array('pageId' => $pageId)); ?>
				<?php } else { ?>
				<?php $this->load->view('layouts/' . CNF_THEME . '/page/pdf', array('pageId' => $pageId)); ?><br>
				<?php $this->load->view('layouts/' . CNF_THEME . '/page/file', array('pageId' => $pageId)); ?><br>
					<?php $this->load->view('layouts/' . CNF_THEME . '/page/image', array('pageId' => $pageId)); ?><br>
					<?php $this->load->view('layouts/' . CNF_THEME . '/page/text', array('pageId' => $pageId)); ?><br>
					
				<?php } ?>
			<?php } ?>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3  top-space" id="right">
            <div id="sidebarright">
				<?php //$this->load->view('layouts/' . CNF_THEME . '/profileleft'); ?>	
			<?php // $this->load->view('layouts/' . CNF_THEME . '/profileright'); ?>	
			
			</div>
        </div>
</div>
</div>
<?php $this->load->view('layouts/' . CNF_THEME . '/footer'); ?>   