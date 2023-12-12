<?php
/* Collaborateur Metabox */

if (class_exists('MetaboxGenerator')) {
    $mb_lieu = new MetaboxGenerator; // Defined in ./mb_generator
};

/**
 *** How tu use : ***
 * method set_screens($post_types) ; method set_fields($groups_of_fields)
 * Refer to ./mb_generator comments
 */

$mb_lieu->set_screens(['collaborateur']);

$mb_lieu->set_fields(
    [
        [
            'group_label' => '', // Required, can be empty
            [
                'label' => 'Fonction',
                'id'    => 'fonction',
                'type'  => 'text',
            ], // end of fonction
            [
                'label' => 'Biographie',
                'id'    => 'biographie',
                'type'  => 'WYSIWYG'
            ] // end of biographie
        ], // end of group
        [
            'group_label' => 'Site internet', // Required, can be empty
            [
                'label' => 'URL',
                'id'    => 'website-url',
                'type'  => 'url',
                'width' => '49.7%'
            ], // endof website-url
            [
                'label' => 'Texte de remplacement',
                'id'    => 'website-label',
                'type'  => 'text',
                'width' => '49.7%'
            ], // endof website-label
        ], // endof site internet
    ] // endof fields
);
