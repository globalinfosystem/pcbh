<?php $posttypeArray = explode(',', $posttype); ?>
<?php foreach ($posttypeArray as $keyMain => $valueMain) { ?>
    <?php $posttype = SiteHelpers::getHomeData($valueMain, 100); ?>
    <?php if ($posttype) { ?>
        <div class="row cont-part top-space">
            <div class="title-head"><?php echo ucfirst(str_replace('_', ' ', $valueMain)); ?></div>
            <?php $iposttype = 1; ?>
            <?php foreach ($posttype as $key => $value) { ?>
                <?php
                if ($iposttype == 1) {
                    $classiposttype = 'green-bar';
                }
                if ($iposttype == 2) {
                    $classiposttype = 'red-bar';
                }
                if ($iposttype == 3) {
                    $classiposttype = 'lightgreen-bar';
                    $iposttype = 1;
                }
                ?>
                <a href="<?php echo base_url(); ?><?php echo $value['alias']; ?>">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="title-bar <?php echo $classiposttype; ?>"><?php echo $value['title']; ?></div>
                        <?php if (!empty($value['feature_image'])) { ?>
                            <div> <img src="<?php echo base_url() . 'uploads/featureImage/' . $value['feature_image']; ?>" alt="Stadium" class="img-responsive" /></div>
                        <?php } ?>
                        <div class="txt-part"><?php echo (!empty($value['short_content'])) ? $value['short_content'] : ''; ?></div>
                    </div>
                </a>
                <?php $iposttype++; ?>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>