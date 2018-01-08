<?php $widgets = SiteHelpers::widget($position, $dynamicPosition); ?>
<?php $i = 1; ?>
<?php foreach ($widgets as $widget) : ?>
    <?php if (!empty($widget->widget_text)) { ?>
        <?php
        $widgetDescription = str_replace('[theme_uri]', base_url() . 'design/themes/' . CNF_THEME . '/', $widget->widget_text);
        ;
        ?>
        <?php
        $widgetDescription = str_replace('[website_link]', base_url(), $widgetDescription);
        ;
        ?>

        <div class=""> <?php
            if (!empty($widgetDescription)) {
                echo $widgetDescription;
            }
            ?> </div>

    <?php } ?>
    <?php $i++; ?>
<?php endforeach; ?>
