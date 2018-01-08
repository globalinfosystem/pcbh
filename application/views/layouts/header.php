<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css' />
        <title>AG Haryana</title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/themes/agtheme/css/jquery.fancybox.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/themes/agtheme/css/jquery.fancybox-buttons.css">
        <link href="<?php echo base_url() ?>design/themes/agtheme/css/responisve_menu.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>design/themes/agtheme/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>design/themes/agtheme/css/navbar-static-top.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>design/themes/agtheme/css/fonts.css" rel="stylesheet">
        <!-----Slider------>
        <link href="<?php echo base_url() ?>design/themes/agtheme/css/style.css" rel="stylesheet" media="all" />
        <link href="<?php echo base_url() ?>design/themes/agtheme/css/animate.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>design/themes/agtheme/css/flexslider.css" rel="stylesheet" />

        <link rel='stylesheet' id='meteor-slides-css'  href='<?php echo base_url() ?>design/themes/agtheme/css/meteor-slides5152.css?ver=1.0' type='text/css' media='all' />
        <script src="<?php echo base_url(); ?>design/themes/agtheme/js/jquery.min.js"></script> 
        <script type='text/javascript' src='<?php echo base_url() ?>design/themes/agtheme/js/jquery.flexslider.js'></script>
        <script src="<?php echo base_url(); ?>design/themes/agtheme/js/jquery.fancybox-buttons.js"></script>

        <script type='text/javascript' src='<?php echo base_url() ?>design/themes/agtheme/js/jquery4a80.js?ver=1.11.2'></script>
        <script type='text/javascript' src='<?php echo base_url() ?>design/themes/agtheme/js/jquery.cycle.all50fa.js?ver=4.2.1'></script>
        <script type='text/javascript' src='<?php echo base_url() ?>design/themes/agtheme/js/jquery.metadata.v250fa.js?ver=4.2.1'></script>
        <script type='text/javascript' src='<?php echo base_url() ?>design/themes/agtheme/js/jquery.minimuslider-1.2.min.js'></script>

        <script type='text/javascript'>
            /* <![CDATA[ */
            var meteorslidessettings = {"meteorslideshowspeed": "3000", "meteorslideshowduration": "500", "meteorslideshowheight": "642", "meteorslideshowwidth": "1349", "meteorslideshowtransition": "fade"};
            /* ]]> */
        </script>
        <script type='text/javascript' src='<?php echo base_url() ?>design/themes/agtheme/js/slideshow50fa.js?ver=4.2.1'></script>
        <!-----End Slider---->	


        <script>
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
                    curSize = parseInt($('.container').css('font-size')) + 2;
                    if (curSize <= 21)
                        $('.container').css('font-size', curSize);
                });
                $('#decfont').click(function () {
                    curSize = parseInt($('.container').css('font-size')) - 2;
                    if (curSize >= 11)
                        $('.container').css('font-size', curSize);
                });
                $('#equalfont').click(function () {
                    $('.container').css('font-size', 17);
                });
            });

        </script>
        <script type='text/javascript' src='<?php echo base_url() ?>design/themes/agtheme/js/jquery.js'></script> 


        <script type='text/javascript' src='<?php echo base_url() ?>design/themes/agtheme/js/salacious.script.js'></script> 

    </head>

    <body>
        <div class="headerTop">
            <div class="blue-prt">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6"> &nbsp;
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 text-right"> 

                            <div>                             

                                <a href="#" style="margin-right:12px;"> Skip to main content</a>

                                <a href="javascript:void(0);" class="fontS noback" title="Decrease font size" id="decfont" tabindex="6"><img src="<?php echo base_url(); ?>design/themes/agtheme/images/small-font.png" alt="" /></a> 
                                <a href="javascript:void(0);" class="fontS noback noPadding-left" title="Reset font size" id="equalfont" tabindex="7"><img src="<?php echo base_url(); ?>design/themes/agtheme/images/normal-font.png" alt="" /></a> 
                                <a href="javascript:void(0);" class="fontS noback noPadding-left" title="Increase font size" id="incfont" tabindex="8"><img src="<?php echo base_url(); ?>design/themes/agtheme/images/big-font.png" alt="" /></a>  <input type="search" name="search" placeholder="search" style="width:150px; margin-left:10px;" /> 


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="top-header-a">

                <div class="container">

                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3"><style>

                                .run-animation {
                                    position: relative;
                                    -webkit-animation: fancy-animation 2s ease;
                                }
                                .hry-logo{
                                    position: relative;
                                    -webkit-animation: new-animation 2s ease;
                                }

                                @-webkit-keyframes fancy-animation {

                                    from {
                                        left: -500px;
                                    }
                                    to {
                                        left: 0;
                                    }

                                }
                                @-webkit-keyframes new-animation {

                                    from {
                                        right: -500px;
                                    }
                                    to {
                                        right: 0;
                                    }

                                }

                                #result
                                {
                                    background: #1c80bb none repeat scroll 0 0;;
                                    border: 1px solid #ccc;
                                    display: none;
                                    margin-left: 420px;
                                    margin-top: -1px;
                                    max-height: 120px;
                                    overflow: scroll;
                                    padding: 1px;
                                    position: absolute;
                                    width: 20%;
                                    z-index: 2147483647;

                                }

                            </style>
                            <div id="page-wrap">

                                <div id="logo" class="run-animation">
                                    <img src="<?php echo base_url(); ?>design/themes/agtheme/images/logo-icon.png" alt="Logo" />
                                </div>

                            </div> </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 text-center logo-name"> 
                            <img src="<?php echo base_url(); ?>design/themes/agtheme/images/logo-name.png" alt="Logo name" />

                        </div>

                        <div class="col-xs-12 col-sm-2 col-md-2 text-right hry-logo"> 
                            <img src="<?php echo base_url(); ?>design/themes/agtheme/images/haryana-logo.png" alt="Haryana Logo" />

                        </div>
                    </div>
                </div> 
            </div>
        </div>

        <?php $this->load->view('layouts/' . CNF_THEME . '/topbar'); ?>