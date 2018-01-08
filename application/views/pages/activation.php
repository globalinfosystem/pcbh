<style>
.activate-link {
    width: 100%;
    color: #FFFFFF;
    background-color: #009966;
    border: 1px solid #fff;
    margin-top: 60px;
    padding: 67px;
    font-size: 30px;
    min-height: 122px;
    text-align: center;
    margin-left: -20% !important;
}
</style>
<div class="col-sm-12 col-md-12 col-xs-12">
	<div class="row">
<?php
					$u=base_url()."user/login";
					$h=base_url();
					$r=base_url()."apply-online";
				if(isset($_GET['y']) && $_GET['y']=="ok")
				{
					?>
					<div class="activate-link">
					Congratulations! Your Account Has Been Activated<br /><br /><br /><br /><br /><br /><br /><br />
					<a href="<?php echo $u; ?>">click here to login</a>
					</div>
					<?php

				}
				if(isset($_GET['y']) && $_GET['y']=="cancel")
				{
						?>
					<div class="activate-link">
						This link is deactived<br /><br /><br /><br /><br /><br /><br /><br />
						<a href="<?php echo $h; ?>">click here to login</a>
						</div><?php

				}				
				if(isset($_GET['y']) && $_GET['y']=="error")
			  	{
						?>
					<div class="activate-link">
						Valid Information Not Found<br /><br /><br /><br /><br /><br /><br /><br />
						<a href="<?php echo $r; ?>">click here to login</a>
						</div><?php
				}
				?>
	</div>
</div>				
				