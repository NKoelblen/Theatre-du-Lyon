<?php

/* Used in 'Espace Pro' page to display links of files related to 'compagnie' and 'spectacles' */

add_shortcode('dossiers-pro', 'dossiers_pro_shortcode');
function dossiers_pro_shortcode(): string|bool
{
    ob_start();

    global $post;

    $post_id = $post->ID;

    /* Files attached to Espace Pro page */

    $attachments = get_children(
        [
            'post_type'         => 'attachment',
            'post_parent'       => $post_id,
            'post_mime_type'    => 'application/pdf',
            'order'             => 'ASC',
            'orderby'           => 'title'
        ]
    );
    if ($attachments) : ?>

        <section class="compagnie">

            <h2>La compagnie</h2>

            <?php foreach ($attachments as $attachment) : ?>

                <p><a href="<?= get_the_permalink($attachment); ?>" target="_blank"><?= get_the_title($attachment); ?></a></p>

            <?php endforeach; // Endforeach attachment 
            ?>

        </section> <!-- End of compagnie -->

    <?php endif; // Endif attachments 
    ?>

    <!-- Files attached to Spectacles -->

    <section class="alignfull">

        <h2>Les spectacles</h2>

        <?php $spectacle_posts = new WP_Query(
            [
                'post_type'         => 'spectacle',
                'post_status'       => 'publish',
                'order'             => 'ASC',
                'orderby'           => 'title',
                'posts_per_page'    => -1
            ]
        );

        if ($spectacle_posts->have_posts()) : ?>

            <div class="astc_posts-list alignfull">

                <?php while ($spectacle_posts->have_posts()) : ?>

                    <article class="astc_each-post">

                        <?php $spectacle_posts->the_post();
                        $spectacle_id = get_the_id(); ?>

                        <img class="astc_each-post-thumbnail" src="<?= get_the_post_thumbnail_url(); ?>" srcset="<?= get_the_post_thumbnail_url($spectacle_id, 'medium_large'); ?> 768w, <?= get_the_post_thumbnail_url($spectacle_id, 'medium'); ?> 300w, <?= get_the_post_thumbnail_url($spectacle_id, 'thumbnail'); ?> 150w" sizes=" (max-width: 182px) 150px, (max-width: 332px) 300px, 768px">

                        <h3>
                            <a href="<?= get_the_permalink(); ?>">
                                <?= get_the_title(); ?>
                            </a>
                        </h3>

                        <?php $spectacle_attachments = get_children(
                            [
                                'post_type'         => 'attachment',
                                'post_parent'       => $spectacle_id,
                                'post_mime_type'    => 'application/pdf',
                                'order'             => 'ASC',
                                'orderby'           => 'title'
                            ]
                        );

                        foreach ($spectacle_attachments as $spectacle_attachment) : ?>

                            <p><a href="<?= get_the_permalink($spectacle_attachment); ?>" target="_blank"><?= get_the_title($spectacle_attachment); ?></a></p>

                        <?php endforeach; // Endforeach spectacle_attachment 
                        ?>

                    </article> <!-- End of unique spectacle

                <?php endwhile; // Endwhile spectacle_posts 
                ?>

            </div> <!-- End of list of spectacles -->

                <?php endif; // Endif spectacle_posts
            wp_reset_postdata(); ?>

    </section> <!-- End of spectacles -->

<?php return ob_get_clean();
}
