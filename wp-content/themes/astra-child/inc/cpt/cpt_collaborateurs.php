<?php
/* Register Custom Post Type Collaborateur */
add_action('init', 'collaborateur_post_type', 0);
function collaborateur_post_type()
{
    $labels = [
        'name'                  => _x('Collaborateurs', 'Post Type General Name', 'astra-child'),
        'singular_name'         => _x('Collaborateur', 'Post Type Singular Name', 'astra-child'),
        'menu_name'             => __('Collaborateurs', 'astra-child'),
        'name_admin_bar'        => __('Collaborateur', 'astra-child'),
        'archives'              => __('Archives du Collaborateur', 'astra-child'),
        'attributes'            => __('Attributs du Collaborateur', 'astra-child'),
        'parent_item_colon'     => __('Parent du Collaborateur :', 'astra-child'),
        'all_items'             => __('Tous les Collaborateurs', 'astra-child'),
        'add_new_item'          => __('Ajouter un nouveau Collaborateur', 'astra-child'),
        'add_new'               => __('Nouveau Collaborateur', 'astra-child'),
        'new_item'              => __('Nouveau Collaborateur', 'astra-child'),
        'edit_item'             => __('Modifier le Collaborateur', 'astra-child'),
        'update_item'           => __('Mettre à jour le Collaborateur', 'astra-child'),
        'view_item'             => __('Voir le Collaborateur', 'astra-child'),
        'view_items'            => __('Voir les Collaborateurs', 'astra-child'),
        'search_items'          => __('Chercher des Collaborateurs', 'astra-child'),
        'not_found'             => __('Aucun Collaborateur trouvé', 'astra-child'),
        'not_found_in_trash'    => __('Aucun Collaborateur trouvé dans la corbeille', 'astra-child'),
        'featured_image'        => __('Image mise en avant', 'astra-child'),
        'set_featured_image'    => __('Définir l\'image mise en avant', 'astra-child'),
        'remove_featured_image' => __('Supprimer l\'image mise en avant', 'astra-child'),
        'use_featured_image'    => __('Utiliser comme image mise en avant', 'astra-child'),
        'insert_into_item'      => __('Insérer dans ce Collaborateur', 'astra-child'),
        'uploaded_to_this_item' => __('Télécharger dans ce Collaborateur', 'astra-child'),
        'items_list'            => __('Liste des Collaborateurs', 'astra-child'),
        'items_list_navigation' => __('Navigation dans la liste des Collaborateurs', 'astra-child'),
        'filter_items_list'     => __('Filtrer la liste des Collaborateurs', 'astra-child'),
    ];
    $args = [
        'label'                 => __('Collaborateur', 'astra-child'),
        'description'           => __('Collaborateurs', 'astra-child'),
        'labels'                => $labels,
        'supports'              => array('title', 'thumbnail'),
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
    register_post_type('collaborateur', $args);
}
