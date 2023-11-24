<?php
if (class_exists('MetaboxGenerator')) {
    $mb_calendrier = new MetaboxGenerator;
};

// Calendrier Metabox

$spectacle_posts = new WP_Query(
    [
        'post_type'     => 'spectacle',
        'post_status'   => 'publish'
    ]
);
$spectacles = [];
if ($spectacle_posts->have_posts()) {
    while ($spectacle_posts->have_posts()) {
        $spectacle_posts->the_post();
        $spectacles[] =
            [
                'id'    => get_the_ID(),
                'title' => get_the_title()
            ];
    }
}
wp_reset_postdata();

$lieu_posts = new WP_Query(
    [
        'post_type'     => 'lieu',
        'post_status'   => 'publish'
    ]
);
$lieux = [];
if ($lieu_posts->have_posts()) {
    while ($lieu_posts->have_posts()) {
        $lieu_posts->the_post();
        $lieux[] =
            [
                'id'    => get_the_ID(),
                'title' => get_the_title()
            ];
    }
}
wp_reset_postdata();

$mb_calendrier->set_screens(['calendrier']);
$mb_calendrier->set_fields(
    [
        [
            'group_label' => '',
            [
                'label'         => 'Spectacle',
                'id'            => 'spectacle',
                'type'          => 'select',
                'options'       => $spectacles
            ],
            [
                'label'         => 'Lieu',
                'id'            => 'lieu',
                'type'          => 'select',
                'options'       => $lieux
            ],
            [
                'label'         => 'Date et heure',
                'id'            => 'time',
                'type'          => 'datetime-local',
                'repeatable'    => true
            ]
        ]
    ]
);
