<?php

function filter_publications()
{

    $dados = new stdClass();
    $dados->tipo = $_POST['tipo'] ? sanitize_text_field($_POST['tipo']) : null;
    $dados->search = $_POST['search'] ? sanitize_text_field($_POST['search']) : '';
    $dados->de = $_POST['de'] ? strtotime($_POST['de']) : null;
    $dados->ate = $_POST['ate'] ? strtotime($_POST['ate']) : null;
    $dados->category = $_POST['category'] ? $_POST['category'] : null;


    $args = array(
        'post_type' => 'noticia',
        'posts_per_page' => -1,
        's' =>  $dados->search,
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'tipos-publicacoes',
                'field' => 'slug',
                'terms' => $dados->tipo,
                'operator' => is_null($dados->tipo) ? 'NOT IN' : 'IN'
            ),
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $dados->category,
                'operator' => is_null($dados->category) ? 'NOT IN' : 'IN'
            )
        ),
        'date_query' => array(
            array(
                'after'     => $dados->de,
                'before'    => $dados->ate,
                'inclusive' => true,
            ),
        )
    );

    $response = get_template_part('/parts/publications/content', 'publications', $args);

    echo $response;

    die();
}


add_action('wp_ajax_filter_publications', 'filter_publications');
add_action('wp_ajax_nopriv_filter_publications', 'filter_publications'); // not really needed