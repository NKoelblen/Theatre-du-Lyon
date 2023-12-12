<?php
/* Register Custom Post Type Calendrier */
add_action('init', 'calendrier_post_type', 0);
function calendrier_post_type()
{
    $labels = [
        'name'                  => _x('Calendriers', 'Post Type General Name', 'astra-child'),
        'singular_name'         => _x('Calendrier', 'Post Type Singular Name', 'astra-child'),
        'menu_name'             => __('Calendriers', 'astra-child'),
        'name_admin_bar'        => __('Calendrier', 'astra-child'),
        'archives'              => __('Archives du Calendrier', 'astra-child'),
        'attributes'            => __('Attributs du Calendrier', 'astra-child'),
        'parent_item_colon'     => __('Parent du Calendriers :', 'astra-child'),
        'all_items'             => __('Tous les Calendriers', 'astra-child'),
        'add_new_item'          => __('Ajouter un nouveau Calendrier', 'astra-child'),
        'add_new'               => __('Nouveau Calendrier', 'astra-child'),
        'new_item'              => __('Nouveau Calendrier', 'astra-child'),
        'edit_item'             => __('Modifier le Calendrier', 'astra-child'),
        'update_item'           => __('Mettre à jour le Calendrier', 'astra-child'),
        'view_item'             => __('Voir le Calendrier', 'astra-child'),
        'view_items'            => __('Voir les Calendriers', 'astra-child'),
        'search_items'          => __('Chercher des Calendriers', 'astra-child'),
        'not_found'             => __('Aucun Calendrier trouvé', 'astra-child'),
        'not_found_in_trash'    => __('Aucun Calendrier trouvé dans la corbeille', 'astra-child'),
        'featured_image'        => __('Image mise en avant', 'astra-child'),
        'set_featured_image'    => __('Définir l\'image mise en avant', 'astra-child'),
        'remove_featured_image' => __('Supprimer l\'image mise en avant', 'astra-child'),
        'use_featured_image'    => __('Utiliser comme image mise en avant', 'astra-child'),
        'insert_into_item'      => __('Insérer dans ce Calendrier', 'astra-child'),
        'uploaded_to_this_item' => __('Télécharger dans ce Calendrier', 'astra-child'),
        'items_list'            => __('Liste des Calendriers', 'astra-child'),
        'items_list_navigation' => __('Navigation dans la liste des Calendriers', 'astra-child'),
        'filter_items_list'     => __('Filtrer la liste des Calendriers', 'astra-child'),
    ];
    $args = [
        'label'                 => __('Calendrier', 'astra-child'),
        'description'           => __('Calendriers', 'astra-child'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    ];
    register_post_type('calendrier', $args);
}
