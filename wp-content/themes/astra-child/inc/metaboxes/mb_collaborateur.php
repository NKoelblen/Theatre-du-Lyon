<?php
if (class_exists('MetaboxGenerator')) {
    $mb_lieu = new MetaboxGenerator;
};

// Lieu Metabox

$mb_lieu->set_screens(['collaborateur']);
$mb_lieu->set_fields(
    [
        [
            'group_label' => '',
            [
                'label' => 'Fonction',
                'id'    => 'fonction',
                'type'  => 'text',
            ],
            [
                'label' => 'Biographie',
                'id'    => 'biographie',
                'type'  => 'WYSIWYG'
            ]
        ],
        [
            'group_label' => 'Site internet',
            [
                'label' => 'URL',
                'id'    => 'website-url',
                'type'  => 'url',
                'width' => '49.7%'
            ],
            [
                'label' => 'Texte de remplacement',
                'id'    => 'website-label',
                'type'  => 'text',
                'width' => '49.7%'
            ],
        ],
    ]
);
