<?php
add_shortcode('dossiers-pro', 'dossiers_pro_shortcode');
function dossiers_pro_shortcode()
{
    ob_start();

    global $post;

    $post_id = $post->ID; ?>

    <div class="dossiers-pro">

        <?php $attachments = get_children(
            [
                'post_type'         => 'attachment',
                'post_parent'       => $post_id,
                'post_mime_type'    => 'application/pdf',
                'order'             => 'ASC',
                'orderby'           => 'title'
            ]
        );
        if (!empty($attachments)) : ?>

            <section>

                <h2 style="text-align: center">La compagnie</h2>

                <?php foreach ($attachments as $attachment) : ?>
                    <p><a href="<?php echo get_the_permalink($attachment); ?>" target="_blank"><?php echo get_the_title($attachment); ?></a></p>
                <?php endforeach; ?>

            </section>
        <?php endif; ?>

        <section>

            <h2 style="text-align: center">Les spectacles</h2>

            <?php $spectacle_posts = new WP_Query(
                [
                    'post_type'     => 'spectacle',
                    'post_status'   => 'publish',
                    'order'         => 'ASC',
                    'orderby'       => 'title'
                ]
            );

            if ($spectacle_posts->have_posts()) : ?>

                <div class="spectacles-list alignfull">

                    <?php while ($spectacle_posts->have_posts()) : ?>

                        <div class="unique-spectacle">

                            <?php $spectacle_posts->the_post();
                            $spectacle_id = get_the_id(); ?>

                            <img src="<?php echo get_the_post_thumbnail_url(); ?>">
                            <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

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

                                <p><a href="<?php echo get_the_permalink($spectacle_attachment); ?>" target="_blank"><?php echo get_the_title($spectacle_attachment); ?></a></p>

                            <?php endforeach; ?>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php endif;
            wp_reset_postdata(); ?>

        </section>

    </div>

<?php return ob_get_clean();
}
