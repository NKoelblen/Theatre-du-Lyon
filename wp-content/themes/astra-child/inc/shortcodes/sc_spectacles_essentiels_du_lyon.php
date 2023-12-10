<?php

add_shortcode('les-essentiels-du-lyon', 'spectacles_essentiels_shortcode');
function spectacles_essentiels_shortcode()
{
    ob_start(); ?>

    <div class="spectacles-list alignfull">

        <?php $spectacle_posts = new WP_Query(
            [
                'post_type'         => 'spectacle',
                'post_status'       => 'publish',
                'category_name'      => 'les-essentiels-du-lyon',
                'order'             => 'ASC',
                'orderby'           => 'title',
                'posts_per_page'    => -1
            ]
        );

        if ($spectacle_posts->have_posts()) :
            while ($spectacle_posts->have_posts()) :
                $spectacle_posts->the_post();

                $id = get_the_id(); ?>

                <div class="unique-spectacle">

                    <a href="<?php echo get_the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url($id, 'medium_large'); ?>" class="spectacles-thumbnail"></a>

                    <hgroup>
                        <h2 style="text-align: center;"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                        <p style="text-align: center;"><?php echo get_post_meta($id, 'subtitle', true); ?></p>
                    </hgroup>

                    <div>
                        <p style="text-align: center;"><span class="gold">Durée </span><?php echo get_post_meta($id, 'duree', true); ?></p>
                        <p style="text-align: center;"><span class="gold">Spectacle </span><?php echo get_post_meta($id, 'public', true); ?></p>
                        <p style="text-align: center;"><span class="gold">A partir de </span><?php echo get_post_meta($id, 'age', true); ?></p>
                    </div>

                    <div>

                        <?php $calendrier_posts = new WP_Query(
                            [
                                'post_type'         => 'calendrier',
                                'post_status'       => 'publish',
                                'meta_key'          => 'spectacle',
                                'meta_value'        => $id,
                                'posts_per_page'    => -1
                            ]
                        );

                        if ($calendrier_posts->have_posts()) :
                            while ($calendrier_posts->have_posts()) :
                                $calendrier_posts->the_post();

                                $calendrier_id = get_the_id();
                                $c_times = get_post_meta($calendrier_id, "time", true);

                                $dates = [];
                                foreach ($c_times as $time) :
                                    $dates[] = $time['date'];
                                endforeach;
                                $dates = array_unique($dates);
                                sort($dates);
                                $mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"]; ?>

                                <p style="text-align: center;">
                                    <?php
                                    if (date('j', strtotime($dates[0])) !== date('j', strtotime(end($dates)))) :
                                        echo " du " . date("j", strtotime($dates[0])) . (date("j", strtotime($dates[0])) == 1 ? "er " : " ");
                                    endif;
                                    if (date('m', strtotime($dates[0])) !== date('m', strtotime(end($dates)))) :
                                        echo $mois[date("n", strtotime($dates[0])) - 1];
                                    endif;
                                    if (date('Y', strtotime($dates[0])) !== date('Y', strtotime(end($dates)))) :
                                        echo " " . date("Y", strtotime($dates[0]));
                                    endif;
                                    if (date('j', strtotime($dates[0])) !== date('j', strtotime(end($dates)))) :
                                        echo " au ";
                                    else :
                                        echo "le ";
                                    endif;
                                    echo date("j", strtotime(end($dates))) . (date("j", strtotime(end($dates))) == 1 ? "<sup>er</sup> " : " ") . $mois[date("n", strtotime(end($dates))) - 1] . " " . date("Y", strtotime(end($dates))); ?>
                                </p>

                                <?php $c_lieu_id = get_post_meta($calendrier_id, "lieu", true);

                                $lieu_posts = new WP_Query(
                                    [
                                        'p'         => $c_lieu_id,
                                        'post_type' => 'any'

                                    ]
                                );

                                if ($lieu_posts->have_posts()) : ?>
                                    <?php while ($lieu_posts->have_posts()) :
                                        $lieu_posts->the_post(); ?>

                                        <p style="text-align: center;"><?php echo " au " . get_the_title(); ?></p>

                        <?php endwhile;
                                endif;
                                wp_reset_postdata();

                            endwhile;
                        endif;
                        wp_reset_postdata(); ?>

                    </div>

                </div>

        <?php endwhile;
        endif;
        wp_reset_postdata(); ?>

    </div>

<?php return ob_get_clean();
}
