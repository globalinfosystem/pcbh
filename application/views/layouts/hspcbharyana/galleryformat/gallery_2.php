
<?php $galleriesImage = SiteHelpers::getGalleryImages($gallery_id); ?>
<?php $galleries = SiteHelpers::getGallery('image'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>administrator/themes/mango/js/fancybox/source/jquery.fancybox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>administrator/themes/mango/js/fancybox/source/helpers/jquery.fancybox-buttons.css" />
<style type="text/css">
    /* this demo specifc styles */
    .imgContainer {
        width: 200px;
        height: 200px;
        overflow: hidden;
        text-align: center;
        margin: 10px 20px 10px 0;
        float: left;
        border: solid 1px #999;
        display: block;
    }
    .imgContainer:hover{
        border-bottom: solid 1px #444;
        border-left: solid 1px #444;
        -webkit-box-shadow: -3px 3px 10px 1px #777;
        -moz-box-shadow: -3px 3px 10px 1px #777;
        box-shadow: -3px 3px 10px 1px #777;
        margin: 9px 19px 11px 1px;
    }
    #galleryTab {
        margin: 10px 5px 20px 0;
        top: 26px;
    }
    .galleryWrap {
        padding: 0 0 30px;
    }
    .filter {
        background-color: #00a53c;
        color: #fff;
        float: left;
        font-size: 15px;
        margin: 0 12px 0 0;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
          }
    .filter:hover {
        background-color: #f39c12;
		 color: #fff;
             
    }
    .filter.active {
        background-color: #f39c12;
                color: #fff;
        cursor: default;
        margin: 0 12px 0 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;  
    }
</style>
<script src="<?php echo base_url() ?>administrator/themes/mango/js/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url() ?>administrator/themes/mango/js/fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
<script>
    $(function ($) {
        $(".fancybox").fancybox({
            modal: true,
            helpers: {buttons: {}}
        });
        $(".filter").on("click", function () {
            var $this = $(this);
            // if we click the active tab, do nothing
            if (!$this.hasClass("active")) {
                $(".filter").removeClass("active");
                $this.addClass("active"); // set the active tab
                var $filter = $this.data("rel"); // get the data-rel value from selected tab and set as filter
                $filter == 'all' ? // if we select "view all", return to initial settings and show all
                        $(".fancybox").attr("data-fancybox-group", "gallery").not(":visible").fadeIn()
                        : // otherwise
                        $(".fancybox").fadeOut(0).filter(function () {
                    return $(this).data("filter") == $filter; // set data-filter value as the data-rel value of selected tab
                }).attr("data-fancybox-group", $filter).fadeIn(1000); // set data-fancybox-group and show filtered elements
            } // if
        }); // on
    }); // ready
</script>
<div id="wrap" class="cf">
    <div id="galleryTab" class="cf clearfix">
        <a data-rel="all" href="javascript:;" class="filter active">View all</a>
        <?php foreach ($galleriesImage as $keyMenu => $valueMenu) { ?>

            <a data-rel="<?php echo $galleries[$keyMenu]; ?>" href="javascript:;" class="filter"><?php echo $galleries[$keyMenu]; ?></a>

        <?php } ?>
    </div>
    <div class="galleryWrap cf">
        <?php foreach ($galleriesImage as $key => $value) { ?>

            <?php foreach ($value as $keySub => $valueSub) { ?>
                <a class='fancybox imgContainer' href='<?php echo base_url() . 'uploads/galleryImages/' . $valueSub['gallary_image_path']; ?>' data-fancybox-group='gallery' data-filter='<?php echo $galleries[$key]; ?>'><img src='<?php echo base_url() . 'uploads/galleryImages/' . $valueSub['gallary_image_path']; ?>' alt='<?php echo $valueSub['gallary_image_title']; ?>' /></a>
                <?php } ?>

        <?php } ?>
    </div>
</div>
