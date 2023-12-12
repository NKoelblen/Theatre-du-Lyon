<?php

/* Used in home page and 'Actualités' page to display posts list */

add_shortcode('actualites', 'actualites_shortcode');
function actualites_shortcode(): string|bool
{
    ob_start(); ?>

    <div class="astc_posts-list alignfull">

        <?php if (is_home()) :

            $post_per_page = 3;

        else : // If not home

            $post_per_page = -1;

        endif; // Endif home

        $actualite_posts = new WP_Query(
            [
                'post_type'         => 'post',
                'post_status'       => 'publish',
                'order'             => 'DSC',
                'orderby'           => 'date',
                'posts_per_page'    => $post_per_page
            ]
        );

        if ($actualite_posts->have_posts()) :
            while ($actualite_posts->have_posts()) :
                $actualite_posts->the_post();

                $actualite_id = get_the_id(); ?>

                <article class="astc_each-post">

                    <a href="<?= get_the_permalink(); ?>" class="astc_each-post-thumbnail-link">
                        <img class="astc_each-post-thumbnail" src="<?= get_the_post_thumbnail_url(); ?>" srcset="<?= get_the_post_thumbnail_url($actualite_id, 'medium_large'); ?> 768w, <?= get_the_post_thumbnail_url($actualite_id, 'medium'); ?> 300w, <?= get_the_post_thumbnail_url($actualite_id, 'thumbnail'); ?> 150w" sizes=" (max-width: 182px) 150px, (max-width: 332px) 300px, 768px">
                    </a>

                    <h3>
                        <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a>
                    </h3>

                    <p><?= get_the_excerpt(); ?></p>

                    <a class="astc_each-post-read-more" href="<?= get_the_permalink(); ?>">&rarr; Lire la suite &larr;</a>

                </article>

        <?php endwhile; // Endwhile actualite_posts
        endif; // Endif actualite_posts
        wp_reset_postdata(); ?>

    </div> <!-- End of astc_posts-list -->

<?php return ob_get_clean();
}
