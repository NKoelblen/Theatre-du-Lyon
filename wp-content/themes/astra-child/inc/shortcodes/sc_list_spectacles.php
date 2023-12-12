<?php

/* Used in home, 'Le Théâtre du Lyon' & 'Spectacles' pages to display 'spectacles' list */

add_shortcode('spectacles', 'spectacles_shortcode');
function spectacles_shortcode($atts): string|bool
{
    extract(shortcode_atts(
        [
            'categorie' => ''
        ],
        $atts
    ));

    ob_start();
    global $post;
    $post_id = $post->ID; ?>

    <div class="astc_posts-list alignfull">

        <?php
        $spectacle_args =
            [
                'post_type'         => 'spectacle',
                'post_status'       => 'publish',
                'order'             => 'ASC',
                'orderby'           => 'title',
                'posts_per_page'    => -1
            ];

        if ($categorie) :

            $spectacle_args['category_name'] = $categorie;

        endif; // Endif categorie

        $spectacle_posts = new WP_Query($spectacle_args);

        if ($spectacle_posts->have_posts()) :
            while ($spectacle_posts->have_posts()) :
                $spectacle_posts->the_post();

                $spectacle_id = get_the_id();
                $categories = get_the_category($spectacle_id); ?>

                <article class="astc_each-post">

                    <a href="<?= get_the_permalink(); ?>" class="astc_each-post-thumbnail-link">

                        <img class="astc_each-post-thumbnail" src="<?= get_the_post_thumbnail_url(); ?>" srcset="<?= get_the_post_thumbnail_url($spectacle_id, 'medium_large'); ?> 768w, <?= get_the_post_thumbnail_url($spectacle_id, 'medium'); ?> 300w, <?= get_the_post_thumbnail_url($spectacle_id, 'thumbnail'); ?> 150w" sizes=" (max-width: 182px) 150px, (max-width: 332px) 300px, 768px">

                        <?php if (!$categorie) :

                            foreach ($categories as $category) :

                                $category_name = $category->cat_name;
                                if ($category_name === "Les essentiels du Lyon") : ?>

                                    <img class="astc_les-essentiels-du-lyon" src="<?= get_site_url() ?>/wp-content/themes/astra-child/assets/images/Pastille essentiels du lyon.webp">

                        <?php endif; // Endif not category_name

                            endforeach; // Endforeach category

                        endif; // Endif not categorie
                        ?>

                    </a>

                    <?php if (is_home($post_id)) : ?>

                        <h3><a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a></h3>

                    <?php else : ?>

                        <h2><a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a></h2>

                    <?php endif; // Endif home 
                    ?>

                    <p><?= get_post_meta($spectacle_id, 'subtitle', true); ?></p>

                    <div>
                        <p><span class="marked">Durée </span><?= get_post_meta($spectacle_id, 'duree', true); ?></p>
                        <p><span class="marked">Spectacle </span><?= get_post_meta($spectacle_id, 'public', true); ?></p>
                        <p><span class="marked">A partir de </span><?= get_post_meta($spectacle_id, 'age', true); ?></p>
                    </div>

                    <div>

                        <?php $calendrier_posts = new WP_Query(
                            [
                                'post_type'         => 'calendrier',
                                'post_status'       => 'publish',
                                'meta_key'          => 'spectacle',
                                'meta_value'        => $spectacle_id,
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
                                endforeach; // Endforeach time

                                $dates = array_unique($dates);
                                sort($dates);

                                $mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

                                $first_date = strtotime($dates[0]);
                                $last_date = strtotime(end($dates));

                                $first_day = date('j', $first_date);
                                $last_day = date('j', $last_date);

                                $first_month = date('n', $first_date);
                                $last_month = date('n', $last_date);

                                $first_year = date('Y', $first_date);
                                $last_year = date('Y', $last_date);

                                $first_formated_date = [];

                                if ($first_year !== $last_year) :

                                    $first_formated_date[] = $first_year;

                                elseif ($first_month !== $last_month) :

                                    array_unshift($first_formated_date, $mois[$first_month - 1]);

                                elseif ($first_day !== $last_day) :

                                    array_unshift($first_formated_date, "du " . $first_day . ($first_day == 1 ? "<sup>er</sup>" : ""));

                                endif; // Endif first_date != last_date 
                        ?>

                                <p>

                                    <?php if ($first_formated_date) :

                                        echo implode(" ", $first_formated_date) . " au ";

                                    else :

                                        echo "le ";

                                    endif; // endif first_formated_date

                                    echo $last_day . ($last_day == 1 ? "<sup>er</sup> " : " ") . $mois[$last_month - 1] . " " . $last_year; ?>

                                </p>

                                <?php $lieu_id = get_post_meta($calendrier_id, "lieu", true); ?>


                                <p><span class="marked">au </span><?= get_the_title($lieu_id); ?></p>

                        <?php endwhile; // Endwhile calendrier_posts
                        endif; // Endif calendrier_posts
                        wp_reset_postdata(); ?>

                    </div>

                </article>

        <?php endwhile; // Endwhile spectacle_posts
        endif; // Endif spectacle_posts
        wp_reset_postdata(); ?>

    </div>

<?php return ob_get_clean();
}
