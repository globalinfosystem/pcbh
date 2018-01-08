<?php $menus = SiteHelpers::menus('footer'); ?>
<?php $count = count($menus); ?>
<div class="footer-links">
    <ul>
        <?php $i = 1; ?>
        <?php foreach ($menus as $menu) : ?>
            <li> <a  
                <?php if ($menu['menu_type'] == 'external') : ?>
                        href="#" 
                    <?php else : ?>
                        href="<?php echo site_url($menu['module']); ?>" 
                    <?php endif; ?> >
                        <?php echo $menu['menu_name']; ?>				
                </a> 
            </li>
            <?php if ($i != $count) { ?>
                <li> | </li>
            <?php } ?>
            <?php $i++; ?>
        <?php endforeach; ?>

    </ul>
</div>
