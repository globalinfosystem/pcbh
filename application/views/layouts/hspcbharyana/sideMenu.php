<link href="<?php echo base_url();?>design/themes/<?php echo CNF_THEME;?>/verticalmenu/menu-vertical.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>design/themes/<?php echo CNF_THEME;?>/verticalmenu/menu-vertical.js" type="text/javascript"></script>
<?php $menus = SiteHelpers::menus($position); ?>
<?php 
if($position=="leftSide")
{
?>
        <?php
			if (!empty($menus)) { $i=1;
				foreach ($menus as $main) {
					?>
						<?php if (!empty($main['childs'])) { ?>
								<?php
								foreach ($main['childs'] as $childs) {
									?>
									<li class="has-dropdown">
									 <?php if(!empty($main['url'])) { ?>
									 <a  <?php if($i%2==0){ echo 'class="green"'; }else{ echo 'class="blue"'; } ?>  href="<?php echo !empty($childs['url']) ? $childs['url'] : '#'; ?>" target="_blank"><?php if($i%2==0){ ?><img class="normal" src="<?php echo base_url(); ?>design/images/achievement.png" alt=""><img class="hover" src="<?php echo base_url(); ?>design/images/achievement_hov.png" alt=""><br/><?php }else{ ?><img class="normal" src="<?php echo base_url(); ?>design/images/e_it.png" alt=""><img class="hover" src="<?php echo base_url(); ?>design/images/e_it_hov.png" alt=""><br/><?php } ?><?php echo $childs['menu_name']; ?></a></li>
									 <?php } else { ?>
									 <a  <?php if($i%2==0){ echo 'class="green"'; }else{ echo 'class="blue"'; } ?>  href="<?php echo !empty($childs['module']) ? base_url().$childs['module'] : '#'; ?>"><?php if($i%2==0){ ?><img class="normal" src="<?php echo base_url(); ?>design/images/achievement.png" alt=""><img class="hover" src="<?php echo base_url(); ?>design/images/achievement_hov.png" alt=""><br/><?php }else{ ?><img class="normal" src="<?php echo base_url(); ?>design/images/e_it.png" alt=""><img class="hover" src="<?php echo base_url(); ?>design/images/e_it_hov.png" alt=""><br/><?php } ?><?php echo $childs['menu_name']; ?></a></li>
									 <?php } ?>
									
									<?php
								}
								?>
						<?php } ?>
					  <?php
				$i++; }
			}
        ?>
    </ul>
<?php
}
elseif($position=="rightSide")
{
			if (!empty($menus)) { $j=1;
				foreach ($menus as $main) {
					?>
				
					 <div <?php if (!empty($main['childs'])) { ?>class="has-dropdown col-md-3"<?php }else{ ?>class="col-md-3"<?php } ?>>
					  <?php if(!empty($main['url'])) { ?>
					    <a target="_blank" class="thumbnail rightblock <?php if($j%2==0){ echo 'yellow'; }else{ echo 'dark'; } ?>" <?php if (!empty($main['childs'])) { ?>
							href=<?php echo!empty($main['url']) ? $main['url'] : '#'; ?>
						<?php } else { ?>
							href=<?php echo $main['url']; } ?>>
						<?php if($j%2==0){ ?><?php echo $main['menu_name']; ?><br/><?php }else{ ?><?php echo $main['menu_name']; ?><br/><?php } ?>
					  </a>
					  <?php } else { ?>
					  <a target="_blank" class="thumbnail rightblock <?php if($j%2==0){ echo 'yellow'; }else{ echo 'dark'; } ?>" <?php if (!empty($main['childs'])) { ?>
							href=<?php echo!empty($main['module']) ? base_url().$main['module'] : '#'; ?>
						<?php } else { ?>
							href=<?php echo base_url().$main['module']; } ?>>
						<?php if($j%2==0){ ?><?php echo $main['menu_name']; ?><br/><?php }else{ ?><?php echo $main['menu_name']; ?><br/><?php } ?>
					  </a>
					  <?php } ?>
						<?php if (!empty($main['childs'])) { ?>
								<?php
								foreach ($main['childs'] as $childs) {
									?>
									<div class="slide">
									 <?php if(!empty($main['url'])) { ?>
									 <a target="_blank" class="thumbnail rightblock <?php if($j%2==0){ echo 'yellow'; }else{ echo 'dark'; } ?>" href="<?php echo !empty($childs['url']) ? $childs['url'] : '#'; ?>" target="_blank"><?php if($j%2==0){ ?><?php echo $childs['menu_name']; ?><br/><?php }else{ ?><?php echo $childs['menu_name']; ?><br/><?php } ?></a>
									 <?php } else { ?>
									 <a target="_blank" class="thumbnail rightblock <?php if($j%2==0){ echo 'yellow'; }else{ echo 'dark'; } ?>" href="<?php echo !empty($childs['module']) ? base_url().$childs['module'] : '#'; ?>"><?php if($j%2==0){ ?><?php echo $childs['menu_name']; ?><br/><?php }else{ ?><?php echo $childs['menu_name']; ?><br/><?php } ?></a>
									 <?php } ?>
									</div>
									<?php
								}
								?>
						<?php } ?>
					</div> 
					  <?php
				$j++; }
			}
        ?>
<?php
}
else
{
?>
	<ul id="menu-v">
        <?php
			if (!empty($menus)) {
				foreach ($menus as $main) {
					?>
				
					 <li <?php if (!empty($main['childs'])) { ?>class="has-dropdown"<?php } ?>>
					  <?php if(!empty($main['url'])) { ?>
					    <a target="_blank"  <?php if (!empty($main['childs'])) { ?>
							href=<?php echo!empty($main['url']) ? $main['url'] : '#'; ?>
						<?php } else { ?>
							href=<?php echo $main['url']; } ?>>
						<?php echo $main['menu_name']; ?>
					  </a>
					  <?php } else { ?>
					  <a  <?php if (!empty($main['childs'])) { ?>
							href=<?php echo!empty($main['module']) ? base_url().$main['module'] : '#'; ?>
						<?php } else { ?>
							href=<?php echo base_url().$main['module']; } ?>>
						<?php echo $main['menu_name']; ?>
					  </a>
					  <?php } ?>
						<?php if (!empty($main['childs'])) { ?>
							  <ul class="sub">
								<?php
								foreach ($main['childs'] as $childs) {
									?>
									<li>
									 <?php if(!empty($main['url'])) { ?>
									 <a href="<?php echo !empty($childs['url']) ? $childs['url'] : '#'; ?>" target="_blank"><?php echo $childs['menu_name']; ?></a></li>
									 <?php } else { ?>
									 <a href="<?php echo !empty($childs['module']) ? base_url().$childs['module'] : '#'; ?>"><?php echo $childs['menu_name']; ?></a></li>
									 <?php } ?>
									
									<?php
								}
								?>
							</ul>
						<?php } ?>
					</li> 
					  <?php
				}
			}
        ?>
    </ul>
<?php
}
?>
    
