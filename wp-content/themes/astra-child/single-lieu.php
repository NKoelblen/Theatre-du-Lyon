<?php

/**
 * The template for displaying single lieu.
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if (astra_page_layout() == 'left-sidebar') : ?>

    <?php get_sidebar(); ?>

<?php endif ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php astra_primary_content_top(); ?>

    <?php astra_entry_before(); ?>

    <article <?php
                echo astra_attr(
                    'article-single',
                    array(
                        'id'    => 'post-' . get_the_id(),
                        'class' => join(' ', get_post_class()),
                    )
                );
                ?>>

        <?php astra_entry_top(); ?>

        <?php astra_entry_content_single(); ?>

        <?php $lieu_id = get_the_ID(); ?>
        <pre><a href="<?php echo get_post_meta($lieu_id, "website-url", true); ?>" target="_blank"><?php echo get_post_meta($lieu_id, "website-label", true); ?></a></pre>
        <pre><?php echo get_post_meta($lieu_id, "adress1", true);; ?></pre>
        <pre><?php echo get_post_meta($lieu_id, "adress2", true);; ?></pre>
        <pre><?php echo get_post_meta($lieu_id, "adress3", true); ?></pre>
        <pre><?php echo get_post_meta($lieu_id, "postal-code", true) . " " . get_post_meta($lieu_id, "city", true); ?></pre>
        <pre><?php echo get_post_meta($lieu_id, "informations", true); ?></pre>

        <?php astra_entry_bottom(); ?>

    </article><!-- #post-## -->

    <?php astra_entry_after(); ?>

    <?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if (astra_page_layout() == 'right-sidebar') : ?>

    <?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>