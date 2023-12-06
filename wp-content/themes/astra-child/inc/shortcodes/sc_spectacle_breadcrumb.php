<?php

add_shortcode('breadcrumb', 'breadcrumb_shortcode');
function breadcrumb_shortcode()
{
    ob_start(); ?>
    <div class="alignfull spectacle-breadcrumb"></div>
<?php return ob_get_clean();
}
