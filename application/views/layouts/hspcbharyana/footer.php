<?php $menus = SiteHelpers::menus('footer'); ?>


<div class="container text-center width-100">
	<div class="visitor_details">
		<div class="visitorcounter">
			<p style="text-align:center;">You are visitor number: 
			<!-- hitwebcounter Code START -->
			<img src="http://hitwebcounter.com/counter/counter.php?page=6798187&style=0006&nbdigits=5&type=page&initCount=16000" title="url and counting visits" Alt="url and counting visits"   border="0" >
			</p>
			<p class="whoisonline"> </p>
		</div>
	</div>
</div>

<div class="cls"></div>
<div id="footer" >
	<div id="block-menu-block-5" class="block block-menu-block first last odd" role="navigation">
		<div class="menu-block-wrapper menu-block-5 menu-name-menu-footer-menu-level-1 parent-mlid-0 menu-level-1">
			<ul class="menu">
						<?php
							if (!empty($menus)) {
								$i = 1;
								foreach ($menus as $main) {
									?>
									<li <?php if (!empty($main['childs'])) { ?>class="has-dropdown"<?php }else{ echo 'class="menu__item is-leaf leaf menu-mlid-3667"'; } ?>>
									  <a  <?php if (!empty($main['childs'])) { ?>href="<?php echo!empty($main['module']) ? base_url().$main['module'] : '#'; ?><?php } else { ?>href="<?php echo base_url().$main['module']; } ?>" <?php if (!empty($main['childs'])) { ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" <?php }else{ echo 'class="menu__link"'; } ?>><?php echo $main['menu_name']; ?><?php if (!empty($main['childs'])) { ?><span class="caret"></span><?php } ?></a>
									</li> 
									  <?php  if($i == 4){ ?>
										  </ul>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="footer-links">
									<ul class="menu">
										<?php $i = 0;?>
									 <?php }
									  $i++;
								}
							}
							?>
							
			</ul>
		</div>
	</div>
	<div class="clear"></div>
	<div class="footerblock">
		<div class="container width-100">
			<div class="row">
				<div class="col-md-12 text-center">
					Last Modified: Tuesday 26 September 2017.
				</div>
			</div>
			<div class="clear"></div>
			<div class="row my_ftr">
				<div class="col-md-6 col-sm-12 top10 text-left">
					© 2017 Haryana State Pollution Control Board. All Rights Reserved.
				</div>
				<div class="col-md-6 col-sm-12 top10 text-right"> <span> © Content Owned, Updated and Maintained by Secretariat for IT Haryana.</span> </div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php if($this->router->fetch_class() != 'login'){ ?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>design/themes/<?php echo CNF_THEME; ?>/js/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url() ?>design/datepick/js/jquery.plugin.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>design/datepick/js/jquery.datepick.js"></script>	
<script type="text/javascript">

	$(document).ready(function (){
		$('#casedate').datepick({dateFormat: 'yyyy-mm-dd'});
	});
</script> 

<script>
/*
setTimeout(function () {
var startY = 0;
var startX = 0;
var b = document.body;
b.addEventListener('touchstart', function (event) {
    parent.window.scrollTo(0, 1);
    startY = event.targetTouches[0].pageY;
    startX = event.targetTouches[0].pageX;
});
b.addEventListener('touchmove', function (event) {
    event.preventDefault();
    var posy = event.targetTouches[0].pageY;
    var h = parent.document.getElementById("scroller");
    var sty = h.scrollTop;

    var posx = event.targetTouches[0].pageX;
    var stx = h.scrollLeft;
    h.scrollTop = sty - (posy - startY);
    h.scrollLeft = stx - (posx - startX);
    startY = posy;
    startX = posx;
});
}, 1000);
*/
    </script>
	
<script type="text/javascript">
	$(document).ready(function(){
		$('.customer-logos').slick({
			slidesToScroll: 5,
			autoplay: true,
			autoplaySpeed: 1000,
			arrows: false,
			dots: false,
			pauseOnHover: false,
			
	});
});
</script>

<script>
    $(document).ready(function() {
        $('.view-id-home_page_banner ul').fadeSlideShow(
		{
			NextElementText: '>', // default text for next button
			
			PrevElementText: '<',  
		}
		).css('width', '100%');
        $(".ticker1").modernTicker({
			effect : "scroll",
			scrollInterval : 20,
			transitionTime : 500,
			autoplay : true
		});
		$('#fssPrev, #fssNext').fadeOut();
		
        $('#block-views-home-page-banner-block').hover(function(){ 
            $('#fssPrev, #fssNext').fadeIn();
			}, function(){
            $('#fssPrev, #fssNext').fadeOut();
		});
        
        
		
	}); 
    
    
	
	
	
</script> 
<script type="text/javascript" >
    if(getCookie("mysheet") == "change" ) {
        setStylesheet("change") ;
		}else {
        setStylesheet("") ;
	}
</script>
<?php } ?>
</body>
</html>