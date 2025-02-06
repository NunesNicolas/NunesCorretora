<?php
/* ------------------------------ Taxonomias Personalizadas para Atrações -----------------------------*/
//hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_subjects_hierarchical_taxonomy_atracoes', 0);

//create a custom taxonomy name it subjects for your posts

function create_subjects_hierarchical_taxonomy_atracoes()
{

    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI

    $labels = array(
        'name' => _x('Tipos de Publicações', 'taxonomy general name'),
        'singular_name' => _x('Filtros Publicações', 'taxonomy singular name'),
        'search_items' =>  __('Procurar Filtros'),
        'all_items' => __('Todos Filtros'),
        'parent_item' => __('Parent Subject'),
        'parent_item_colon' => __('Parent Subject:'),
        'edit_item' => __('Edit Subject'),
        'update_item' => __('Update Subject'),
        'add_new_item' => __('Adicionar Nova Categoria'),
        'new_item_name' => __('Nome da Nova Categoria'),
        'menu_name' => __('Tipos de Publicações'),
    );

    // Now register the taxonomy
    register_taxonomy('tipos-publicacoes', array('noticia'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'news'),
    ));
}