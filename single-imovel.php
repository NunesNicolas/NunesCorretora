<?php get_header(); ?>

<?php
$descricao = get_the_content(); // Obtém o conteúdo da descrição
$tem_aluguel = stripos($descricao, 'locação') !== false; // Verifica se a palavra "aluguel" está presente
?>

<section class="container py-5">
  <div class="row">
    <div class="col-lg-8">
      <h1 class="mb-4">
        <?php the_title(); ?>
        <?php if ($tem_aluguel): ?>
          - Aluguel
        <?php endif; ?>
      </h1>




      <?php if (has_post_thumbnail()): ?>
        <div class="imovel-single-image mb-4">
          <img src="<?php the_post_thumbnail_url('imovel-single'); ?>" alt="<?php the_title(); ?>"
            class="img-fluid rounded-3 shadow-sm">
        </div>
      <?php endif; ?>

      <?php
      // Galeria de imagens
      $galeria = rwmb_meta('galeria_imagens', array('size' => 'imovel-thumb'));
      if ($galeria): ?>
        <div class="imovel-gallery mb-4">
          <h3 class="h4 mb-3">Galeria de Imagens</h3>
          <div class="row g-3">
            <?php foreach ($galeria as $index => $imagem): ?>
              <div class="col-md-4">
                <a href="#" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal<?php echo $index; ?>">
                  <img src="<?php echo esc_url($imagem['url']); ?>" alt="<?php echo esc_attr($imagem['alt']); ?>"
                    class="img-fluid rounded-3 shadow-sm">
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Modais para cada imagem -->
        <?php foreach ($galeria as $index => $imagem): ?>
          <div class="modal fade" id="galleryModal<?php echo $index; ?>" tabindex="-1"
            aria-labelledby="galleryModalLabel<?php echo $index; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Fechar">
                    <i class="fas fa-times text-secondary"></i>
                  </button>
                </div>
                <div class="modal-body p-0">
                  <img src="<?php echo esc_url($imagem['full_url']); ?>" alt="<?php echo esc_attr($imagem['alt']); ?>"
                    class="img-fluid w-100">
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <div class="imovel-content mb-4 p-4 bg-light rounded shadow-sm">
        <h2 class="h4 mb-3 text-secondary">Descrição do Imóvel</h2>
        <div class="text-dark">
          <?php the_content(); ?>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <h3 class="card-title h4 mb-4 text-secondary">Informações do Imóvel</h3>

          <?php if ($price = get_post_meta(get_the_ID(), 'preco', true)): ?>
            <div class="price-box mb-4 p-3 bg-light rounded-3">
              <p class="price h3 mb-0 <?php echo $tem_aluguel ? 'text-warning' : 'text-success'; ?>">
                R$ <?php echo number_format($price, 2, ',', '.'); ?>
              </p>
            </div>
          <?php endif; ?>

          <ul class="list-group list-group-flush mb-4">
            <?php if ($area = get_post_meta(get_the_ID(), 'area', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-vector-square text-secondary mr-3"></i>
                <span>Área: <?php echo $area; ?> m²</span>
              </li>
            <?php endif; ?>

            <?php if ($quartos = get_post_meta(get_the_ID(), 'quartos', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-bed text-secondary mr-3"></i>
                <span>Quartos: <?php echo $quartos; ?></span>
              </li>
            <?php endif; ?>

            <?php if ($banheiros = get_post_meta(get_the_ID(), 'banheiros', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-bath text-secondary mr-3"></i>
                <span>Banheiros: <?php echo $banheiros; ?></span>
              </li>
            <?php endif; ?>

            <?php if ($garagem = get_post_meta(get_the_ID(), 'garagem', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-car text-secondary mr-3"></i>
                <span>vagas: <?php echo $garagem; ?></span>
              </li>
            <?php endif; ?>

            <?php if ($endereco = get_post_meta(get_the_ID(), 'endereco', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-map-marker-alt text-secondary mr-3"></i>
                <span>Endereço: <?php echo $endereco; ?></span>
              </li>
            <?php endif; ?>
          </ul>

          <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588988779576')); ?>?text=Olá%20Regiane,%20estou%20em%20contato%20contigo%20por%20meio%20do%20site"
            class="btn btn-warning btn-lg w-100 text-dark fw-bold" target="_blank">
            <i class="fab fa-whatsapp mr-2"></i> Entrar em contato
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>