<?php
/* Register Custom Post Type Lieu */
add_action('init', 'lieu_post_type', 0);
function lieu_post_type()
{
    $labels = [
        'name'                  => _x('Lieux', 'Post Type General Name', 'astra-child'),
        'singular_name'         => _x('Lieu', 'Post Type Singular Name', 'astra-child'),
        'menu_name'             => __('Lieux', 'astra-child'),
        'name_admin_bar'        => __('Lieu', 'astra-child'),
        'archives'              => __('Archives du Lieu', 'astra-child'),
        'attributes'            => __('Attributs du Lieu', 'astra-child'),
        'parent_item_colon'     => __('Parent du Lieu :', 'astra-child'),
        'all_items'             => __('Tous les Lieux', 'astra-child'),
        'add_new_item'          => __('Ajouter un nouveau Lieu', 'astra-child'),
        'add_new'               => __('Nouveau Lieu', 'astra-child'),
        'new_item'              => __('Nouveau Lieu', 'astra-child'),
        'edit_item'             => __('Modifier le Lieu', 'astra-child'),
        'update_item'           => __('Mettre à jour le Lieu', 'astra-child'),
        'view_item'             => __('Voir le Lieu', 'astra-child'),
        'view_items'            => __('Voir les Lieux', 'astra-child'),
        'search_items'          => __('Chercher des Lieux', 'astra-child'),
        'not_found'             => __('Aucun Lieu trouvé', 'astra-child'),
        'not_found_in_trash'    => __('Aucun Lieu trouvé dans la corbeille', 'astra-child'),
        'featured_image'        => __('Image mise en avant', 'astra-child'),
        'set_featured_image'    => __('Définir l\'image mise en avant', 'astra-child'),
        'remove_featured_image' => __('Supprimer l\'image mise en avant', 'astra-child'),
        'use_featured_image'    => __('Utiliser comme image mise en avant', 'astra-child'),
        'insert_into_item'      => __('Insérer dans ce Lieu', 'astra-child'),
        'uploaded_to_this_item' => __('Télécharger dans ce Lieu', 'astra-child'),
        'items_list'            => __('Liste des Lieux', 'astra-child'),
        'items_list_navigation' => __('Navigation dans la liste des Lieux', 'astra-child'),
        'filter_items_list'     => __('Filtrer la liste des Lieux', 'astra-child'),
    ];
    $args = [
        'label'                 => __('Lieu', 'astra-child'),
        'description'           => __('Lieux', 'astra-child'),
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
    register_post_type('lieu', $args);
}
