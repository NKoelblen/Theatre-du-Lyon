<?php
/* Register Custom Post Type Spectacle */
add_action('init', 'spectacle_post_type', 0);
function spectacle_post_type()
{
    $labels = [
        'name'                  => _x('Spectacles', 'Post Type General Name', 'astra-child'),
        'singular_name'         => _x('Spectacle', 'Post Type Singular Name', 'astra-child'),
        'menu_name'             => __('Spectacles', 'astra-child'),
        'name_admin_bar'        => __('Spectacle', 'astra-child'),
        'archives'              => __('Archives du Spectacle', 'astra-child'),
        'attributes'            => __('Attributs du Spectacle', 'astra-child'),
        'parent_item_colon'     => __('Parent du Spectacle :', 'astra-child'),
        'all_items'             => __('Tous les Spectacles', 'astra-child'),
        'add_new_item'          => __('Ajouter un nouveau Spectacle', 'astra-child'),
        'add_new'               => __('Nouveau Spectacle', 'astra-child'),
        'new_item'              => __('Nouveau Spectacle', 'astra-child'),
        'edit_item'             => __('Modifier le Spectacle', 'astra-child'),
        'update_item'           => __('Mettre à jour le Spectacle', 'astra-child'),
        'view_item'             => __('Voir le Spectacle', 'astra-child'),
        'view_items'            => __('Voir les Spectacles', 'astra-child'),
        'search_items'          => __('Chercher des Spectacles', 'astra-child'),
        'not_found'             => __('Aucun Spectacle trouvé', 'astra-child'),
        'not_found_in_trash'    => __('Aucun Spectacle trouvé dans la corbeille', 'astra-child'),
        'featured_image'        => __('Image mise en avant', 'astra-child'),
        'set_featured_image'    => __('Définir l\'image mise en avant', 'astra-child'),
        'remove_featured_image' => __('Supprimer l\'image mise en avant', 'astra-child'),
        'use_featured_image'    => __('Utiliser comme image mise en avant', 'astra-child'),
        'insert_into_item'      => __('Insérer dans ce Spectacle', 'astra-child'),
        'uploaded_to_this_item' => __('Télécharger dans ce Spectacle', 'astra-child'),
        'items_list'            => __('Liste des Spectacles', 'astra-child'),
        'items_list_navigation' => __('Navigation dans la liste des Spectacles', 'astra-child'),
        'filter_items_list'     => __('Filtrer la liste des Spectacles', 'astra-child'),
    ];
    $args = [
        'label'                 => __('Spectacle', 'astra-child'),
        'description'           => __('Spectacles', 'astra-child'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'            => array('category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_in_rest'          => true, // Gutenberg
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
    register_post_type('spectacle', $args);
}
