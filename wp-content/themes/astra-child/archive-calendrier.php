<?php

/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
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

	<?php astra_archive_header(); ?>

	<main id="main" class="site-main">
		<?php
		if (have_posts()) :
			do_action('astra_template_parts_content_top');

			while (have_posts()) :
				the_post(); ?>

				<?php astra_entry_before(); ?>
				<article <?php
							echo astra_attr(
								'article-blog',
								array(
									'id'    => 'post-' . get_the_id(),
									'class' => join(' ', get_post_class()),
								)
							);
							?>>
					<?php astra_entry_top(); ?>

					<div <?php astra_blog_layout_class('blog-layout-1'); ?>>
						<div class="post-content <?php echo astra_attr('ast-grid-common-col'); ?>">
							<?php astra_blog_post_thumbnail_and_title_order(); ?>
							<div class="entry-content clear" <?php
																echo astra_attr(
																	'article-entry-content-blog-layout',
																	array(
																		'class' => '',
																	)
																);
																?>>
								<?php
								astra_entry_content_before();
								astra_the_excerpt();

								$calendrier_id = get_the_ID();

								$c_spectacle_id = get_post_meta($calendrier_id, "spectacle", true);

								$spectacle_posts = new WP_Query(
									[
										'p'         => $c_spectacle_id,
										'post_type' => 'any'

									]
								);

								if ($spectacle_posts->have_posts()) :
									while ($spectacle_posts->have_posts()) :
										$spectacle_posts->the_post();
								?>
										<pre><?php echo get_the_title(); ?></pre>
									<?php

									endwhile;
								endif;
								wp_reset_postdata();

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

								astra_entry_content_after();

								wp_link_pages(
									array(
										'before'      => '<div class="page-links">' . esc_html(astra_default_strings('string-blog-page-links-before', false)),
										'after'       => '</div>',
										'link_before' => '<span class="page-link">',
										'link_after'  => '</span>',
									)
								);
								?>
							</div><!-- .entry-content .clear -->
						</div><!-- .post-content -->
					</div> <!-- .blog-layout-1 -->

					<?php astra_entry_bottom(); ?>
				</article><!-- #post-## -->
				<?php astra_entry_after(); ?>
		<?php
			endwhile;
			do_action('astra_template_parts_content_bottom');
		else :
			do_action('astra_template_parts_content_none');
		endif;
		?>
	</main><!-- #main -->

	<?php astra_pagination(); ?>

	<?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if (astra_page_layout() == 'right-sidebar') : ?>

	<?php get_sidebar(); ?>

<?php endif; ?>

<?php get_footer();
