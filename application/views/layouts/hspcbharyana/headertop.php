<?php $menus = SiteHelpers::menus('headertop'); ?>
<style>
.active {
    background: rgba(0, 0, 0, 0) linear-gradient(peru, forestgreen, black) repeat scroll 0 0;
    color: #fff;
    font-weight: bold;
}
</style>
<div class="navbar-header">
    <a class="btn btn-warning navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" onclick="showhide();"> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
    </a> 
    <a class="navbar-brand" href="<?php echo base_url(); ?>"></a> </div>
<div class="navbar-collapse collapse" id="showhide">
    <ul class="nav navbar-nav navbar-right top-menu">
        <?php foreach ($menus as $menu) : ?>
            <li> 
                <a 
                <?php if ($menu['menu_type'] == 'external') : ?>
                        href="#" 
                    <?php else : ?>
                        href="<?php echo site_url($menu['module']); ?>" 
                    <?php endif; ?> 
                    <?php echo (!empty($page) && trim($page) == trim($menu['module'])) ? 'class="active"  ' : ''; ?>>
                        <?php echo $menu['menu_name']; ?>				
                </a> 
            </li>

        <?php endforeach; ?>
    </ul>
</div>
<script>
function showhide(){
	$('#showhide').toggle();
}
</script>
