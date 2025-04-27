<?php
/**
 * Template part para exibir os imóveis
 */
function image_exists_imovel($file_path)
{
  // Usando o caminho do servidor em vez de file_exists
  return @getimagesize($file_path) !== false;
}

$placeholder_image_path = get_template_directory() . '/assets/images/placeholder.jpg';
$placeholder_image = image_exists_imovel($placeholder_image_path)
  ? get_template_directory_uri() . '/assets/images/placeholder.jpg'
  : 'https://via.placeholder.com/400x300?text=Imagem+não+disponível';
?>

<div class="col-md-6 mb-4">
  <div class="card h-100">
    <?php if (has_post_thumbnail()): ?>
      <a href="<?php the_permalink(); ?>">
        <img src="<?php the_post_thumbnail_url('imovel-thumb'); ?>" alt="<?php the_title(); ?>" class="card-img-top">
      </a>
    <?php else: ?>
      <img src="<?php echo esc_url($placeholder_image); ?>" alt="<?php the_title(); ?>" class="card-img-top">
    <?php endif; ?>

    <div class="card-body">
      <h5 class="card-title">
        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
          <?php the_title(); ?>
        </a>
      </h5>

      <?php if ($preco = get_post_meta(get_the_ID(), 'preco', true)): ?>
        <p class="card-text text-success fw-bold">R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
      <?php endif; ?>

      <div class="d-flex justify-content-between mb-3">
        <?php if ($area = get_post_meta(get_the_ID(), 'area', true)): ?>
          <small><i class="fas fa-vector-square me-1"></i> <?php echo $area; ?> m²</small>
        <?php endif; ?>

        <?php if ($quartos = get_post_meta(get_the_ID(), 'quartos', true)): ?>
          <small><i class="fas fa-bed me-1"></i> <?php echo $quartos; ?> quarto(s)</small>
        <?php endif; ?>

        <?php if ($banheiros = get_post_meta(get_the_ID(), 'banheiros', true)): ?>
          <small><i class="fas fa-bath me-1"></i> <?php echo $banheiros; ?> banheiro(s)</small>
        <?php endif; ?>
      </div>

      <?php the_excerpt(); ?>

      <a href="<?php the_permalink(); ?>" class="btn btn-primary">Ver detalhes</a>
    </div>
  </div>
</div>