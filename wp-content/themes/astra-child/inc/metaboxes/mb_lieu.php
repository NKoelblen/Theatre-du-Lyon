<?php
if (class_exists('MetaboxGenerator')) {
    $mb_lieu = new MetaboxGenerator;
};

// Lieu Metabox

$mb_lieu->set_screens(['lieu']);
$mb_lieu->set_fields(
    [
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
        [
            'group_label' => 'Adresse',
            [
                'label' => 'Complément d\'adresse',
                'id'    => 'adress1',
                'type'  => 'text'
            ],
            [
                'label' => 'Numéro, type et nom de la voie',
                'id'    => 'adress2',
                'type'  => 'text'
            ],
            [
                'label' => 'Lieu-dit',
                'id'    => 'adress3',
                'type'  => 'text'
            ],
            [
                'label' => 'Code Postal',
                'id'    => 'postal-code',
                'type'  => 'text',
                'width' => '24.7%'
            ],
            [
                'label' => 'Ville',
                'id'    => 'city',
                'type'  => 'text',
                'width' => '74.7%'
            ]
        ],
        [
            'group_label' => '',
            [
                'label' => 'Informations complémentaires',
                'id'    => 'informations',
                'type'  => 'WYSIWYG'
            ]
        ]
    ]
);
