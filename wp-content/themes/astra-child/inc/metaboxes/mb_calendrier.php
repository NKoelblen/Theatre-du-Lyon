<?php
/* Calendrier Metabox */

if (class_exists('MetaboxGenerator')) {
    $mb_calendrier = new MetaboxGenerator; // ./Defined in mb_generator
};

/* Options for select spectacle field */

$spectacle_posts = new WP_Query(
    [
        'post_type'     => 'spectacle',
        'post_status'   => 'publish'
    ]
);
$spectacles = [];
if ($spectacle_posts->have_posts()) :
    while ($spectacle_posts->have_posts()) :
        $spectacle_posts->the_post();
        $spectacles[] =
            [
                'id'    => get_the_ID(),
                'title' => get_the_title()
            ];
    endwhile;
endif;
wp_reset_postdata();

/* Options for select lieu field */

$lieu_posts = new WP_Query(
    [
        'post_type'     => 'lieu',
        'post_status'   => 'publish'
    ]
);
$lieux = [];
if ($lieu_posts->have_posts()) :
    while ($lieu_posts->have_posts()) :
        $lieu_posts->the_post();
        $lieux[] =
            [
                'id'    => get_the_ID(),
                'title' => get_the_title()
            ];
    endwhile;
endif;
wp_reset_postdata();

/**
 *** How tu use : ***
 * method set_screens($post_types) ; method set_fields($groups_of_fields)
 * Refer to ./mb_generator comments
 */

$mb_calendrier->set_screens(['calendrier']);

$mb_calendrier->set_fields(
    [
        [
            'group_label' => '', // Required, can be empty
            [
                'label'             => 'Spectacle',
                'id'                => 'spectacle',
                'type'              => 'select',
                'options'           => $spectacles
            ], // end of spectacle
            [
                'label'             => 'Lieu',
                'id'                => 'lieu',
                'type'              => 'select',
                'options'           => $lieux
            ], // end of lieu
            [
                'id'                => 'time',
                'repeatable'        => true,
                'repeatable-fields' => [
                    [
                        'label'     => 'Date',
                        'id'        => 'date',
                        'type'      => 'date'
                    ], // end of date
                    [
                        'label'     => 'Heure',
                        'id'        => 'heure',
                        'type'      => 'time'
                    ], // end of heure
                    [
                        'label'     => 'Public',
                        'id'        => 'public',
                        'type'      => 'text'
                    ], // end of public    
                ] // end of repeatable-fields
            ] // end of time
        ] // end of group
    ] // end of fields
);
