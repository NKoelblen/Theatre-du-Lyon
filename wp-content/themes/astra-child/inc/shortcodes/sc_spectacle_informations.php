<?php

add_shortcode('spectacle-informations', 'spectacle_informations_shortcode');
function spectacle_informations_shortcode()
{
    ob_start();

    global $post;

    $post_id = $post->ID;

    if ($post->post_type === 'spectacle') : ?>

        <p style="text-align: center;"><span class="gold">Durée </span><?php echo get_post_meta($post_id, 'duree', true); ?></p>
        <p style="text-align: center;"><span class="gold">Spectacle </span><?php echo get_post_meta($post_id, 'public', true); ?></p>
        <p style="text-align: center;"><span class="gold">A partir de </span><?php echo get_post_meta($post_id, 'age', true); ?></p>

<?php endif;

    return ob_get_clean();
}
