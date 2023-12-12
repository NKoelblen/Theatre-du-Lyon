<?php

/* Used in each spectacle & in 'Représentations' page to display 'lieu', 'publics', 'dates' & 'heures' for each 'spectacle' */

add_shortcode('calendriers', 'calendriers_shortcode');
function calendriers_shortcode(): string|bool
{
    ob_start();
    global $post;
    $post_id = $post->ID; ?>

    <section class="astc_calendriers-list">

        <?php
        $calendrier_args =
            [
                'post_type'         => 'calendrier',
                'post_status'       => 'publish',
                'posts_per_page'    => -1
            ];
        if (is_singular('spectacle')) :

            $calendrier_args['meta_key'] = 'spectacle';
            $calendrier_args['meta_value'] = $post_id; ?>

            <h2 id="representations" class="wp-block-heading has-text-align-center">Représentations</h2>

            <?php endif;

        $calendrier_posts = new WP_Query($calendrier_args);

        if ($calendrier_posts->have_posts()) :
            while ($calendrier_posts->have_posts()) :
                $calendrier_posts->the_post(); ?>

                <article class="astc_each-calendrier">

                    <?php $calendrier_id = get_the_ID();

                    if (!is_single($post_id)) :

                        $spectacle_id = get_post_meta($calendrier_id, "spectacle", true); ?>

                        <a href="<?= get_the_permalink($spectacle_id); ?>" class="astc_each-calendrier-thumbnail-link">
                            <img class="astc_each-calendrier-thumbnail" src="<?= get_the_post_thumbnail_url($spectacle_id); ?>" srcset="<?= get_the_post_thumbnail_url($spectacle_id, 'medium_large'); ?> 768w, <?= get_the_post_thumbnail_url($spectacle_id, 'medium'); ?> 300w, <?= get_the_post_thumbnail_url($spectacle_id, 'thumbnail'); ?> 150w" sizes=" (max-width: 182px) 150px, (max-width: 332px) 300px, 768px">
                        </a>

                        <h2>
                            <a href="<?= get_the_permalink($spectacle_id); ?>"><?= get_the_title($spectacle_id); ?></a>
                        </h2>

                    <?php endif;

                    $times = get_post_meta($calendrier_id, "time", true);
                    array_multisort(array_column($times, 'public'), SORT_ASC, array_column($times, 'date'), SORT_ASC, array_column($times, 'heure'), SORT_ASC, $times);

                    $publics = [];
                    $dates = [];
                    $publics_datetimes = [];

                    foreach ($times as $time) :
                        $publics[] = $time['public'];
                        $dates[] = $time['date'];
                        $publics_datetimes[] = ['public' => $time['public'], 'date' => $time['date']];
                    endforeach; // Endforeach time

                    $publics = array_unique($publics);
                    $dates = array_unique($dates);

                    sort($dates);
                    $publics_datetimes = array_map("unserialize", array_unique(array_map("serialize", $publics_datetimes)));

                    $mois_abreges = ["Janv.", "Fevr.", "Mars", "Avr.", "Mai", "Juin", "Juil.", "Août", "Sept.", "Oct.", "Nov.", "Dec."];
                    $mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
                    $jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"]; ?>

                    <h3>

                        <?php $first_date = strtotime($dates[0]);
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

                        endif; // endif first_date != last_date

                        if ($first_formated_date) :

                            echo implode(" ", $first_formated_date) . " au ";

                        else :

                            echo "le ";

                        endif; // endif first_formated_date

                        echo $last_day . ($last_day == 1 ? "<sup>er</sup> " : " ") . $mois[$last_month - 1] . " " . $last_year; ?>

                    </h3>

                    <?php $lieu_id = get_post_meta($calendrier_id, "lieu", true); ?>

                    <div class="astc_lieu-dates">

                        <table class="astc_table-calendrier">
                            <tr>

                                <td><span class="dashicons dashicons-location"></span></td>

                                <td>

                                    <p class="marked"><?= get_the_title($lieu_id); ?></p>

                                    <?php $adress1 = get_post_meta($lieu_id, "adress1", true);
                                    if ($adress1) : ?>
                                        <p><?= $adress1; ?></p>
                                    <?php endif;

                                    $adress2 = get_post_meta($lieu_id, "adress2", true);
                                    if ($adress2) : ?>
                                        <p><?= $adress2 ?></p>
                                    <?php endif;

                                    $adress3 = get_post_meta($lieu_id, "adress3", true);
                                    if ($adress3) : ?>
                                        <p><?= $adress3 ?></p>
                                    <?php endif;

                                    $postal_code = get_post_meta($lieu_id, "postal-code", true);
                                    $city = get_post_meta($lieu_id, "city", true);
                                    if ($postal_code || $city) :

                                        $adress4 = [];

                                        if ($postal_code) :
                                            $adress4[] = $postal_code;
                                        endif;

                                        if ($city) :
                                            $adress4[] = $city;
                                        endif; ?>

                                        <p><?= implode(' ', $adress4) ?></p>

                                    <?php endif; // Endif postal_code or city

                                    $informations = get_post_meta($lieu_id, "informations", true);
                                    if ($informations) : ?>

                                        <div><?= wpautop($informations); ?></div>

                                    <?php endif;

                                    $website_url = get_post_meta($lieu_id, "website-url", true);
                                    $website_label = get_post_meta($lieu_id, "website-label", true);
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

                                </td>
                            </tr>
                        </table> <!-- End of lieu -->

                        <div class="astc_publics-list">

                            <?php foreach ($publics as $public) : ?>

                                <table class="astc_table-calendrier">
                                    <tbody>

                                        <?php if ($public) : ?>

                                            <tr>
                                                <th><span class="dashicons dashicons-clock"></span></th>
                                                <th colspan="2"><?= $public; ?></th>
                                            </tr>

                                        <?php endif; // Endif public 
                                        ?>

                                        <?php foreach ($publics_datetimes as $datetime) :

                                            if ($datetime['public'] === $public) :

                                                $date = strtotime($datetime['date']); ?>

                                                <tr>

                                                    <td>

                                                        <?php if (!$datetime['public']) : ?>

                                                            <span class="dashicons dashicons-clock"></span>

                                                        <?php endif; // Endif no datetime public 
                                                        ?>

                                                    </td> <!-- End of icon -->

                                                    <td><?= $jours[date("w", $date)] . " " . date("j", $date) . (date("j", $date) == 1 ? "<sup>er</sup> " : " ") . $mois_abreges[date("n", $date) - 1]; ?></td>

                                                    <td>

                                                        <?php foreach ($times as $time) :

                                                            if ($time['public'] === $datetime['public'] && $time['date'] === $datetime['date']) : ?>

                                                                <p><?= date_format(date_create($time['heure']), 'H\hi'); ?></p>

                                                        <?php endif; // Endif time public = datetime public and time date = datetime date

                                                        endforeach; // Endforeach time 
                                                        ?>

                                                    </td> <!-- End of time -->

                                                </tr> <!-- End of datetime -->

                                        <?php endif; // Endif datetime public = public

                                        endforeach; // Endforeach datetime 
                                        ?>

                                    </tbody>
                                </table> <!-- End of each public -->

                            <?php endforeach; // Endforeach public 
                            ?>

                        </div> <!-- End of publics list -->

                    </div> <!-- End of lieu dates -->

                </article> <!-- End of each calendrier -->

        <?php endwhile; // Endwhile calendrier_posts
        endif; // Endif calendrier_posts
        wp_reset_postdata(); ?>

    </section> <!-- End of calendriers list -->

<?php return ob_get_clean();
}
