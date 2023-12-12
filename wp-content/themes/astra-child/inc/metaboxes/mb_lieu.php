<?php
/* Lieu Metabox */

if (class_exists('MetaboxGenerator')) {
    $mb_lieu = new MetaboxGenerator; // Defined in ./mb_generator
};

/**
 *** How tu use : ***
 * method set_screens($post_types) ; method set_fields($groups_of_fields)
 * Refer to ./mb_generator comments
 */

$mb_lieu->set_screens(['lieu']);

$mb_lieu->set_fields(
    [
        [
            'group_label' => 'Adresse', // Required, can be empty
            [
                'label' => 'Complément d\'adresse',
                'id'    => 'adress1',
                'type'  => 'text'
            ], // end of adress1
            [
                'label' => 'Numéro, type et nom de la voie',
                'id'    => 'adress2',
                'type'  => 'text'
            ], // end of adress2
            [
                'label' => 'Lieu-dit',
                'id'    => 'adress3',
                'type'  => 'text'
            ], // end of adress3
            [
                'label' => 'Code Postal',
                'id'    => 'postal-code',
                'type'  => 'text',
                'width' => '24.7%'
            ], // end of postal-code
            [
                'label' => 'Ville',
                'id'    => 'city',
                'type'  => 'text',
                'width' => '74.7%'
            ] // end of city
        ], // end of Adresse
        [
            'group_label' => 'Site internet', // Required, can be empty
            [
                'label' => 'URL',
                'id'    => 'website-url',
                'type'  => 'url',
                'width' => '49.7%'
            ], // end of website-url
            [
                'label' => 'Texte de remplacement',
                'id'    => 'website-label',
                'type'  => 'text',
                'width' => '49.7%'
            ], // end of website-label
        ], // end of Site internet
        [
            'group_label' => '', // Required, can be empty
            [
                'label' => 'Informations complémentaires',
                'id'    => 'informations',
                'type'  => 'WYSIWYG'
            ] // end of informations
        ] // end of group
    ] // end of fields
);
