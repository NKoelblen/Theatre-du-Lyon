<?php

add_shortcode('breadcrumb', 'breadcrumb_shortcode');
function breadcrumb_shortcode()
{
    ob_start(); ?>


    <table class="spectacle-breadcrumb alignfull">
        <tbody>
            <tr>

            </tr>
        </tbody>
    </table>


<?php return ob_get_clean();
}
