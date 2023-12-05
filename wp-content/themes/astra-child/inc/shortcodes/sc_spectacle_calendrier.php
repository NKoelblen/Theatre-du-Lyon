<?php

add_shortcode('calendrier', 'calendrier_shortcode');
function calendrier_shortcode()
{
    ob_start();

    global $post;

    $post_id = $post->ID;

    if ($post->post_type === 'spectacle') :

        $calendrier_posts = new WP_Query(
            [
                'post_type'     => 'calendrier',
                'post_status'   => 'publish',
                'meta_key'      => 'spectacle',
                'meta_value'    => $post_id
            ]
        );

        if ($calendrier_posts->have_posts()) : ?>

            <div style="width: 100%;" class="wp-block-group is-vertical is-content-justification-center is-layout-flex wp-container-core-group-layout-5 wp-block-group-is-layout-flex">
                <h2 id="representations" class="wp-block-heading has-text-align-center">Représentations</h2>

                <?php while ($calendrier_posts->have_posts()) :
                    $calendrier_posts->the_post(); ?>

                    <div class="lieu-dates">

                        <?php $calendrier_id = get_the_ID();

                        $c_times = get_post_meta($calendrier_id, "time", true);
                        array_multisort(array_column($c_times, 'public'), SORT_ASC, array_column($c_times, 'date'), SORT_ASC, array_column($c_times, 'heure'), SORT_ASC, $c_times);

                        $publics = [];
                        $dates = [];
                        $publics_dates = [];
                        foreach ($c_times as $time) :
                            $publics[] = $time['public'];
                            $dates[] = $time['date'];
                            $publics_dates[] = ['public' => $time['public'], 'date' => $time['date']];
                        endforeach;
                        $publics = array_unique($publics);
                        $dates = array_unique($dates);
                        sort($dates);
                        $publics_dates = array_map("unserialize", array_unique(array_map("serialize", $publics_dates)));
                        $mois_abreges = ["Janv.", "Fevr.", "Mars", "Avr.", "Mai", "Juin", "Juil.", "Août", "Sept.", "Oct.", "Nov.", "Dec."];
                        $mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
                        $jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"]; ?>

                        <h3 style="text-align: center;">
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
                        </h3>

                        <?php $c_lieu_id = get_post_meta($calendrier_id, "lieu", true);

                        $lieu_posts = new WP_Query(
                            [
                                'p'         => $c_lieu_id,
                                'post_type' => 'any'

                            ]
                        );

                        if ($lieu_posts->have_posts()) : ?>
                            <div>
                                <table class="table-calendrier">
                                    <tr>
                                        <td><span class="dashicons dashicons-location"></span></td>
                                        <?php while ($lieu_posts->have_posts()) :
                                            $lieu_posts->the_post(); ?>

                                            <td>

                                                <p><strong><?php echo get_the_title(); ?></strong></p>

                                                <?php if (get_post_meta($c_lieu_id, "adress1", true) != "") : ?>
                                                    <p><strong><?php echo get_post_meta($c_lieu_id, "adress1", true); ?></strong></p>
                                                <?php endif;

                                                if (get_post_meta($c_lieu_id, "adress2", true) != "") : ?>
                                                    <p><strong><?php echo get_post_meta($c_lieu_id, "adress2", true); ?></strong></p>
                                                <?php endif;

                                                if (get_post_meta($c_lieu_id, "adress3", true) != "") : ?>
                                                    <p><strong><?php echo get_post_meta($c_lieu_id, "adress3", true); ?></strong></p>
                                                <?php endif;

                                                if (get_post_meta($c_lieu_id, "postal-code", true) != "" || get_post_meta($c_lieu_id, "city", true) != "") : ?>
                                                    <p><strong>
                                                            <?php if (get_post_meta($c_lieu_id, "postal-code", true) != "") :
                                                                echo get_post_meta($c_lieu_id, "postal-code", true) . " ";
                                                            endif;

                                                            if (get_post_meta($c_lieu_id, "city", true) != "") :
                                                                echo get_post_meta($c_lieu_id, "city", true);
                                                            endif; ?>
                                                        </strong></p>
                                                <?php endif;

                                                if (get_post_meta($c_lieu_id, "informations", true) != "") : ?>
                                                    <div><?php echo wpautop(get_post_meta($c_lieu_id, "informations", true)); ?></div>
                                                <?php endif;

                                                if (get_post_meta($c_lieu_id, "website-url", true) != "") : ?>
                                                    <p><strong>Site internet : </strong>
                                                        <a href="<?php echo get_post_meta($c_lieu_id, "website-url", true); ?>" target="_blank">
                                                            <?php if (get_post_meta($c_lieu_id, "website-label", true) != "") :
                                                                echo get_post_meta($c_lieu_id, "website-label", true);
                                                            else :
                                                                echo get_post_meta($c_lieu_id, "website-url", true);
                                                            endif; ?>
                                                        </a>
                                                    </p>
                                                <?php endif; ?>

                                            </td>

                                        <?php endwhile; ?>
                                    </tr>
                                </table>
                            </div>
                        <?php endif;
                        wp_reset_postdata(); ?>

                        <div class="dates-and-times">

                            <?php foreach ($publics as $public) : ?>

                                <table class="table-calendrier">
                                    <tbody>

                                        <?php if ($public != "") : ?>

                                            <tr>
                                                <th><span class="dashicons dashicons-clock"></span></th>
                                                <th colspan="2"><?php echo $public; ?></th>
                                            </tr>

                                        <?php endif; ?>

                                        <?php foreach ($publics_dates as $date) :

                                            if ($date['public'] === $public) : ?>

                                                <tr>
                                                    <td>
                                                        <?php if ($date['public'] === "") : ?>
                                                            <span class="dashicons dashicons-clock"></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo $jours[date("w", strtotime($date['date']))] . " " . date("j", strtotime($date['date'])) . (date("j", strtotime($date['date'])) == 1 ? "<sup>er</sup> " : " ") . $mois_abreges[date("n", strtotime($date['date'])) - 1]; ?></td>
                                                    <td>

                                                        <?php foreach ($c_times as $time) :

                                                            if ($time['public'] === $date['public'] && $time['date'] === $date['date']) : ?>

                                                                <p><?php echo date_format(date_create($time['heure']), 'H\hi'); ?></p>
                                                        <?php endif;

                                                        endforeach; ?>
                                                    </td>
                                                </tr>

                                        <?php endif;

                                        endforeach; ?>

                                    </tbody>
                                </table>

                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
<?php endif;
        wp_reset_postdata();

    endif;

    return ob_get_clean();
}
