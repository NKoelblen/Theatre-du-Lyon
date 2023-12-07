<?php

add_shortcode('actualites', 'actualites_shortcode');
function actualites_shortcode()
{
    ob_start(); ?>

    <div class="actualites-list alignfull">

        <?php $actualite_posts = new WP_Query(
            [
                'post_type'         => 'post',
                'post_status'       => 'publish',
                'order'             => 'DSC',
                'orderby'           => 'date',
                'posts_per_page'    => 3
            ]
        );

        if ($actualite_posts->have_posts()) :
            while ($actualite_posts->have_posts()) :
                $actualite_posts->the_post();

                $id = get_the_id();
                $categories = get_the_category($id); ?>

                <div class="unique-actualite">

                    <a href="<?php echo get_the_permalink(); ?>" class="actualites-thumbnail-link">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="actualites-thumbnail">
                    </a>
                    <h3 style="text-align: center;"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

                    <p style="text-align: center;"><?php echo get_the_excerpt(); ?></p>

                    <a href="<?php echo get_the_permalink(); ?>">&rarr; Lire la suite</a>

                </div>

        <?php endwhile;
        endif;
        wp_reset_postdata(); ?>

    </div>

<?php return ob_get_clean();
}
