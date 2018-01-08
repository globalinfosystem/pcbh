<?php $is_slider = SiteHelpers::getSliderImages($posttype); ?>

<?php if (!empty($is_slider)) { ?>
    <div class="slider-block">
    
    <div id="myCarousel" class="carousel slide" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
<?php $i = 1;?>
<?php foreach($is_slider as $is_slider_data){?>
<?php if(!empty($is_slider_data['slider_image_path']) && $is_slider_data['slider_image_status'] == 'enable') { ?>
    <div class="item <?php if( $i == 1){ echo " active";} ?>">
     <img src="<?php echo base_url() ?>uploads/sliderImages/<?php echo $is_slider_data['slider_image_path'];?>" class="img-responsive" alt="slider image"/>
    </div>
<?php $i++;?>
<?php } ?>
<?php } ?>
  </div>
  <!-- Left and right controls -->
 <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
 <span class="glyphicon chevron-left" aria-hidden="true"> <img src="<?php echo base_url() ?>design/themes/agtheme/images/slide-left.png" class="img-responsive" alt="slider image" /> 
 </span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon chevron-right" aria-hidden="true">  <img src="<?php echo base_url() ?>design/themes/agtheme/images/slide-right.png" class="img-responsive" alt="slider image" /> </span>
    <span class="sr-only">Next</span>
  </a>
</div>
      
        

    </div>
<?php
}?>