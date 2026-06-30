<?php get_header(); ?>

<?php
$descricao = get_the_content();
$tem_aluguel = get_post_meta(get_the_ID(), 'tipo_negocio', true) === 'aluguel';
$galeria = function_exists('rwmb_meta') ? rwmb_meta('galeria_imagens', array('size' => 'imovel-carousel')) : array();
$carousel_images = array();
$carousel_seen = array();

if (has_post_thumbnail()) {
  $featured_full = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $featured_single = get_the_post_thumbnail_url(get_the_ID(), 'imovel-single');
  $carousel_images[] = array(
    'url' => $featured_single,
    'full' => $featured_full,
    'alt' => get_the_title(),
  );
  $carousel_seen[$featured_full] = true;
}

foreach ((array) $galeria as $imagem) {
  if (empty($imagem['url']) || isset($carousel_seen[$imagem['url']])) {
    continue;
  }

  $carousel_images[] = array(
    'url' => $imagem['url'],
    'full' => $imagem['url'],
    'alt' => !empty($imagem['alt']) ? $imagem['alt'] : get_the_title(),
  );
  $carousel_seen[$imagem['url']] = true;
}

if (preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $descricao, $content_images, PREG_SET_ORDER)) {
  foreach ($content_images as $content_image) {
    $image_html = $content_image[0];
    $image_url = $content_image[1];

    if (isset($carousel_seen[$image_url])) {
      continue;
    }

    $image_alt = get_the_title();
    if (preg_match('/alt=["\']([^"\']*)["\']/i', $image_html, $alt_match) && $alt_match[1] !== '') {
      $image_alt = $alt_match[1];
    }

    $carousel_images[] = array(
      'url' => $image_url,
      'full' => $image_url,
      'alt' => $image_alt,
    );
    $carousel_seen[$image_url] = true;
  }
}

$tem_imagens = !empty($carousel_images);
?>

<style>
  .imovel-carousel {
    width: 100%;
    height: 500px;
    background-color: black;
    position: relative;
    margin-bottom: 2rem;
  }

  .swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }

  .swiper-slide::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: var(--bg-image);
    background-size: cover;
    background-position: center;
    filter: blur(20px);
    transform: scale(1.1);
    z-index: 1;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .swiper-slide-active::before {
    opacity: 1;
  }

  .swiper-slide img {
    position: relative;
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    z-index: 2;
  }

  .swiper-button-next,
  .swiper-button-prev {
    color: white;
    background: rgba(0, 0, 0, 0.5);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    z-index: 3;
  }

  .swiper-button-next:after,
  .swiper-button-prev:after {
    font-size: 20px;
  }

  .swiper-button-next:hover,
  .swiper-button-prev:hover {
    background: rgba(0, 0, 0, 0.8);
  }

  .swiper-pagination-bullet {
    background: white;
    opacity: 0.5;
    z-index: 3;
  }

  .swiper-pagination-bullet-active {
    opacity: 1;
  }

  .property-modal-body {
    align-items: center;
    background: #111;
    display: flex;
    justify-content: center;
    min-height: 60vh;
    position: relative;
  }

  .property-modal-body img {
    max-height: 82vh;
    object-fit: contain;
  }

  .property-modal-nav {
    align-items: center;
    background: rgba(0, 0, 0, 0.55);
    border: 0;
    border-radius: 999px;
    color: #fff;
    display: flex;
    height: 44px;
    justify-content: center;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    z-index: 5;
  }

  .property-modal-nav:hover {
    background: rgba(0, 0, 0, 0.8);
  }

  .property-modal-prev {
    left: 16px;
  }

  .property-modal-next {
    right: 16px;
  }

  .property-modal-counter {
    color: #fff;
    font-weight: 700;
    left: 50%;
    position: absolute;
    top: 14px;
    transform: translateX(-50%);
    z-index: 5;
  }

  @media (max-width: 768px) {
    .imovel-carousel {
      height: 300px;
    }

    .property-modal-body {
      min-height: 55vh;
    }
  }
</style>

<section class="container py-5">
  <div class="row">
    <div class="col-lg-7">
      <h1 class="mb-4">
        <?php the_title(); ?>
        <?php if ($tem_aluguel): ?>
          - Aluguel
        <?php endif; ?>
      </h1>

      <?php if ($tem_imagens): ?>
        <div class="imovel-carousel">
          <div class="swiper">
            <div class="swiper-wrapper">
              <?php foreach ($carousel_images as $index => $imagem): ?>
                <div class="swiper-slide" style="--bg-image: url('<?php echo esc_url($imagem['full']); ?>')">
                  <img src="<?php echo esc_url($imagem['url']); ?>" alt="<?php echo esc_attr($imagem['alt']); ?>"
                    data-bs-toggle="modal" data-bs-target="#imageModal"
                    data-bs-image="<?php echo esc_url($imagem['full']); ?>"
                    data-bs-index="<?php echo esc_attr($index); ?>">
                </div>
              <?php endforeach; ?>
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper === 'undefined') {
              return;
            }

            const swiper = new Swiper('.swiper', {
              effect: 'fade',
              fadeEffect: {
                crossFade: true
              },
              loop: true,
              autoplay: {
                delay: 5000,
                disableOnInteraction: false,
              },
              pagination: {
                el: '.swiper-pagination',
                clickable: true,
              },
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
            });
          });
        </script>
      <?php else: ?>
        <div class="imovel-carousel imovel-carousel-placeholder">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>"
            alt="<?php echo esc_attr(get_the_title()); ?>">
        </div>
      <?php endif; ?>

      <!-- Modal -->
      <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body p-0 property-modal-body">
              <span id="modalImageCounter" class="property-modal-counter"></span>
              <button type="button" class="property-modal-nav property-modal-prev" id="modalImagePrev" aria-label="Imagem anterior">
                <i class="fas fa-chevron-left"></i>
              </button>
              <img id="modalImage" src="" class="img-fluid w-100" alt="Imagem ampliada">
              <button type="button" class="property-modal-nav property-modal-next" id="modalImageNext" aria-label="Próxima imagem">
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const imageModal = document.getElementById('imageModal');
          const modalImage = document.getElementById('modalImage');
          const modalCounter = document.getElementById('modalImageCounter');
          const modalPrev = document.getElementById('modalImagePrev');
          const modalNext = document.getElementById('modalImageNext');
          const carouselImages = document.querySelectorAll('.swiper-slide img');
          const modalImages = Array.from(carouselImages).map(image => ({
            src: image.getAttribute('data-bs-image'),
            alt: image.getAttribute('alt') || 'Imagem ampliada'
          }));
          let currentModalIndex = 0;

          function showModalImage(index) {
            if (!modalImages.length) {
              return;
            }

            currentModalIndex = (index + modalImages.length) % modalImages.length;
            modalImage.setAttribute('src', modalImages[currentModalIndex].src);
            modalImage.setAttribute('alt', modalImages[currentModalIndex].alt);

            if (modalCounter) {
              modalCounter.textContent = (currentModalIndex + 1) + ' / ' + modalImages.length;
            }
          }

          carouselImages.forEach(image => {
            image.addEventListener('click', function () {
              showModalImage(Number(this.getAttribute('data-bs-index') || 0));
            });
          });

          if (modalPrev) {
            modalPrev.addEventListener('click', function () {
              showModalImage(currentModalIndex - 1);
            });
          }

          if (modalNext) {
            modalNext.addEventListener('click', function () {
              showModalImage(currentModalIndex + 1);
            });
          }

          document.addEventListener('keydown', function (event) {
            if (!imageModal || !imageModal.classList.contains('show')) {
              return;
            }

            if (event.key === 'ArrowLeft') {
              showModalImage(currentModalIndex - 1);
            }

            if (event.key === 'ArrowRight') {
              showModalImage(currentModalIndex + 1);
            }
          });
        });
      </script>

    </div>

    <div class="col-lg-5">
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
                <span>Área: <?php echo esc_html($area); ?> m²</span>
              </li>
            <?php endif; ?>

            <?php if ($quartos = get_post_meta(get_the_ID(), 'quartos', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-bed text-secondary mr-3"></i>
                <span>Quartos: <?php echo esc_html($quartos); ?></span>
              </li>
            <?php endif; ?>

            <?php if ($banheiros = get_post_meta(get_the_ID(), 'banheiros', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-bath text-secondary mr-3"></i>
                <span>Banheiros: <?php echo esc_html($banheiros); ?></span>
              </li>
            <?php endif; ?>

            <?php if ($garagem = get_post_meta(get_the_ID(), 'garagem', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-car text-secondary mr-3"></i>
                <span>Vagas: <?php echo esc_html($garagem); ?></span>
              </li>
            <?php endif; ?>

            <?php if ($endereco = get_post_meta(get_the_ID(), 'endereco', true)): ?>
              <li class="list-group-item d-flex align-items-center border-0 py-3">
                <i class="fas fa-map-marker-alt text-secondary mr-3"></i>
                <span>Endereço: <?php echo esc_html($endereco); ?></span>
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
