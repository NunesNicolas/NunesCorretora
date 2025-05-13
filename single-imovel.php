<?php get_header(); ?>

<?php
$descricao = get_the_content(); 
$tem_aluguel = get_post_meta(get_the_ID(), 'tipo_negocio', true) === 'aluguel'; 
?>

<style>
.carousel-inner {
  height: 40vh;
  background-color: black;
  display: flex;
  align-items: center; /* Centraliza verticalmente o conteúdo */
  justify-content: center;
}

.carousel-inner img {
  height: 100%;
  width: 100%;
  object-fit: contain;
  object-position: center;  
  background-color: black;
}
</style>

<section class="container py-5">
  <div class="row">
    <div class="col-lg-8">
      <h1 class="mb-4">
        <?php the_title(); ?>
        <?php if ($tem_aluguel): ?>
          - Aluguel
        <?php endif; ?>
      </h1>

      <?php if ($galeria = rwmb_meta('galeria_imagens', array('size' => 'imovel-thumb'))): ?>
        <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
          <ol class="carousel-indicators">
            <?php 
            $slide_index = 0; 
            if (has_post_thumbnail()): ?>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
              <?php $slide_index++; ?>
            <?php endif; ?>
            <?php foreach ($galeria as $index => $imagem): ?>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $slide_index; ?>" class=""></li>
              <?php $slide_index++; ?>
            <?php endforeach; ?>
          </ol>
          <div class="carousel-inner">
            <!-- Primeira imagem: Imagem destacada -->
            <?php if (has_post_thumbnail()): ?>
              <div class="carousel-item active">
                <img class="d-block w-100" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'imovel-single')); ?>" alt="<?php the_title(); ?>" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
              </div>
            <?php endif; ?>

            <!-- Demais imagens da galeria -->
            <?php foreach ($galeria as $index => $imagem): ?>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo esc_url($imagem['url']); ?>" alt="<?php echo esc_attr($imagem['alt']); ?>" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="<?php echo esc_url($imagem['url']); ?>">
              </div>
            <?php endforeach; ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
          </a>
        </div>
      <?php endif; ?>

      <!-- Modal -->
      <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body p-0">
              <img id="modalImage" src="" class="img-fluid w-100" alt="Imagem ampliada">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const modalImage = document.getElementById('modalImage');
          const carouselImages = document.querySelectorAll('.carousel-item img');

          carouselImages.forEach(image => {
            image.addEventListener('click', function () {
              const imageUrl = this.getAttribute('data-bs-image');
              modalImage.setAttribute('src', imageUrl);
            });
          });
        });
      </script>

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