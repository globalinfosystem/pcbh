
<?php $galleries = SiteHelpers::getGallerywithalldata('image'); ?>
<link id="bc" href="<?php echo base_url(); ?>design/themes/agtheme/css/imagegallery.css" rel="stylesheet" type="text/css" />
 <script src="<?php echo base_url(); ?>design/themes/agtheme/js/jquery.js"></script>

        <div class="title-bar dark-blue">Image Gallery</div>

<div class="imgcontainer top-space">
  
        <div class="row padding_top_bottom_10">
       
            <div class="col-lg-8 col-sm-8">
             
                <div class="welcome wow fadeInDown" data-wow-duration="1s">
                    
                    <div id="content">
                 
                 
                     <div class="video_outter_div">
                         <div class="row">    
                             <?php if(!empty($galleries)){ ?>
                                        <?php foreach($galleries as $key => $value)
                                        {
                                          
                                            ?>
                                            <?php ?>
                                        <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="img_div">
             <a class="example-image-link" href="<?php echo base_url() ; ?>page/galleryimages/<?php echo $key ?>">
        <img src="<?php echo base_url(); ?>uploads/galleryImages/<?php echo !empty($value['gallery_image'])?$value['gallery_image']:'no-image.png' ?>" alt="" class="example-image" width="270"  height="180" />
       </a>
       <span><?php echo !empty($value['galleries_title'])?$value['galleries_title']:'No-Title'; ?></span>
      </div>
     </div>
                                        
                                        <?php } ?>
                                        
                             <?php } ?>
      
  
      
       
       
      </div>
</div></div><!-- content -->
                </div>

                
            </div>
           
        </div>
    </div>