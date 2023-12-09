<?php
add_shortcode('collaborateurs', 'collaborateurs_shortcode');
function collaborateurs_shortcode()
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

        <div class="collaborateurs-list alignfull">

            <?php while ($collaborateur_posts->have_posts()) : ?>

                <div class="unique-collaborateur">

                    <?php $collaborateur_posts->the_post();
                    $collaborateur_id = get_the_id(); ?>

                    <img src="<?php echo get_the_post_thumbnail_url(); ?>">
                    <h3 style="text-align: center"><?php echo get_the_title(); ?></h3>
                    <p style="text-align: center"><strong><?php echo get_post_meta($collaborateur_id, 'fonction')[0]; ?></strong></p>
                    <div style="text-align: center"><?php echo wpautop(get_post_meta($collaborateur_id, "biographie", true)); ?></div>
                    <?php if (!empty(get_post_meta($collaborateur_id, "website-url", true))) : ?>
                        <p>Site internet :
                            <a href="<?php echo get_post_meta($collaborateur_id, "website-url", true); ?>" target="_blank">
                                <?php if (get_post_meta($collaborateur_id, "website-label", true) != "") :
                                    echo get_post_meta($collaborateur_id, "website-label", true);
                                else :
                                    echo get_post_meta($collaborateur_id, "website-url", true);
                                endif; ?>
                            </a>
                        </p>
                    <?php endif; ?>

                </div>

            <?php endwhile; ?>

        </div>

<?php endif;
    wp_reset_postdata();

    return ob_get_clean();
}
