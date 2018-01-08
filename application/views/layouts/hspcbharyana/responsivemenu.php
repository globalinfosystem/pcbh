<?php $menus = SiteHelpers::menusMulti('"headertop","top"'); ?>
<div id="pushobj"></div>
<div id="menu" class="responsiveMenuSidebar">
    <nav>
        <h2 class="h2left"><i class="fa  floatLeft fa-reorder"></i>&nbsp;&nbsp;&nbsp;</h2>
        <ul>
            <?php foreach ($menus as $menu) : ?>
                <li>
                    <?php if (count($menu['childs']) > 0): ?>
                        <a href="#"><i class="fa fa-angle-right"></i><?php echo $menu['menu_name']; ?></a>
                        <h2><i class="fa fa-angle-right"></i><?php echo $menu['menu_name']; ?></h2>
                    <?php else: ?>
                        <a href="#"><?php echo $menu['menu_name']; ?></a>
                    <?php endif; ?>
                    <?php if (count($menu['childs']) > 0): ?>
                        <ul>
                            <?php foreach ($menu['childs'] as $menu2): ?>
                                <li>
                                    <?php if (count($menu2['childs']) > 0): ?>
                                        <a href="#"><i class="fa fa-phone"></i><?php echo $menu2['menu_name']; ?></a>
                                        <h2><i class="fa fa-phone"></i><?php echo $menu2['menu_name']; ?></h2>
                                        <?php else: ?>
                                        <a href="#"><?php echo $menu2['menu_name']; ?></a>
                                    <?php endif; ?>
                                    <?php if (count($menu2['childs']) > 0): ?>
                                        <ul>
                                            <?php foreach ($menu2['childs'] as $menu3): ?>
                                                <li>
                                                    <a href="#"><?php echo $menu3['menu_name']; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</div>
