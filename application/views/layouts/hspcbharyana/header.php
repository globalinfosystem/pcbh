<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css' />
        <title>Haryana State Pollution Control Board</title>
        <link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/responisve_menu.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/fonts.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/style.css" rel="stylesheet" media="all" />
        <link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/animate.css" rel="stylesheet" />
        <link href='<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/meteor-slides5152.css?ver=1.0' type='text/css' rel='stylesheet' id='meteor-slides-css' media='all' />
        <link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/plugins/facebox/facebox.css" rel="stylesheet" type="text/css" />	  
        <link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/flexslider.css" rel="stylesheet" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script> 
        <script src="<?php echo base_url(); ?>design/themes/<?php echo CNF_THEME; ?>/js/bootstrap.min.js"></script> 
        <script src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/plugins/facebox/facebox.js"  type="text/javascript"></script>
       
        <script type='text/javascript'>

            jQuery(document).ready(function ()
            {
                jQuery("a.skip_to_main").click(function () {

                    jQuery('html, body').animate({scrollTop: jQuery('#skip_to_main').offset().top - 60}, 'slow');
                });
            });

            jQuery(document).ready(function () {
                jQuery('#menu-wrap').prepend('<div id="menu-trigger" class="responsivemenu">Menu</div>');
                jQuery('#menu-trigger').click(function () {
                    jQuery('#menu').slideToggle();
                });
            });

            $(document).ready(function () {
                var curSize;
                $('#incfont').click(function () {
                    curSize = parseInt($('#center').css('font-size')) + 2;
                    if (curSize <= 18)
                        $('#center').css('font-size', curSize);
                });
                $('#decfont').click(function () {
                    curSize = parseInt($('#center').css('font-size')) - 2;
                    if (curSize >= 10)
                        $('#center').css('font-size', curSize);
                });
                $('#equalfont').click(function () {
                    $('#center').css('font-size', 14);
                });
            });


   
            function base64_encode(data) {
                var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
                var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                        ac = 0,
                        enc = '',
                        tmp_arr = [];

                if (!data) {
                    return data;
                }

                do { // pack three octets into four hexets
                    o1 = data.charCodeAt(i++);
                    o2 = data.charCodeAt(i++);
                    o3 = data.charCodeAt(i++);

                    bits = o1 << 16 | o2 << 8 | o3;

                    h1 = bits >> 18 & 0x3f;
                    h2 = bits >> 12 & 0x3f;
                    h3 = bits >> 6 & 0x3f;
                    h4 = bits & 0x3f;

                    // use hexets to index into b64, and append result to encoded string
                    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
                } while (i < data.length);

                enc = tmp_arr.join('');

                var r = data.length % 3;

                return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
            }

            $(function () {
                $("#search-box").keyup(function ()
                {
                    var yourInput = $(this).val();
                    re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
                    var isSplChar = re.test(yourInput);
                    if (isSplChar)
                    {
                        var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                        $(this).val(no_spl_char);
                    }
                });
            });

            function sitesearch() {
                var searchval = $("#search-box").val();
                if (searchval.length > 2)
                {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() ?>page/searchpage",
                        data: {<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>', keyword: base64_encode(base64_encode(searchval)), },
                        beforeSend: function () {
                            $("#search-box").css("background", "#FFF url(<?php echo base_url(); ?>design/images/LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $("#result").html('');
                            var returnedData = JSON.parse(data);
                            var i = 1;
                            if ($.trim(returnedData.error)) {
                                $("#result").show();
                                $("#result").html(returnedData.error);
                                setTimeout(afterSearch, 5000);
                            } else {
                                if ($.trim(returnedData.success)) {
                                    $("#result").show();
                                    $.each(returnedData.success, function (index, element) {
                                        if (element.alias != '') {
                                            if (i == 1) {
                                                $('#result').append('<a class="gray" href="<?php echo base_url() ?>' + element.alias + '">' + element.title + '</a><br/>');
                                            }
                                            if (i == 2) {
                                                $('#result').append('<a class="black" href="<?php echo base_url() ?>' + element.alias + '">' + element.title + '</a><br/>');
                                                i = 0;
                                            }
                                        }

                                        i = i + 1;
                                    });
                                }
                            }
                            setTimeout(afterSearch, 10000);
                        }
                    });
                } else {
                    $("#result").show();
                    $("#result").html('Minimum 3 Character Allow');
                    setTimeout(afterSearch, 5000);

                }
            }

            function afterSearch() {
                $("#result").html('');
                $("#result").hide();
                $("#search-box").css("background", "#FFF");
            }
            function popups(id)
            {
                $.facebox({ajax: id});
            }

            function call_page_loader(values)
            {

                if (values == 1)
                {
                    $('#cover').css('display', 'block');
                }
                else if (values == 2)
                {
                    $('#cover').css('display', 'none');
                }

            }
			
			$(function() {
				$.post('<?php echo base_url();?>page/getwidthnhieght', { width: screen.width, height:screen.height }, function(json) {
					if(json.outcome == 'success') {
						// do something with the knowledge possibly?
					} else {
						alert('Unable to let PHP know what the screen resolution is!');
					}
				},'json');
			});
			
        </script>

        <style type="text/css">
            #cover {
                background: url("http://haryanasportsdemo.gissoft.net/administrator/images/loader.GIF") no-repeat scroll center center #000;
                height: 100%;
                opacity: 0.7;
                position: absolute;
                width: 100%;
                z-index: 9999;
                display:none;
            }
            #result
            {
                position:absolute;
                width:90%;
                text-align:left;
                margin-left:12px;
                padding:1px;
                display:none;
                margin-top:-1px;
                border-top:0px;
                overflow-y:scroll;
                border:1px #CCC solid;
                background-color: white;
                z-index:99999999999;
                max-height:120px;
            }
        </style>
		
		<link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/carousel.css" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<style media="screen">
			body {
			font-size: 100% !important;
			}
			body.textsize-75 {
			font-size: 75% !important;
			}
			body.textsize-80 {
			font-size: 80% !important;
			}
			body.textsize-85 {
			font-size: 85% !important;
			}
			body.textsize-90 {
			font-size: 90% !important;
			}
			body.textsize-95 {
			font-size: 95% !important;
			}
			body.textsize-100 {
			font-size: 100% !important;
			}
			body.textsize-105 {
			font-size: 105% !important;
			}
			body.textsize-110 {
			font-size: 110% !important;
			}
			body.textsize-115 {
			font-size: 115% !important;
			}
			body.textsize-120 {
			font-size: 120% !important;
			}
			body.textsize-125 {
			font-size: 125% !important;
			}
			body.textsize-130 {
			font-size: 130% !important;
			}
		</style>
		<style>
			@import url("<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/menu.css");
			@import url("<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/default_menu.css");
		</style>
		<style>
			@import url("<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/css/style.css");
		</style>	
    </head>

<body class="html front not-logged-in one-sidebar sidebar-first page-node page-node- page-node-275 node-type-page i18n-en" >
<?php
if(!isset($_SESSION)) {
	session_start();
}
?>
		<p id="skip-link"> <a href="#main-menu" class="element-invisible element-focusable">Jump to navigation</a> </p>
		<div class="acc-links" >
			<div class="top-skip">
				<div id="toplinks_home">
					<div class="region region-access">
						<div id="block-block-25" class="block block-block first odd">
					
							<ul class="access_links">
								<li class="skip-link"><a href="#"><img src="<?php echo base_url() ?>design/images/facebook.png" alt="Facebook"></a></li>
								<li class="skip-link"><a href="#"><img src="<?php echo base_url() ?>design/images/twitter.png" alt="Twitter"></a></li>
								<li class="skip-link"><a href="#"><img src="<?php echo base_url() ?>design/images/linkedin.png" alt="Linkedin"></a></li>
                    <li class="skip-link"><a href="javascript:;" class="skip_to_main"> Skip to main content</a></li>
					<li class="screen"><a href="#" title="Screen Reader Access" >Screen Reader Access</a></li>
                   <li class="high noborder"> <a href="javascript:void(0);" class="dark" title="Decrease font size" id="decfont" tabindex="6">A<sup>-</sup></a> </li>
                   <li class="high noborder"> <a href="javascript:void(0);" class="fontS noback noPadding-left" title="Reset font size" id="equalfont" tabindex="7">A<sup> </sup></a> </li>
                   <li class="high noborder"> <a href="javascript:void(0);" class="light" title="Increase font size" id="incfont" tabindex="8">A<sup>+</sup></a> </li>
                 
							</ul>
							
						</div>
						<ul class="textsize_list textsize_current_list">
							<li class="ts_increase_variable"><a href="#" title="Text Size: Increase +5%" class="ts_increase_variable text_display_hidden ts_rollover">A<sup>+</sup></a></li>
							<li class="ts_decrease_variable"><a href="#" title="Text Size: Decrease -5%" class="ts_decrease_variable text_display_hidden ts_rollover">A<sup>-</sup></a></li>
							<li class="ts_normal_variable"><a href="#" title="Text Size: Normal =100%" class="ts_normal_variable text_display_hidden ts_rollover">A<sup> </sup></a></li>
						</ul>
						<div class="ts_clear"></div>
					</div>
				</div>
				
				<!-- toplinks ends here -->
				<div class="clear"> </div>
			</div>
		</div>
		<div id="header-wrapper">
			<div class="header_overlay">
				<div class="logo"><a href="index.php"><img class="img-responsive" src="design/themes/mango/img/logo.png" style="width:85px" alt=""/></a></div>
				<div class="pull-right"><a href="rti.php" title="RTI">Check Status Online</a> | <a href="rti.php" title="RTI">Execution Of Appeal</a> | <a href="rti.php" title="RTI">RTI</a> | <a href="contact.php" title="Contact Us">Contact Us</a></div>
			</div>
		</div>
		<div id='header_menu'>
			<div class="region region-navigation">
				<div id="block-nice-menus-1" class="block block-nice-menus first last odd">
				            <?php $this->load->view('layouts/' . CNF_THEME . '/topbar'); ?>

					
				</div>
			</div>
		</div>
		
		