<?php
/**
 * Configuração da galeria de imagens para imóveis
 */

add_filter('rwmb_meta_boxes', 'regiane_register_galeria_meta_boxes');

function regiane_register_galeria_meta_boxes($meta_boxes)
{
  $meta_boxes[] = array(
    'title' => 'Galeria de Imagens',
    'post_types' => 'imovel',
    'fields' => array(
      array(
        'name' => 'Galeria de Imagens',
        'id' => 'galeria_imagens',
        'type' => 'image_advanced',
        'force_delete' => false,
        'max_file_uploads' => 20,
        'max_status' => true,
        'image_size' => 'thumbnail',
      ),
    ),
  );
  return $meta_boxes;
}