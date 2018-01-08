
/************* */


(function($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.my_custom_behavior = {
        attach: function(context, settings) {

            // Place your code here.
            jQuery(document).ready(function() {
                //$('.mt-play').attr("id",'kkk');
                jQuery('.mt-play.mt-pause').attr('title', 'Pause');

                jQuery('.mt-play').click(function() {
                    if ($('.mt-pause').length) {
                        jQuery('.mt-play').attr('title', 'Pause');
                    } else {
                        jQuery('.mt-play').attr('title', 'Play');
                    }

                });


                jQuery('#slider1').bxSlider({
                    mode: 'vertical',
                    auto: true,
                    startImage: Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme + '/images/play.png', // string - filepath of image used for 'start' control. ex: 'images/start.jpg'
                    stopText: 'stop', // string - text displayed for 'stop' control
                    stopImage: Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme + '/images/pause.png',
                    autoControls: true
                });
                jQuery('#slider2').bxSlider({
                    mode: 'horizontal',
                    nextText: 'NEXT', // string - text displayed for 'next' control
                    nextImage: Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme + '/images/arrow-next-green.png', // string - filepath of image used for 'next' control. ex: 'images/next.jpg'
                    nextSelector: null, // jQuery selector - element to contain the next control. ex: '#next'
                    prevText: 'PREV', // string - text displayed for 'previous' control
                    prevImage: Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme + '/images/arrow-prev-green.png',
                    auto: true,
                    startImage: Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme + '/images/play.png', // string - filepath of image used for 'start' control. ex: 'images/start.jpg'
                    stopText: 'stop', // string - text displayed for 'stop' control
                    stopImage: Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme + '/images/pause.png',
                    autoControls: true
                });


                jQuery(".region.region-language li.hi .language-link").attr('title', "DEITY:Hindi Website Opens in same Tab");
                jQuery(".region.region-language li.en .language-link").attr('title', "DEITY:English Website Opens in same Tab");
                jQuery(".region.region-language li.hi .language-link").click(function() {
                    if (!confirm('This will Lead you to Deity Hindi Website.'))
                        return false;
                });
                jQuery(".region.region-language li.en .language-link").click(function() {
                    if (!confirm('This will Lead you to Deity English Website.'))
                        return false;
                });


                $('#block-nice-menus-6 .nice-menu li').each(function(x) {
                    $(this).addClass("img-block-" + (x + 1))
                });
                
                // footer menu block block-menu-menu-footer-menu-level-1
                $('#block-menu-menu-footer-menu-level-1 ul.menu').each(function(x) {
                    $(this).addClass("footer-menu-" + (x + 1))
                });
                wow = new WOW(
                        {
                            boxClass: 'wow', // default
                            animateClass: 'animated', // default
                            offset: 0 // default
                        }
                )
                wow.init();


                
                $(window).resize(function(){
                  jQuery('.show_hide:visible').next().hide();
                jQuery('.show_hide:hidden').next().show();
                });

                jQuery('.show_hide:visible').next().hide();
                jQuery('.show_hide:hidden').next().show();
                jQuery('.show_hide').click(function(){
                jQuery(this).next().slideToggle().prev().toggleClass('shown');
                return false; 
                }); 

                
                
                $('.view-id-related_content_.view-display-id-block .item-list').cycle({
                    fx: 'slide',
                    speed: '1000',
                    timeout: 7000,
                    next: '#next2',
                    prev: '#prev2',
                    pause: 1
                });

                $('td').addClass('wrapword');
                $('th').addClass('wrapword');




                // resizer
                //$('#block-views-home-page-banner-block .view-content ul , #block-views-home-page-banner-block .view-content li,#block-views-home-page-banner-block .view-content .item-list > ul:first, .banner1').height($('#block-views-home-page-banner-block img').height()); console.log($('#block-views-home-page-banner-block img').height()); 
                $(window).bind('resize load', function() {
                    $('#block-views-home-page-banner-block, #block-views-home-page-banner-block .view-content li.views-row,#block-views-home-page-banner-block .view-content > ul, .banner1').height($('#block-views-home-page-banner-block img').height());
                    // console.log($('#block-views-home-page-banner-block img').height());
                    
                    /* set equal width to main menu when resizing */
                   // $('.nice-menu-main-menu').css('width', '100%'); 
                   // $(".nice-menu-main-menu > li:not(.nice-menu-main-menu > li:first)").css({width: ($('.nice-menu-main-menu').width()/6)-30})
                });
                /* set equal width to main menu without resizing */
               // $('.nice-menu-main-menu').css('width', '100%'); 
                //$(".nice-menu-main-menu > li:not(.nice-menu-main-menu > li:first)").css({width: ($('.nice-menu-main-menu').width()/6)-30})
				
				/* set static on page no need this script now. 
				$total = 0 ; 
				
$('#block-nice-menus-1 ul.nice-menu > li >a:not("a:first")').each(function(x){
console.log($(this).text() + $(this).text().length);
 $total+= $(this).text().length;  
 });
 
 $('#block-nice-menus-1 ul.nice-menu > li >a:not("a:first")').each(function(x){

 $(this).parent().css({'width' : (($(this).text().length/$total) * 100) - 2.5 + '%'   , 'text-align' : 'center' });   
 
 });
 
 */
 
 
                /* END : set equal width to main menu without resizing */
 
                jQuery('#search-block-form').submit(function() {
                    //console.log(jQuery('input#edit-search-block-form--2.form-text'));
                    if (jQuery(this).find('.form-text').val() == "") {
                        alert('Please enter your keywords.');
                        return false;
                    }
                });
                jQuery('#search-block-form .form-submit').click(function() {

                    if (jQuery("#search-block-form").find('.form-text').val() == "Enter Your keywords") {
                        alert('Please enter your keywords.');
                        return false;
                    }
                });
            }); /* Document . ready() close */


        }
    };


})(jQuery, Drupal, this, this.document);

