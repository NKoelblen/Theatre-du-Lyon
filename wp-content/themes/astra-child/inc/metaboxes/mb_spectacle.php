<?php
if (class_exists('MetaboxGenerator')) {
    $mb_spectacle = new MetaboxGenerator;
};

// spectacle Metabox

$mb_spectacle->set_screens(['spectacle']);
$mb_spectacle->set_fields(
    [
        [
            'group_label' => '',
            [
                'label' => 'Sous-titre',
                'id'    => 'subtitle',
                'type'  => 'text'
            ],
            [
                'label' => 'Durée',
                'id'    => 'duree',
                'type'  => 'text'
            ],
            [
                'label' => 'Public',
                'id'    => 'public',
                'type'  => 'text'
            ],
            [
                'label' => 'A partir de',
                'id'    => 'age',
                'type'  => 'text'
            ]
        ]
    ]
);
