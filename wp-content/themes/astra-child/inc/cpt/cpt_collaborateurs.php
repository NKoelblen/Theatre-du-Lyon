<?php
/* Register Collaborateur Custom Post Type */
add_action('init', 'collaborateurs_post_type', 0);
function collaborateurs_post_type()
{
    $labels = array(
        'name'                  => _x('Collaborateurs', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Collaborateur', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Collaborateurs', 'text_domain'),
        'name_admin_bar'        => __('Collaborateur', 'text_domain'),
        'archives'              => __('Archives du Collaborateur', 'text_domain'),
        'attributes'            => __('Attributs du Collaborateur', 'text_domain'),
        'parent_item_colon'     => __('Parent du Collaborateur :', 'text_domain'),
        'all_items'             => __('Tous les Collaborateurs', 'text_domain'),
        'add_new_item'          => __('Ajouter un nouveau Collaborateur', 'text_domain'),
        'add_new'               => __('Nouveau Collaborateur', 'text_domain'),
        'new_item'              => __('Nouveau Collaborateur', 'text_domain'),
        'edit_item'             => __('Modifier le Collaborateur', 'text_domain'),
        'update_item'           => __('Mettre à jour le Collaborateur', 'text_domain'),
        'view_item'             => __('Voir le Collaborateur', 'text_domain'),
        'view_items'            => __('Voir les Collaborateurs', 'text_domain'),
        'search_items'          => __('Chercher des Collaborateurs', 'text_domain'),
        'not_found'             => __('Aucun Collaborateur trouvé', 'text_domain'),
        'not_found_in_trash'    => __('Aucun Collaborateur trouvé dans la corbeille', 'text_domain'),
        'featured_image'        => __('Image mise en avant', 'text_domain'),
        'set_featured_image'    => __('Définir l\'image mise en avant', 'text_domain'),
        'remove_featured_image' => __('Supprimer l\'image mise en avant', 'text_domain'),
        'use_featured_image'    => __('Utiliser comme image mise en avant', 'text_domain'),
        'insert_into_item'      => __('Insérer dans ce Collaborateur', 'text_domain'),
        'uploaded_to_this_item' => __('Télécharger dans ce Collaborateur', 'text_domain'),
        'items_list'            => __('Liste des Collaborateurs', 'text_domain'),
        'items_list_navigation' => __('Navigation dans la liste des Collaborateurs', 'text_domain'),
        'filter_items_list'     => __('Filtrer la liste des Collaborateurs', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Collaborateur', 'text_domain'),
        'description'           => __('Collaborateurs', 'text_domain'),
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
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('collaborateur', $args);
}
