<?php

/* Used in each spectacle to display links to elements with ids */

add_shortcode('spectacle-sommaire', 'spectacle_summary_shortcode');
function spectacle_summary_shortcode()
{
    ob_start(); ?>

    <div class="alignfull astc_spectacle-summary"></div> <!-- Used by /assets/js/single_spectacle_summary.js -->

<?php return ob_get_clean();
}
