<?php
/* Register Lieux Custom Post Type */
add_action('init', 'lieux_post_type', 0);
function lieux_post_type()
{
    $labels = array(
        'name'                  => _x('Lieux', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Lieu', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Lieux', 'text_domain'),
        'name_admin_bar'        => __('Lieu', 'text_domain'),
        'archives'              => __('Archives du Lieu', 'text_domain'),
        'attributes'            => __('Attributs du Lieu', 'text_domain'),
        'parent_item_colon'     => __('Parent du Lieu :', 'text_domain'),
        'all_items'             => __('Tous les Lieux', 'text_domain'),
        'add_new_item'          => __('Ajouter un nouveau Lieu', 'text_domain'),
        'add_new'               => __('Nouveau Lieu', 'text_domain'),
        'new_item'              => __('Nouveau Lieu', 'text_domain'),
        'edit_item'             => __('Modifier le Lieu', 'text_domain'),
        'update_item'           => __('Mettre à jour le Lieu', 'text_domain'),
        'view_item'             => __('Voir le Lieu', 'text_domain'),
        'view_items'            => __('Voir les Lieux', 'text_domain'),
        'search_items'          => __('Chercher des Lieux', 'text_domain'),
        'not_found'             => __('Aucun Lieu trouvé', 'text_domain'),
        'not_found_in_trash'    => __('Aucun Lieu trouvé dans la corbeille', 'text_domain'),
        'featured_image'        => __('Image mise en avant', 'text_domain'),
        'set_featured_image'    => __('Définir l\'image mise en avant', 'text_domain'),
        'remove_featured_image' => __('Supprimer l\'image mise en avant', 'text_domain'),
        'use_featured_image'    => __('Utiliser comme image mise en avant', 'text_domain'),
        'insert_into_item'      => __('Insérer dans ce Lieu', 'text_domain'),
        'uploaded_to_this_item' => __('Télécharger dans ce Lieu', 'text_domain'),
        'items_list'            => __('Liste des Lieux', 'text_domain'),
        'items_list_navigation' => __('Navigation dans la liste des Lieux', 'text_domain'),
        'filter_items_list'     => __('Filtrer la liste des Lieux', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Lieu', 'text_domain'),
        'description'           => __('Lieux', 'text_domain'),
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
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('lieu', $args);
}
