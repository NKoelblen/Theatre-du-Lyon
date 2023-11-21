<?php
/* Register Spectacles Custom Post Type */
add_action('init', 'spectacles_post_type', 0);
function spectacles_post_type()
{
    $labels = array(
        'name'                  => _x('Spectacles', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Spectacle', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Spectacles', 'text_domain'),
        'name_admin_bar'        => __('Spectacle', 'text_domain'),
        'archives'              => __('Archives du Spectacle', 'text_domain'),
        'attributes'            => __('Attributs du Spectacl', 'text_domain'),
        'parent_item_colon'     => __('Parent du Spectacle :', 'text_domain'),
        'all_items'             => __('Tous les Spectacles', 'text_domain'),
        'add_new_item'          => __('Ajouter un nouveau Spectacle', 'text_domain'),
        'add_new'               => __('Nouveau Spectacle', 'text_domain'),
        'new_item'              => __('Nouveau Spectacle', 'text_domain'),
        'edit_item'             => __('Modifier le Spectacle', 'text_domain'),
        'update_item'           => __('Mettre à jour le Spectacle', 'text_domain'),
        'view_item'             => __('Voir le Spectacle', 'text_domain'),
        'view_items'            => __('Voir les Spectacles', 'text_domain'),
        'search_items'          => __('Chercher des Spectacles', 'text_domain'),
        'not_found'             => __('Aucun Spectacle trouvé', 'text_domain'),
        'not_found_in_trash'    => __('Aucun Spectacle trouvé dans la corbeille', 'text_domain'),
        'featured_image'        => __('Image mise en avant', 'text_domain'),
        'set_featured_image'    => __('Définir l\'image mise en avant', 'text_domain'),
        'remove_featured_image' => __('Supprimer l\'image mise en avant', 'text_domain'),
        'use_featured_image'    => __('Utiliser comme image mise en avant', 'text_domain'),
        'insert_into_item'      => __('Insérer dans ce Spectacle', 'text_domain'),
        'uploaded_to_this_item' => __('Télécharger dans ce Spectacle', 'text_domain'),
        'items_list'            => __('Liste des Spectacles', 'text_domain'),
        'items_list_navigation' => __('Navigation dans la liste des Spectacles', 'text_domain'),
        'filter_items_list'     => __('Filtrer la liste des Spectacles', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Spectacle', 'text_domain'),
        'description'           => __('Spectacles', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
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
    register_post_type('spectacle', $args);
}
