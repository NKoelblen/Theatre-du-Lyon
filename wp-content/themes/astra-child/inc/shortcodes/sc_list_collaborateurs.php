<?php

/* Used in 'Le Théâtre du Lyon' page to display 'collaborateurs' list */

add_shortcode('collaborateurs', 'collaborateurs_shortcode');
function collaborateurs_shortcode(): string|bool
{
    ob_start();

    $collaborateur_posts = new WP_Query(
        [
            'post_type'         => 'collaborateur',
            'post_status'       => 'publish',
            'order'             => 'ASC',
            'orderby'           => 'menu_order',
            'posts_per_page'    => -1
        ]
    );

    if ($collaborateur_posts->have_posts()) : ?>

        <div class="astc_collaborateurs-list alignfull">

            <?php while ($collaborateur_posts->have_posts()) : ?>

                <article class="astc_each-collaborateur">

                    <?php $collaborateur_posts->the_post();
                    $collaborateur_id = get_the_id(); ?>

                    <img class="astc_each-collaborateur-thumbnail" src="<?= get_the_post_thumbnail_url(); ?>" srcset="<?= get_the_post_thumbnail_url($collaborateur_id, 'large'); ?> 1024w, <?= get_the_post_thumbnail_url($collaborateur_id, 'medium_large'); ?> 768w, <?= get_the_post_thumbnail_url($collaborateur_id, 'medium'); ?> 300w, <?= get_the_post_thumbnail_url($collaborateur_id, 'thumbnail'); ?> 150w" sizes=" (max-width: 182px) 150px, (max-width: 332px) 300px, (max-width: 768px) 768px, 1024px">

                    <h3><?= get_the_title(); ?></h3>

                    <p><strong><?= get_post_meta($collaborateur_id, 'fonction')[0]; ?></strong></p>

                    <div><?= wpautop(get_post_meta($collaborateur_id, "biographie", true)); ?></div>

                    <?php $website_url = get_post_meta($collaborateur_id, "website-url", true);
                    $website_label = get_post_meta($collaborateur_id, "website-label", true);

                    if ($website_url) : ?>

                        <p>Site internet :

                            <a href="<?= $website_url; ?>" target="_blank">

                                <?php if ($website_label) :
                                    echo $website_label;
                                else :
                                    echo $website_url;
                                endif; // Endif website_label 
                                ?>

                            </a>

                        </p>

                    <?php endif; // Endif website_url 
                    ?>

                </article> <!-- End of each collaborateur -->

            <?php endwhile; // Endwhile collaborateur_posts 
            ?>

        </div> <!-- End of collaborateurs list -->

<?php endif; // Endif collaborateur_posts
    wp_reset_postdata();

    return ob_get_clean();
}
