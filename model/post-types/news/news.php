<?php
add_action('init', 'news_register_post_type');
function news_register_post_type()
{
    $labels = array(
        'menu_name'          => esc_html__('Noticias', ''),
        'name_admin_bar'     => esc_html__('Noticia', ''),
        'add_new'            => esc_html__('Adicionar Noticia', ''),
        'add_new_item'       => esc_html__('Adicionar  Noticia', ''),
        'new_item'           => esc_html__('Adicionar Noticia', ''),
        'edit_item'          => esc_html__('Editar Noticia', ''),
        'view_item'          => esc_html__('Ver Noticia', ''),
        'update_item'        => esc_html__('Ver Noticia', ''),
        'all_items'          => esc_html__('Todas Noticias', ''),
        'search_items'       => esc_html__('Procurar Noticias', ''),
        'parent_item_colon'  => esc_html__('Parent Noticia', ''),
        'not_found'          => esc_html__('Nenhuma Noticia Encontrada', ''),
        'not_found_in_trash' => esc_html__('No Noticias found in Trash', ''),
        'name'               => esc_html__('Noticias', ''),
        'singular_name'      => esc_html__('Noticia', ''),
    );

    $args = [
        'label'  => esc_html__('Noticias', 'text-domain'),
        'labels' => $labels,
        'public'              => true,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array('category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-media-document'
    ];

    register_post_type('noticia', $args);
}