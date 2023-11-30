<?php

add_shortcode('calendriers', 'calendriers_shortcode');
function calendriers_shortcode()
{
    $calendrier_posts = new WP_Query(
        [
            'post_type'     => 'calendrier',
            'post_status'   => 'publish'
        ]
    );

    if ($calendrier_posts->have_posts()) :
        while ($calendrier_posts->have_posts()) :
            $calendrier_posts->the_post();

            $calendrier_id = get_the_ID();

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
                    <pre><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></pre>
                    <pre><?php echo get_post_meta($c_lieu_id, "adress1", true);; ?></pre>
                    <pre><?php echo get_post_meta($c_lieu_id, "adress2", true);; ?></pre>
                    <pre><?php echo get_post_meta($c_lieu_id, "adress3", true); ?></pre>
                    <pre><?php echo get_post_meta($c_lieu_id, "postal-code", true) . " " . get_post_meta($c_lieu_id, "city", true); ?></pre>
                    <pre>Informations complémentaires : <?php echo get_post_meta($c_lieu_id, "informations", true); ?></pre>
                    <pre>Site internet : <a href="<?php echo get_post_meta($c_lieu_id, "website-url", true); ?>" target="_blank"><?php echo get_post_meta($c_lieu_id, "website-label", true); ?></a></pre>
            <?php

                endwhile;
            endif;
            wp_reset_postdata();

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
            $publics_dates = array_map("unserialize", array_unique(array_map("serialize", $publics_dates))); ?>

            <pre><?php echo " du " . $dates[0] . " au " . end($dates); ?></pre>

            <? foreach ($publics as $public) : ?>

                <pre><?php echo $public; ?></pre>

                <?php foreach ($publics_dates as $date) :

                    if ($date['public'] === $public) : ?>

                        <pre><?php echo full_textual_date_fr(strtotime($date['date'])); ?></pre>

                        <?php foreach ($c_times as $time) :

                            if ($time['public'] === $date['public'] && $time['date'] === $date['date']) : ?>

                                <pre><?php echo date_format(date_create($time['heure']), 'H\hi'); ?></pre>
<?php endif;

                        endforeach;

                    endif;

                endforeach;

            endforeach;

        endwhile;
    endif;
    wp_reset_postdata();

    return ob_get_clean();
}
