<?php $menus = SiteHelpers::menus('top'); 
//print_r($menus);
//die;
?>
	 <div class="row">
	 <div class="col-xs-12 col-sm-12 col-md-12"> 
		 <nav id="menu-wrap">
		 <ul class="nice-menu nice-menu-down nice-menu-main-menu" id="nice-menu-1">
			 <?php
							if (!empty($menus)) { $i=1;
								foreach ($menus as $main) {
									?>
									 <li <?php if (!empty($main['childs'])) { 
									 	if($i==1)
										{
										echo 'class="menu__item menu-3563 menuparent menu-path-node-277 even menu_pink"';
										}
										if($i==2)
										{
										echo 'class="menu__item menu-3563 menuparent menu-path-node-277 odd menu_black"';
										}
										
									  }

									  ?>>
									  <?php
					                 $session_user_data= $this->session->userdata("user_data");
									 $logged_in=(isset($this->session->userdata["logged_in"])?$this->session->userdata["logged_in"]:'');
									  if(isset($session_user_data["group_id"]) && $session_user_data["group_id"]==3 && $logged_in==1 && $main["menu_id"]==297)
									  {?>
									    <a href="<?php echo base_url();?>usercase">
									    Apply Case
                                        </a>									 
									  <?php
									  }else
									  {
									  ?>
									  <a  <?php if (!empty($main['childs'])) { ?>href="<?php echo!empty($main['module']) ? base_url().$main['module'] : '#'; ?><?php } else 
									  { 
									  ?>href="<?php echo base_url().$main['module']; } ?>">
									  <?php echo $main['menu_name']; ?>
									    </a>
									   </li> 
									  <?php
									  }
								$i++; }
							}
							?>
							
					<li class='menu__item menu-3563 menuparent menu-path-node-277 odd menu_yellow'>
								
								<?php 
								
								if (isset($session_user_data["group_id"]) && $session_user_data["group_id"]==3) 
								{
									
							    ?>
								<a  href="<?php echo base_url(); ?>user/profile" title="Account Detail">
									Account	
								</a>
								<?php }  else { ?>
										<a  href="<?php echo base_url(); ?>user/login" title="Login Detail">
											Login		
										</a>
								<?php } ?>
								<?php //if (!empty($_SESSION['user'])) { ?>
										 <!--/ <a  href="<?php //echo base_url(); ?>login/logout" title="Logout Detail">
											Logout
										</a> -->
								<?php //} ?>
							</li>
									
		  </ul>
		</nav>
		</div>
	</div>
    <!--<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav" id="topMenu">
            <?php
                        if (!empty($menus)) {
                            foreach ($menus as $main) {
                                ?>
                                 <li <?php if (!empty($main['childs'])) { ?>class="has-dropdown"<?php } ?>>
                                  <a  <?php if (!empty($main['childs'])) { ?>href="<?php echo!empty($main['module']) ? base_url().$main['module'] : '#'; ?><?php } else { ?>href="<?php echo base_url().$main['module']; } ?>" <?php if (!empty($main['childs'])) { ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" <?php } ?>><?php echo $main['menu_name']; ?><?php if (!empty($main['childs'])) { ?><span class="caret"></span><?php } ?></a>
                                    <?php
                                    if (!empty($main['childs'])) {
                                        ?>
                                          <ul class="dropdown-menu">
                                            <?PHP
                                            foreach ($main['childs'] as $childs) {
                                                ?>
                                                <li><a href="<?php echo!empty($childs['module']) ? base_url().$childs['module'] : '#'; ?>"><?php echo $childs['menu_name']; ?></a></li>
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
        
        </div>
      </div>
    </nav>-->

