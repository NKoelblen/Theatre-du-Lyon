<?php

add_shortcode('calendrier', 'calendrier_shortcode');
function calendrier_shortcode()
{
    ob_start();

    global $post;

    $post_id = $post->ID;

    if ($post->post_type === 'spectacle') :

        $calendrier_posts = new WP_Query(
            [
                'post_type'     => 'calendrier',
                'post_status'   => 'publish',
                'meta_key'      => 'spectacle',
                'meta_value'    => $post_id
            ]
        );

        if ($calendrier_posts->have_posts()) :
            while ($calendrier_posts->have_posts()) :
                $calendrier_posts->the_post();

                $calendrier_id = get_the_ID();

                $c_lieu_id = get_post_meta($calendrier_id, "lieu", true);

                $lieu_posts = new WP_Query(
                    [
                        'p'         => $c_lieu_id,
                        'post_type' => 'any'

                    ]
                );

                if ($lieu_posts->have_posts()) :
                    while ($lieu_posts->have_posts()) :
                        $lieu_posts->the_post();
?>
                        <pre><?php echo get_the_title(); ?></pre>
                        <pre><a href="<?php echo get_post_meta($c_lieu_id, "website-url", true); ?>" target="_blank"><?php echo get_post_meta($c_lieu_id, "website-label", true); ?></a></pre>
                        <pre><?php echo get_post_meta($c_lieu_id, "adress1", true);; ?></pre>
                        <pre><?php echo get_post_meta($c_lieu_id, "adress2", true);; ?></pre>
                        <pre><?php echo get_post_meta($c_lieu_id, "adress3", true); ?></pre>
                        <pre><?php echo get_post_meta($c_lieu_id, "postal-code", true) . " " . get_post_meta($c_lieu_id, "city", true); ?></pre>
                        <pre><?php echo get_post_meta($c_lieu_id, "informations", true); ?></pre>
                    <?php

                    endwhile;
                endif;
                wp_reset_postdata();

                $c_times = get_post_meta($calendrier_id, "time", true);

                foreach ($c_times as $time) :

                    ?>
                    <pre><?php echo $time; ?></pre>
<?php

                endforeach;

            endwhile;
        endif;
        wp_reset_postdata();

    endif;

    return ob_get_clean();
}
