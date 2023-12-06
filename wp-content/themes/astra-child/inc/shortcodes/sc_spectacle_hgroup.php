<?php

add_shortcode('spectacle-hgroup', 'spectacle_hgroup_shortcode');
function spectacle_hgroup_shortcode()
{
    ob_start();

    global $post;

    $post_id = $post->ID;

    if ($post->post_type === 'spectacle') : ?>

        <hgroup class="spectacle-hgroup alignfull">
            <h1 style="text-align: center;"><?php echo get_the_title(); ?></h1>
            <p style="text-align: center;"><?php echo get_post_meta($post_id, 'subtitle', true); ?></p>
        </hgroup>

<?php endif;

    return ob_get_clean();
}
