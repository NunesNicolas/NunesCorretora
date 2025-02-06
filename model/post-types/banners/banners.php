<?php
add_action('init', 'banner_register_post_type');
function banner_register_post_type()
{
    $args = [
        'label'  => esc_html__('Banners', 'text-domain'),
        'labels' => [
            'menu_name'          => esc_html__('Banners', 'your-textdomain'),
            'name_admin_bar'     => esc_html__('Banner', 'your-textdomain'),
            'add_new'            => esc_html__('Adicionar Banner', 'your-textdomain'),
            'add_new_item'       => esc_html__('Adicionar  novo Banner', 'your-textdomain'),
            'new_item'           => esc_html__('Novo Banner', 'your-textdomain'),
            'edit_item'          => esc_html__('Editar Banner', 'your-textdomain'),
            'view_item'          => esc_html__('Ver Banner', 'your-textdomain'),
            'update_item'        => esc_html__('Ver Banner', 'your-textdomain'),
            'all_items'          => esc_html__('Todos os Banners', 'your-textdomain'),
            'search_items'       => esc_html__('Procurar Banners', 'your-textdomain'),
            'parent_item_colon'  => esc_html__('Parent Banner', 'your-textdomain'),
            'not_found'          => esc_html__('Nenhum Banner Encontrado', 'your-textdomain'),
            'not_found_in_trash' => esc_html__('Nenhum Banner na lixeira', 'your-textdomain'),
            'name'               => esc_html__('Banners', 'your-textdomain'),
            'singular_name'      => esc_html__('Banner', 'your-textdomain'),
        ],
        'public'              => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'has_archive'         => true,
        'query_var'           => false,
        'can_export'          => true,
        'rewrite_no_front'    => false,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-format-gallery',
        'supports' => false,

        'rewrite' => true
    ];

    register_post_type('banner', $args);
}