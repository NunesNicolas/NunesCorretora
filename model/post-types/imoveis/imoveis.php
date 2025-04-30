<?php
/**
 * Registro do Custom Post Type de Imóveis e seus campos personalizados
 */

// Registrar Custom Post Type
function regiane_register_imovel_post_type()
{
  $labels = array(
    'name' => 'Imóveis',
    'singular_name' => 'Imóvel',
    'menu_name' => 'Imóveis',
    'name_admin_bar' => 'Imóvel',
    'archives' => 'Arquivo de Imóveis',
    'attributes' => 'Atributos do Imóvel',
    'parent_item_colon' => 'Imóvel Pai:',
    'all_items' => 'Todos os Imóveis',
    'add_new_item' => 'Adicionar Novo Imóvel',
    'add_new' => 'Adicionar Novo',
    'new_item' => 'Novo Imóvel',
    'edit_item' => 'Editar Imóvel',
    'update_item' => 'Atualizar Imóvel',
    'view_item' => 'Ver Imóvel',
    'view_items' => 'Ver Imóveis',
    'search_items' => 'Buscar Imóvel',
    'not_found' => 'Não encontrado',
    'not_found_in_trash' => 'Não encontrado na Lixeira',
    'featured_image' => 'Imagem Destacada',
    'set_featured_image' => 'Definir imagem destacada',
    'remove_featured_image' => 'Remover imagem destacada',
    'use_featured_image' => 'Usar como imagem destacada',
    'insert_into_item' => 'Inserir no imóvel',
    'uploaded_to_this_item' => 'Enviado para este imóvel',
    'items_list' => 'Lista de imóveis',
    'items_list_navigation' => 'Navegação da lista de imóveis',
    'filter_items_list' => 'Filtrar lista de imóveis',
  );

  $args = array(
    'label' => 'Imóvel',
    'description' => 'Imóveis para venda ou aluguel',
    'labels' => $labels,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-home',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'imoveis'),
  );

  register_post_type('imovel', $args);
}
add_action('init', 'regiane_register_imovel_post_type', 0);

// Registrar Taxonomia para Tipo de Imóvel
function regiane_register_tipo_imovel_taxonomy()
{
  $labels = array(
    'name' => 'Tipos de Imóvel',
    'singular_name' => 'Tipo de Imóvel',
    'menu_name' => 'Tipos de Imóvel',
    'all_items' => 'Todos os Tipos',
    'parent_item' => 'Tipo Pai',
    'parent_item_colon' => 'Tipo Pai:',
    'new_item_name' => 'Novo Tipo de Imóvel',
    'add_new_item' => 'Adicionar Novo Tipo',
    'edit_item' => 'Editar Tipo',
    'update_item' => 'Atualizar Tipo',
    'view_item' => 'Ver Tipo',
    'separate_items_with_commas' => 'Separar tipos com vírgulas',
    'add_or_remove_items' => 'Adicionar ou remover tipos',
    'choose_from_most_used' => 'Escolher entre os mais usados',
    'popular_items' => 'Tipos populares',
    'search_items' => 'Buscar Tipos',
    'not_found' => 'Não encontrado',
    'no_terms' => 'Sem tipos',
    'items_list' => 'Lista de tipos',
    'items_list_navigation' => 'Navegação da lista de tipos',
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => false,
    'rewrite' => array('slug' => 'tipo-imovel'),
  );

  register_taxonomy('tipo-imovel', array('imovel'), $args);
}
add_action('init', 'regiane_register_tipo_imovel_taxonomy', 0);

// Registrar Taxonomia para Localização
function regiane_register_localizacao_taxonomy()
{
  $labels = array(
    'name' => 'Localizações',
    'singular_name' => 'Localização',
    'menu_name' => 'Localizações',
    'all_items' => 'Todas as Localizações',
    'parent_item' => 'Localização Pai',
    'parent_item_colon' => 'Localização Pai:',
    'new_item_name' => 'Nova Localização',
    'add_new_item' => 'Adicionar Nova Localização',
    'edit_item' => 'Editar Localização',
    'update_item' => 'Atualizar Localização',
    'view_item' => 'Ver Localização',
    'separate_items_with_commas' => 'Separar localizações com vírgulas',
    'add_or_remove_items' => 'Adicionar ou remover localizações',
    'choose_from_most_used' => 'Escolher entre os mais usados',
    'popular_items' => 'Localizações populares',
    'search_items' => 'Buscar Localizações',
    'not_found' => 'Não encontrado',
    'no_terms' => 'Sem localizações',
    'items_list' => 'Lista de localizações',
    'items_list_navigation' => 'Navegação da lista de localizações',
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => false,
    'rewrite' => array('slug' => 'localizacao'),
  );

  register_taxonomy('localizacao', array('imovel'), $args);
}
add_action('init', 'regiane_register_localizacao_taxonomy', 0);

// Adicionar campos personalizados se o ACF estiver ativo
if (function_exists('acf_add_local_field_group')) {
  acf_add_local_field_group(array(
    'key' => 'group_imovel_detalhes',
    'title' => 'Detalhes do Imóvel',
    'fields' => array(
      array(
        'key' => 'field_preco',
        'label' => 'Preço',
        'name' => 'preco',
        'type' => 'number',
        'instructions' => 'Informe o preço do imóvel',
        'required' => 1,
        'default_value' => '',
        'min' => 0,
      ),
      array(
        'key' => 'field_area',
        'label' => 'Área (m²)',
        'name' => 'area',
        'type' => 'number',
        'instructions' => 'Informe a área do imóvel em metros quadrados',
        'required' => 1,
        'default_value' => '',
        'min' => 0,
      ),
      array(
        'key' => 'field_quartos',
        'label' => 'Quartos',
        'name' => 'quartos',
        'type' => 'number',
        'instructions' => 'Número de quartos',
        'required' => 0,
        'default_value' => 0,
        'min' => 0,
      ),
      array(
        'key' => 'field_banheiros',
        'label' => 'Banheiros',
        'name' => 'banheiros',
        'type' => 'number',
        'instructions' => 'Número de banheiros',
        'required' => 0,
        'default_value' => 0,
        'min' => 0,
      ),
      array(
        'key' => 'field_garagem',
        'label' => 'Vagas na Garagem',
        'name' => 'garagem',
        'type' => 'number',
        'instructions' => 'Número de vagas na garagem',
        'required' => 0,
        'default_value' => 0,
        'min' => 0,
      ),
      array(
        'key' => 'field_endereco',
        'label' => 'Endereço',
        'name' => 'endereco',
        'type' => 'text',
        'instructions' => 'Endereço do imóvel',
        'required' => 0,
      ),
      array(
        'key' => 'field_destaque',
        'label' => 'Imóvel em Destaque',
        'name' => 'destaque',
        'type' => 'true_false',
        'instructions' => 'Marque para exibir este imóvel na seção de destaques',
        'required' => 0,
        'default_value' => 0,
        'ui' => 1,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'imovel',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
  ));
}