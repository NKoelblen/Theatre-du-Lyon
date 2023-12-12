<?php

/* Used in each spectacle to display 'duree', 'public' & 'age' */

add_shortcode('spectacle-informations', 'spectacle_informations_shortcode');
function spectacle_informations_shortcode()
{
    ob_start();

    global $post;

    $post_id = $post->ID;

    if ($post->post_type === 'spectacle') : ?>

        <p><span class="marked">Durée </span><?php echo get_post_meta($post_id, 'duree', true); ?></p>
        <p><span class="marked">Spectacle </span><?php echo get_post_meta($post_id, 'public', true); ?></p>
        <p><span class="marked">A partir de </span><?php echo get_post_meta($post_id, 'age', true); ?></p>

<?php endif;

    return ob_get_clean();
}
