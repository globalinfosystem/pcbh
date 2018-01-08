<?php $galleriesImage = SiteHelpers::getGalleryAudios($gallery_id); ?>
<?php $galleries = SiteHelpers::getGallery('audio'); ?>
<style>
    ul {         
        padding:0 0 0 0;
        margin:0 0 0 0;
    }
    ul li {     
        list-style:none;
        margin-bottom:25px;           
    }
    ul li img {
        cursor: pointer;
    }
    .modal-body {
        padding:5px !important;
    }
    .modal-content {
        border-radius:0;
    }
    .modal-dialog img {
        text-align:center;
        margin:0 auto;
    }
    .controls{          
        width:50px;
        display:block;
        font-size:11px;
        padding-top:8px;
        font-weight:bold;          
    }
    .next {
        float:right;
        text-align:right;
    }
    /*override modal for demo only*/
    .modal-dialog {
        max-width:500px;
        padding-top: 90px;
    }
    @media screen and (min-width: 768px){
        .modal-dialog {
            width:500px;
            padding-top: 90px;
        }          
    }
    @media screen and (max-width:1500px){
        #ads {
            display:none;
        }
    }
</style>
<div id="collapse-head">
    <div class="but-sp"> <a href="#" id="closeAll" title="Close all" class="bx-pos"><img src="<?php echo base_url() ?>administrator/themes/mango/images/arrow-up.png" alt="Close all" /></a> <a href="#" id="openAll" title="Open All" class="bx-pos"><img src="<?php echo base_url() ?>administrator/themes/mango/images/arrow-down.png" alt="Open All" /></a></div>
    <?php foreach ($galleriesImage as $key => $value) { ?>
        <div class="page_collapsible" id="body-section1"><?php echo $galleries[$key]; ?><span></span></div>
        <div class="main-box">
            <div class="collapse-box">
                <div class="table-responsive"> 
                    <ul class="row">
                        <?php foreach ($value as $keySub => $valueSub) { ?>
                            <li class="col-sm-3">
                                <img class="img-responsive" src="<?php echo base_url() . 'uploads/galleryImages/' . $valueSub['gallary_image_path']; ?>" alt="<?php echo $valueSub['gallary_image_title']; ?>">
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
</ul> 
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">         
            <div class="modal-body">                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
