<?php get_header(); ?>

<!-- Verificar se as imagens existem, caso contrário usar placeholders
function image_exists($file_path) {
    // Usando o caminho do servidor em vez de file_exists
    return @getimagesize($file_path) !== false;
}

// Hero image
$hero_image_path = get_template_directory() . '/assets/images/hero-image.jpg';
$hero_image = (image_exists($hero_image_path)) 
    ? get_template_directory_uri() . '/assets/images/hero-image.jpg'
    : 'https://via.placeholder.com/1200x800?text=Imóveis+no+Ceará';

// Regiane image
$regiane_image_path = get_template_directory() . '/assets/images/regiane-corretora.jpeg';
$regiane_image = (image_exists($regiane_image_path)) 
    ? get_template_directory_uri() . '/assets/images/regiane-corretora.jpeg'
    : 'https://via.placeholder.com/600x400?text=Regiane+Corretora';

// Client images
$client1_image = image_exists(get_template_directory() . '/assets/images/client1.jpg')
    ? get_template_directory_uri() . '/assets/images/client1.jpg'
    : 'https://via.placeholder.com/50x50?text=C';

$client2_image = image_exists(get_template_directory() . '/assets/images/client2.jpg')
    ? get_template_directory_uri() . '/assets/images/client2.jpg'
    : 'https://via.placeholder.com/50x50?text=A';

$client3_image = image_exists(get_template_directory() . '/assets/images/client3.jpg')
    ? get_template_directory_uri() . '/assets/images/client3.jpg'
    : 'https://via.placeholder.com/50x50?text=R';
?>

<!-- Seção Hero -->
<section class="hero-section py-5 bg-primary">
  <div class="container py-4">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="display-4 fw-bold mb-3 text-gray">Te ajudo a conquistar seu novo lar</h1>
        <p class="lead mb-4 text-gray">Compra, venda e aluguel de imóveis na região do Cariri. Com mais de 5 anos de
          experiência no mercado imobiliário local.</p>
        <div class="d-flex align-items-center mb-4">
          <span class="d-inline-block me-3 fs-5">
            <i class="fas fa-certificate text-gray"></i>
          </span>
          <p class="mb-0 fw-bold text-gray">Regiane Nunes - Corretora de Imóveis CRECI 17.214</p>
        </div>
        <div class="d-flex flex-wrap">
          <a href="<?php echo esc_url(home_url('/imoveis')); ?>" class="btn btn-dark btn-lg px-4 me-2 mb-2">
            <i class="fas fa-home me-2"></i> Ver Imóveis
          </a>
          <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588999999999')); ?>?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
            class="btn btn-outline-dark btn-lg px-4 mb-2" target="_blank">
            <i class="fab fa-whatsapp me-2"></i> Fale Comigo
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="position-relative">
          <img src="<?php echo esc_url($regiane_image); ?>" alt="Regiane Nunes Corretora"
            class="img-fluid rounded shadow">
          <div class="position-absolute top-0 end-0 bg-primary p-3 rounded shadow-sm translate-middle-y">
            <p class="mb-0 fw-bold text-gray">📍 Região do Cariri</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Seção Serviços -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-gray">Como posso ajudar você</h2>
      <p class="text-muted">Serviços especializados para atender todas as suas necessidades imobiliárias</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="rounded-circle bg-primary p-3 d-inline-flex mb-3">
              <i class="fas fa-home fa-2x text-gray"></i>
            </div>
            <h3 class="h5 text-gray">Compra e Venda</h3>
            <p class="text-muted">Assessoria completa na compra ou venda do seu imóvel, com avaliação personalizada e
              negociação especializada.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="rounded-circle bg-primary p-3 d-inline-flex mb-3">
              <i class="fas fa-key fa-2x text-gray"></i>
            </div>
            <h3 class="h5 text-gray">Aluguel</h3>
            <p class="text-muted">Encontre o imóvel ideal para alugar ou tenha seu imóvel administrado com segurança e
              tranquilidade.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="rounded-circle bg-primary p-3 d-inline-flex mb-3">
              <i class="fas fa-hand-holding-usd fa-2x text-gray"></i>
            </div>
            <h3 class="h5 text-gray">Consultoria</h3>
            <p class="text-muted">Orientação especializada para investimentos imobiliários na região do Cariri, com
              análise de mercado e tendências.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Seção Destaques -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-gray">Imóveis em Destaque</h2>
      <p class="text-muted">Seleção especial de oportunidades disponíveis na região do Cariri</p>
    </div>

    <div class="row" id="featured-properties">
      <?php
      $destaques = new WP_Query(array(
        'post_type' => 'imovel',
        'posts_per_page' => 4,
        'meta_query' => array(
          array(
            'key' => 'destaque',
            'value' => '1',
            'compare' => '='
          )
        )
      ));

      if ($destaques->have_posts()):
        while ($destaques->have_posts()):
          $destaques->the_post();
          get_template_part('template-parts/content', 'imovel');
        endwhile;
        wp_reset_postdata();
      else:
        ?>
      <div class="col-12 text-center">
        <div class="alert alert-light border shadow-sm">
          <p class="mb-0">Em breve novos imóveis em destaque. Entre em contato para conhecer nossa oferta completa!</p>
        </div>
      </div>
      <?php
      endif;
      ?>
    </div>

    <div class="text-center mt-4">
      <a href="<?php echo esc_url(home_url('/imoveis')); ?>" class="btn btn-primary btn-lg">
        Ver todos os imóveis
      </a>
    </div>
  </div>
</section>

<!-- Seção Experiência -->
<section class="py-5 bg-primary">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="p-4 bg-white rounded shadow">
          <h2 class="fw-bold mb-4 text-gray">Expertise e Credibilidade</h2>
          <p class="lead">Com mais de 5 anos no mercado imobiliário do Cariri</p>
          <p>Escolher a Regiane Nunes como sua corretora significa contar com uma profissional que conhece profundamente
            o mercado imobiliário da região do Cariri. Minha missão é proporcionar uma experiência de compra, venda ou
            aluguel tranquila e satisfatória.</p>
          <ul class="list-unstyled mt-4">
            <li class="d-flex align-items-center mb-3">
              <span class="bg-primary rounded-circle p-2 me-3"><i class="fas fa-check text-gray"></i></span>
              <span>Corretora credenciada CRECI 17.214</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <span class="bg-primary rounded-circle p-2 me-3"><i class="fas fa-check text-gray"></i></span>
              <span>Especialista no mercado imobiliário do Cariri</span>
            </li>
            <li class="d-flex align-items-center">
              <span class="bg-primary rounded-circle p-2 me-3"><i class="fas fa-check text-gray"></i></span>
              <span>Atendimento personalizado e transparente</span>
            </li>
          </ul>
          <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="btn btn-primary mt-4">Conheça minha história</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row g-4">
          <div class="col-6">
            <div class="card h-100 border-0 shadow text-center">
              <div class="card-body py-4">
                <div class="display-4 fw-bold text-gray mb-2">5+</div>
                <p class="text-gray mb-0 fw-bold">Anos de experiência</p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card h-100 border-0 shadow text-center">
              <div class="card-body py-4">
                <div class="display-4 fw-bold text-gray mb-2">100+</div>
                <p class="text-gray mb-0 fw-bold">Clientes satisfeitos</p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card h-100 border-0 shadow text-center">
              <div class="card-body py-4">
                <div class="display-4 fw-bold text-gray mb-2">200+</div>
                <p class="text-gray mb-0 fw-bold">Imóveis negociados</p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card h-100 border-0 shadow text-center">
              <div class="card-body py-4">
                <div class="display-4 fw-bold text-gray mb-2">10+</div>
                <p class="text-gray mb-0 fw-bold">Cidades atendidas</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Seção Depoimentos -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-gray">O que dizem meus clientes</h2>
      <p class="text-muted">A satisfação de quem já realizou o sonho da casa própria</p>
    </div>

    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4 p-lg-5">
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="text-center">
                    <div class="mb-4">
                      <i class="fas fa-quote-left fa-3x text-primary"></i>
                    </div>
                    <p class="lead mb-4">A Regiane foi essencial na compra do meu primeiro imóvel. Sua dedicação e
                      conhecimento do mercado do Cariri fizeram toda a diferença. Recomendo a todos que buscam um
                      atendimento personalizado e profissional.</p>
                    <div class="d-flex justify-content-center">
                      <div>
                        <h5 class="mb-1">Maria Silva</h5>
                        <p class="text-muted mb-0">Comprou imóvel em Juazeiro do Norte</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="text-center">
                    <div class="mb-4">
                      <i class="fas fa-quote-left fa-3x text-primary"></i>
                    </div>
                    <p class="lead mb-4">Vendi meu apartamento com a ajuda da Regiane em tempo recorde. Sua estratégia
                      de divulgação e rede de contatos na região são impressionantes. Excelente trabalho!</p>
                    <div class="d-flex justify-content-center">
                      <div>
                        <h5 class="mb-1">João Santos</h5>
                        <p class="text-muted mb-0">Vendeu imóvel em Crato</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="text-center">
                    <div class="mb-4">
                      <i class="fas fa-quote-left fa-3x text-primary"></i>
                    </div>
                    <p class="lead mb-4">A Regiane me ajudou a encontrar o imóvel perfeito para investimento no Cariri.
                      Sua consultoria foi fundamental para que eu tomasse a decisão correta. Já estamos planejando novos
                      negócios!</p>
                    <div class="d-flex justify-content-center">
                      <div>
                        <h5 class="mb-1">Ana Oliveira</h5>
                        <p class="text-muted mb-0">Investidora imobiliária</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Seção Contato -->
<section class="py-5 bg-gray text-white">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h2 class="fw-bold mb-4">Vamos conversar sobre seu próximo imóvel?</h2>
        <p class="lead mb-4">Entre em contato para um atendimento personalizado e descubra as melhores oportunidades na
          região do Cariri.</p>

        <div class="d-flex align-items-center mb-3">
          <span class="bg-primary p-2 rounded me-3">
            <i class="fas fa-phone-alt text-gray"></i>
          </span>
          <div>
            <p class="mb-0"><?php echo esc_html(get_option('regiane_phone', '(XX) XXXX-XXXX')); ?></p>
          </div>
        </div>

        <div class="d-flex align-items-center mb-3">
          <span class="bg-primary p-2 rounded me-3">
            <i class="fas fa-envelope text-gray"></i>
          </span>
          <div>
            <p class="mb-0"><?php echo esc_html(get_option('regiane_email', 'contato@exemplo.com')); ?></p>
          </div>
        </div>

        <div class="d-flex align-items-center mb-4">
          <span class="bg-primary p-2 rounded me-3">
            <i class="fas fa-map-marker-alt text-gray"></i>
          </span>
          <div>
            <p class="mb-0">Região do Cariri - Ceará</p>
          </div>
        </div>

        <div class="d-flex">
          <a href="https://www.instagram.com/regianenunescorretora/" class="btn btn-light me-2" target="_blank">
            <i class="fab fa-instagram"></i> Instagram
          </a>
          <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588999999999')); ?>?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
            class="btn btn-light" target="_blank">
            <i class="fab fa-whatsapp"></i> WhatsApp
          </a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card border-0 shadow-lg">
          <div class="card-body p-4">
            <h3 class="text-dark mb-4">Envie sua mensagem</h3>
            <form>
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Nome completo">
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="E-mail">
              </div>
              <div class="mb-3">
                <input type="tel" class="form-control" placeholder="Telefone">
              </div>
              <div class="mb-3">
                <select class="form-select">
                  <option selected>Qual seu interesse?</option>
                  <option>Comprar imóvel</option>
                  <option>Vender imóvel</option>
                  <option>Alugar imóvel</option>
                  <option>Consultoria</option>
                </select>
              </div>
              <div class="mb-3">
                <textarea class="form-control" rows="4" placeholder="Sua mensagem"></textarea>
              </div>
              <button type="submit" class="btn btn-primary w-100">Enviar mensagem</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>