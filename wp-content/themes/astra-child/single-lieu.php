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

    <main id="main" class="site-main">
        <?php
        if (have_posts()) :
            do_action('astra_template_parts_content_top');

            while (have_posts()) :
                the_post();


                if (is_single()) { ?>
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

                        <div <?php astra_blog_layout_class('single-layout-1'); ?>>

                            <?php astra_single_header_before(); ?>

                            <?php if (apply_filters('astra_single_layout_one_banner_visibility', true)) { ?>

                                <header class="entry-header <?php astra_entry_header_class(); ?>">

                                    <?php astra_single_header_top(); ?>

                                    <?php astra_banner_elements_order(); ?>

                                    <?php astra_single_header_bottom(); ?>

                                </header><!-- .entry-header -->

                            <?php } ?>

                            <?php astra_single_header_after(); ?>

                            <div class="entry-content clear" <?php
                                                                echo astra_attr(
                                                                    'article-entry-content-single-layout',
                                                                    array(
                                                                        'class' => '',
                                                                    )
                                                                );
                                                                ?>>

                                <?php astra_entry_content_before(); ?>

                                <?php the_content(); ?>

                                <?php $lieu_id = get_the_ID(); ?>
                                <pre><?php echo get_post_meta($lieu_id, "adress1", true);; ?></pre>
                                <pre><?php echo get_post_meta($lieu_id, "adress2", true);; ?></pre>
                                <pre><?php echo get_post_meta($lieu_id, "adress3", true); ?></pre>
                                <pre><?php echo get_post_meta($lieu_id, "postal-code", true) . " " . get_post_meta($lieu_id, "city", true); ?></pre>
                                <pre>Informations complémentaires : <?php echo get_post_meta($lieu_id, "informations", true); ?></pre>
                                <pre>Site internet : <a href="<?php echo get_post_meta($lieu_id, "website-url", true); ?>" target="_blank"><?php echo get_post_meta($lieu_id, "website-label", true); ?></a></pre>

                                <?php
                                astra_edit_post_link(
                                    sprintf(
                                        /* translators: %s: Name of current post */
                                        esc_html__('Edit %s', 'astra'),
                                        the_title('<span class="screen-reader-text">"', '"</span>', false)
                                    ),
                                    '<span class="edit-link">',
                                    '</span>'
                                );
                                ?>

                                <?php astra_entry_content_after(); ?>

                                <?php
                                wp_link_pages(
                                    array(
                                        'before'      => '<div class="page-links">' . esc_html(astra_default_strings('string-single-page-links-before', false)),
                                        'after'       => '</div>',
                                        'link_before' => '<span class="page-link">',
                                        'link_after'  => '</span>',
                                    )
                                );
                                ?>
                            </div><!-- .entry-content .clear -->
                        </div>
                        <?php astra_entry_bottom(); ?>

                    </article><!-- #post-## -->

                    <?php astra_entry_after(); ?>
        <?php
                }

            endwhile;
            do_action('astra_template_parts_content_bottom');
        else :
            do_action('astra_template_parts_content_none');
        endif;
        ?>
    </main>

    <?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if (astra_page_layout() == 'right-sidebar') : ?>

    <?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>