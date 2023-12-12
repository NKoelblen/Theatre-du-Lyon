<?php
/* Spectable Metabox */

if (class_exists('MetaboxGenerator')) {
    $mb_spectacle = new MetaboxGenerator; // Defined in ./mb_generator
};

/**
 *** How tu use : ***
 * method set_screens($post_types) ; method set_fields($groups_of_fields)
 * Refer to ./mb_generator comments
 */

$mb_spectacle->set_screens(['spectacle']);

$mb_spectacle->set_fields(
    [
        [
            'group_label' => '', // Required, can be empty
            [
                'label' => 'Sous-titre',
                'id'    => 'subtitle',
                'type'  => 'text'
            ], // end of subtitle
            [
                'label' => 'Durée',
                'id'    => 'duree',
                'type'  => 'text'
            ], // end of duree
            [
                'label' => 'Public',
                'id'    => 'public',
                'type'  => 'text'
            ], // end of public
            [
                'label' => 'A partir de',
                'id'    => 'age',
                'type'  => 'text'
            ] // end of age
        ] // end of group
    ] // end of fields
);
