<?php
 $this->load->view('layouts/' . CNF_THEME . '/header', array('pageAlias' => (!empty($pageAlias)) ? $pageAlias : '', 'pageTitle' => (!empty($pageTitle)) ? $pageTitle : '')); ?>
               
		<?php
		 $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		 $homepage=base_url();
		 $homepage1=base_url()."index.php";
		if($url!=$homepage && $url!=$homepage1)
		{
		?>
		<div class="container width-100">
			<?php if ($pageAlias != 'home') { ?>
            <ol class="breadcrumb breadcrumb-arrow top20">
                <?php $menus = SiteHelpers::get_menu_name($this->uri->segment(1)); 
				
				?>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
               
            </ol>
        <?php } ?>

		
		</div>
		<div class="tabing">
			<div class="container width-100">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="tab" role="tabpanel"> 
						 <!-- Nav tabs -->
						 		  <?php 
								  
								  $menus = SiteHelpers::menus('top'); ?>
          
	<!-- Tab panes -->
          <div class="tab-content">
		   <?php
							if (!empty($menus)) { $i=1;
								foreach ($menus as $main) {
								if($main['module']==$pageAlias){
										if (!empty($main['childs'])) {
											?>
												<?PHP $j=1;
												foreach ($main['childs'] as $childs) {
													?>
													 <div role="tabpanel" class="tab-pane fade<?php if($j==1){ ?> in active<?php } ?>" id="Section<?php echo $j; ?>">
													  <div class="row">
														<div class="col-md-12 col-sm-12 ">
														  <div class="internal_content">
															<article class="item-page desktop_show">
															  <div class="container-fluid" style="width:100%;">
																   <div >
                                                                                 
																               <?php echo $content; ?>

																   </div>
																
															  <!-- Tab panes -->
															  
															</div>
															  
															</article>
															  
															  
														  <div class="mobile_showw mobile_link green">
															   <?php  echo $content; ?>
															  <!--<a target="_blank" href="https://docs.google.com/viewer?url=http://haryanait.gov.in/pdf/notification-cyberSecurity.pdf">Notification</a>
															  <a target="_blank" href="https://docs.google.com/viewer?url=http://haryanait.gov.in/pdf/CyberSecurityPolicy5.pdf">Policy</a>-->
														  </div>
														  </div>
														</div>
													  </div>
													</div>
													<?php
												$j++; }
											} 
										 }//===this for custom part use for apply case=======//
										 else if($pageAlias=="apply-case" && $type=="custom")
										 { 
									
									 $x=1;
											 ?>
		<div role="tabpanel" class="tab-pane fade<?php if($x==1){ ?> in active<?php } ?>" id="Section<?php echo $x; ?>">
													  <div class="row">
														<div class="col-md-12 col-sm-12 ">
														  <div class="internal_content">
														  <!---class="item-page desktop_show"-->
															<article>
															  <div class="container-fluid" style="width:100%;">
																   <div style="margin:20px;">
																               <?php

																			   echo $content; 
																			   
																			   ?>

																   </div>
																
															  <!-- Tab panes -->
															  
															</div>
															  
															</article>
															  
															  
														  <div class="mobile_showw mobile_link green">
															   <?php //echo $content; ?>
															 
														  </div>
														  </div>
														</div>
													  </div>
													</div> 
											 
											<?php 
											break;
										 }
										 
								$i++; }
							}
							?>
           
          
          </div>

		<?php
		}else{
		?>
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12" id="center">
                <?php if (!empty($is_gallery)) { ?>
                    <?php $this->load->view('layouts/' . CNF_THEME . '/galleryformat/gallery', array('gallery_id' => $is_gallery), false); ?>
                <?php } ?>
                <?php if (!empty($is_gallery_video)) { ?>
                    <?php $this->load->view('layouts/' . CNF_THEME . '/galleryformat/gallery_video', array('gallery_id' => $is_gallery_video), false); ?>
                <?php } ?>
                <?php if (!empty($is_gallery_audio)) { ?>
                    <?php $this->load->view('layouts/' . CNF_THEME . '/galleryformat/gallery_audio', array('gallery_id' => $is_gallery_audio), false); ?>
                <?php } ?>
                <?php echo $content; ?>
                <?php if (!empty($pageId)) { ?>
                    <?php $this->load->view('layouts/' . CNF_THEME . '/page/file', array('pageId' => $pageId)); ?><br>
                    <?php $this->load->view('layouts/' . CNF_THEME . '/page/image', array('pageId' => $pageId)); ?><br>
                    <?php $this->load->view('layouts/' . CNF_THEME . '/page/text', array('pageId' => $pageId)); ?><br>
                    <?php $this->load->view('layouts/' . CNF_THEME . '/page/pdf', array('pageId' => $pageId)); ?>
                <?php } ?>
            </div>
        </div>
		<?php } ?>
		<?php
		 $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		 $homepage=base_url();
		 $homepage1=base_url()."index.php";
		if($url!=$homepage && $url!=$homepage1)
		{
		?>
		        </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
		<?php
		}
		?>


<?php
 
$this->load->view('layouts/' . CNF_THEME . '/footer'); 
?>   