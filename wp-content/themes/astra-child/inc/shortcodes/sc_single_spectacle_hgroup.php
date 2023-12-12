<?php

/* Used in each spectacle to display title & subtitle in header slide */

add_shortcode('spectacle-hgroup', 'spectacle_hgroup_shortcode');
function spectacle_hgroup_shortcode(): string|bool
{
    ob_start();

    global $post;

    $post_id = $post->ID;

    if ($post->post_type === 'spectacle') : ?>

        <hgroup class="spectacle-hgroup alignfull">

            <h1><?php echo get_the_title(); ?></h1>
            <p><?php echo get_post_meta($post_id, 'subtitle', true); ?></p>

        </hgroup>

<?php endif;

    return ob_get_clean();
}
