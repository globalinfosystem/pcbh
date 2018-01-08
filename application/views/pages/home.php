<div class="banner text-center">
	<div class="banner_in">
		<div class="banner_left">
			<h3><a href="jkss.php" style="color: #ffffff;"> </a></h3>
			<ul>
				<li>
					<div class="banner_box">
						<p> </p>
						<p> </p>
						<span> </span> 
					</div>
				</li>
				<li>
					<div class="banner_box">
						<p> </p>
						<p> </p>
					<span> </span> </div>
				</li>
				<li>
					<div class="banner_box">
						<p> </p>
						<p> </p>
					<span> </span> </div>
				</li>
				<li>
					<div class="banner_box">
						<p> </p>
					<span> </span> </div>
				</li>
				<li>
					<div class="banner_box">
						<p> </p>
					<span> </span> </div>
				</li>
				<li>
					<div class="banner_box">
						<p> </p>
					<span> </span> </div>
				</li>
				<li>
					<div class="banner_box">
						<p> </p>
					<span> </span> </div>
				</li>
				<li>
					<div class="banner_box">
						<p> </p>
					<span> </span> </div>
				</li>
			</ul>
			<div class="latest_news_wrap home_news desktop_show">
				<h3>News And Notifications</h3>
				<marquee direction="up" onMouseOver="stop();" onMouseOut="start();">
								<?php $this->load->view('layouts/' . CNF_THEME . '/ticker'); ?>	

				
				</marquee>
			</div>
		</div>
		<div class="banner_right">
			<section class="jk-slider">
				<div id="carousel-example" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carousel-example" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example" data-slide-to="1"></li>
						<li data-target="#carousel-example" data-slide-to="2"></li>
						<li data-target="#carousel-example" data-slide-to="3"></li>
						<li data-target="#carousel-example" data-slide-to="4"></li>
						<li data-target="#carousel-example" data-slide-to="5"></li>
					</ol>
					<div class="carousel-inner">
						<div class="item active"> <a href="#"><img class="item_1" src="design/images/index1.jpg" /></a> </div>
						<div class="item"> <a href="#"><img class="item_1" src="design/images/index3.jpg" /></a> </div>
						<div class="item"> <a href="#"><img class="item_1" src="design/images/index4.jpg" /></a> </div>
						<div class="item"> <a href="#"><img class="item_1" src="design/images/index5.jpg" /></a> </div>
						<div class="item"> <a href="#"><img class="item_1" src="design/images/index6.jpg" /></a> </div>
						<div class="item"> <a href="#"><img class="item_1" src="design/images/index.jpg" /></a> </div>
					</div>
				</div>
			</section>
		</div>
		
		
		<div class="latest_news_wrap home_news mobile_showw" style="margin-top: 0px">
			<h3>News And Notifications</h3>
			<marquee direction="up" onMouseOver="stop();" onMouseOut="start();">
				<?php $this->load->view('layouts/' . CNF_THEME . '/ticker'); ?>	

				
					</marquee>
		</div>
		
		
		<div class="clear"></div>
	</div>
</div>
<div class="banner_under">

	<ul>
						<?php 
						
						$this->load->view('layouts/' . CNF_THEME . '/sideMenu', array('position' => 'leftSide')); ?>	
	</ul>
</div>
<div id="wrapper">
	<div id="container">
		<div class="row desktop_show">
			<div class="container" style="margin-top: 10px">
					<?php $this->load->view('layouts/' . CNF_THEME . '/sideMenu', array('position' => 'rightSide')); ?>	
			</div>
		</div>
		<div class="mobile_showw">
			<div class="container">
				<section class="customer-logos slider" style="margin-top: 10px">
					<?php $this->load->view('layouts/' . CNF_THEME . '/sideMenu', array('position' => 'rightSide')); ?>	
					<div class="slide"><a target="_blank" class="thumbnail" href="https://www.india.gov.in/"><img src="images/client1.jpg"></a></div>
					<div class="slide"><a class="thumbnail" href="notification.php"><img src="images/noti.jpg"></a></div>
					<div class="slide"><a target="_blank" class="thumbnail" href="http://digitalindia.gov.in/"><img src="images/client2.jpg"></a></div>
					<div class="slide"><a target="_blank" class="thumbnail" href="aadhar.php"><img src="images/Aadhar.jpg"></a></div>
				</section>
			</div>
		</div>
	</div>		
	<!--container ends here--> 
	
</div>
