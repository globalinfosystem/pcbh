<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--<link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>-->
        <title>HNRC</title>
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/css/navbar-static-top.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/css/fonts.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>administrator/themes/hnrc/css/tab-menu.css">
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/css/base.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/header.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/css/responsive.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>administrator/themes/hnrc/css/fonts.css" rel="stylesheet">
        <link rel='stylesheet' id='meteor-slides-css'  href='<?php echo base_url(); ?>administrator/themes/hnrc/css/meteor-slides5152.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' id='faceted-search-style-css'  href='<?php echo base_url(); ?>administrator/themes/hnrc/css/faceted-search50fa.css?ver=4.2.1' type='text/css' media='all' />
        <script type='text/javascript' src='<?php echo base_url(); ?>administrator/themes/hnrc/js/jquery4a80.js?ver=1.11.2'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>administrator/themes/hnrc/js/jquery.cookie50fa.js?ver=4.2.1'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>administrator/themes/hnrc/js/jquery.fontsize50fa.js?ver=4.2.1'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>administrator/themes/hnrc/js/jquery.cycle.all50fa.js?ver=4.2.1'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>administrator/themes/hnrc/js/jquery.metadata.v250fa.js?ver=4.2.1'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>administrator/themes/hnrc/js/jquery.touchwipe.1.1.150fa.js?ver=4.2.1'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var meteorslidessettings = {"meteorslideshowspeed": "3000", "meteorslideshowduration": "500", "meteorslideshowheight": "642", "meteorslideshowwidth": "1349", "meteorslideshowtransition": "fade"};
            /* ]]> */
        </script>
        <script type='text/javascript' src='<?php echo base_url(); ?>administrator/themes/hnrc/js/slideshow50fa.js?ver=4.2.1'></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>administrator/themes/hnrc/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>administrator/themes/hnrc/js/framework.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>administrator/themes/hnrc/js/jquery.bxslider.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>administrator/themes/hnrc/js/wow.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>administrator/themes/hnrc/js/font-size.js"></script>
        <script>
            jQuery(document).ready(function ()
            {
                jQuery("div.skip_to_main a").click(function () {
                    jQuery('html, body').animate({scrollTop: jQuery('#skip_to_main').offset().top - 30},
                    'slow');
                });
                jQuery("#lang_choice").addClass("select-languege");
            });
        </script>
        <script>
            var trackOutboundLink = function (url) {
                ga('send', 'event', 'outbound', 'click', url, {'hitCallback':
                            function () {
                            }
                });
            }

            $(document).ready(function () {
                var curSize;
                $('#incfont').click(function () {
                    curSize = parseInt($('.main-content').css('font-size')) + 2;
                    if (curSize <= 21)
                        $('.main-content').css('font-size', curSize);
                });
                $('#decfont').click(function () {
                    curSize = parseInt($('.main-content').css('font-size')) - 2;
                    if (curSize >= 11)
                        $('.main-content').css('font-size', curSize);
                });
                $('#equal').click(function () {
                    $('.main-content').css('font-size', 17);
                });
            });
        </script>
    </head>

    <body >
        <div class="col-xs-12 col-sm-12 col-md-12">
            <?php echo $content; ?>
			<?php if(!empty($pageId)) { ?>
				<?php $this->load->view('layouts/' . CNF_THEME . '/page/file', array('pageId' => $pageId)); ?><br>
				<?php $this->load->view('layouts/' . CNF_THEME . '/page/image', array('pageId' => $pageId)); ?><br>
				<?php $this->load->view('layouts/' . CNF_THEME . '/page/text', array('pageId' => $pageId)); ?><br>
				<?php $this->load->view('layouts/' . CNF_THEME . '/page/pdf', array('pageId' => $pageId)); ?>
			<?php } ?>
        </div>
    </body> 
</html>