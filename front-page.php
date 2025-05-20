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
<style>
 .btn-warning {
    background-color: #F1BE1B !important;
    border-color: #F1BE1B !important;
    color: white !important;
}

.btn-warning:hover {
    background-color: #d1a800 !important;
    border-color: #d1a800 !important;
}
</style>

<section class="hero-section bg-dark position-relative overflow-hidden">
  <div class="position-absolute top-0 start-0 w-100 h-100"
    style="background: linear-gradient(45deg, rgba(49,47,47,0.9) 0%, rgba(241,190,27,0.1) 100%);"></div>
  <div class="container py-4 position-relative">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="display-4 fw-bold mb-3 text-light animate__animated animate__fadeInDown">Te ajudo a conquistar seu
          novo lar</h1>
        <p class="lead mb-4 text-light animate__animated animate__fadeInUp">Compra, venda e aluguel de imóveis na região
          do Cariri. Com mais de 5 anos de
          experiência no mercado imobiliário local.</p>
        <div class="d-flex align-items-center mb-4 animate__animated animate__fadeInLeft">
          <span class="d-inline-block mr-3 fs-5">
            <i class="fas fa-certificate text-warning"></i>
          </span>
          <p class="mb-0 fw-bold text-light">Regiane Nunes - Corretora de Imóveis CRECI 17.214</p>
        </div>
        <div class="d-flex flex-wrap animate__animated animate__fadeInUp">
          <a href="<?php echo esc_url(home_url('/imoveis')); ?>" class="btn btn-warning btn-lg px-4 mr-2 mb-2">
            <i class="fas fa-home mr-2"></i> Ver Imóveis
          </a>
          <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588988779576')); ?>?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
            class="btn btn-outline-light btn-lg px-4 mb-2" target="_blank">
            <i class="fab fa-whatsapp mr-2"></i> Fale Comigo
          </a>
        </div>
      </div>
      <div class="col-lg-6 animate__animated animate__fadeInRight">
        <div class="position-relative">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/regiane-corretora.jpeg"
            style="max-height: 500px; width: auto;" alt="Regiane Nunes Corretora" class="img-fluid rounded shadow">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Seção Serviços -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-dark animate__animated animate__fadeInDown">Como posso ajudar você</h2>
      <p class="text-muted animate__animated animate__fadeInUp">Serviços especializados para atender todas as suas
        necessidades imobiliárias</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4 animate__animated animate__fadeInLeft">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition">
          <div class="card-body text-center p-4">
            <div class="rounded-circle bg-dark p-3 d-inline-flex mb-3">
              <i class="fas fa-home fa-2x text-warning"></i>
            </div>
            <h3 class="h5 text-dark">Compra e Venda</h3>
            <p class="text-muted">Assessoria completa na compra ou venda do seu imóvel, com avaliação personalizada e
              negociação especializada.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 animate__animated animate__fadeInUp">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition">
          <div class="card-body text-center p-4">
            <div class="rounded-circle bg-dark p-3 d-inline-flex mb-3">
              <i class="fas fa-key fa-2x text-warning"></i>
            </div>
            <h3 class="h5 text-dark">Aluguel</h3>
            <p class="text-muted">Encontre o imóvel ideal para alugar ou tenha seu imóvel administrado com segurança e
              tranquilidade.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 animate__animated animate__fadeInRight">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition">
          <div class="card-body text-center p-4">
            <div class="rounded-circle bg-dark p-3 d-inline-flex mb-3">
              <i class="fas fa-hand-holding-usd fa-2x text-warning"></i>
            </div>
            <h3 class="h5 text-dark">Consultoria</h3>
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
      <h2 class="fw-bold text-dark animate__animated animate__fadeInDown">Imóveis em Destaque</h2>
      <p class="text-muted animate__animated animate__fadeInUp">Seleção especial de oportunidades disponíveis na região
        do Cariri</p>
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

    <div class="text-center mt-4 animate__animated animate__fadeInUp">
      <a href="<?php echo esc_url(home_url('/imoveis')); ?>" class="btn btn-warning btn-lg">
        Ver todos os imóveis
      </a>
    </div>
  </div>
</section>

<!-- Seção Experiência -->
<section class="bg-dark position-relative overflow-hidden">
  <div class="position-absolute top-0 start-0 w-100 h-100"
    style="background: linear-gradient(45deg, rgba(49,47,47,0.95) 0%, rgba(241,190,27,0.15) 100%);"></div>
  <div class="container position-relative py-5">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
        <div class="p-4 bg-white rounded-lg shadow-lg">
          <span class="badge bg-warning text-dark mb-2">CRECI 17.214</span>
          <h2 class="fw-bold mb-3 text-dark display-5">Expertise e Credibilidade no Mercado Imobiliário</h2>
          <p class="lead text-primary fw-bold mb-2">Mais de 5 anos transformando sonhos em realidade no Cariri</p>
          <p class="text-muted mb-3">Escolher a Regiane Nunes como sua corretora significa contar com uma profissional
            que
            conhece profundamente
            o mercado imobiliário da região do Cariri. Minha missão é proporcionar uma experiência de compra, venda ou
            aluguel tranquila e satisfatória.</p>
          <ul class="list-unstyled mb-3">
            <li class="d-flex align-items-center mb-2">
              <span class="bg-warning rounded-circle p-2 mr-3 d-flex align-items-center"><i
                  class="fas fa-check text-dark"></i></span>
              <span class="fw-semibold">Corretora credenciada com experiência comprovada</span>
            </li>
            <li class="d-flex align-items-center mb-2">
              <span class="bg-warning rounded-circle p-2 mr-3 d-flex align-items-center"><i
                  class="fas fa-map-marker-alt text-dark"></i></span>
              <span class="fw-semibold">Especialista no mercado imobiliário do Cariri</span>
            </li>
            <li class="d-flex align-items-center">
              <span class="bg-warning rounded-circle p-2 mr-3 d-flex align-items-center"><i
                  class="fas fa-heart text-dark"></i></span>
              <span class="fw-semibold">Atendimento personalizado e humanizado</span>
            </li>
          </ul>
          <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="btn btn-warning btn-lg mt-3 shadow-sm">
            <i class="fas fa-user-tie me-2"></i>Conheça minha história
          </a>
        </div>
      </div>
      <div class="col-lg-6 animate__animated animate__fadeInRight">
        <div class="row g-4">
          <div class="col-6 mb-4">
            <div class="card h-100 border-0 shadow-lg text-center hover-scale transition bg-white">
              <div class="card-body py-4">
                <i class="fas fa-clock text-warning mb-3 fa-2x"></i>
                <div class="display-4 fw-bold text-dark mb-2">5+</div>
                <p class="text-dark mb-0 fw-bold">Anos de experiência</p>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card h-100 border-0 shadow-lg text-center hover-scale transition bg-white">
              <div class="card-body py-4">
                <i class="fas fa-smile-beam text-warning mb-3 fa-2x"></i>
                <div class="display-4 fw-bold text-dark mb-2">100+</div>
                <p class="text-dark mb-0 fw-bold">Clientes satisfeitos</p>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card h-100 border-0 shadow-lg text-center hover-scale transition bg-white">
              <div class="card-body py-4">
                <i class="fas fa-home text-warning mb-3 fa-2x"></i>
                <div class="display-4 fw-bold text-dark mb-2">200+</div>
                <p class="text-dark mb-0 fw-bold">Imóveis negociados</p>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card h-100 border-0 shadow-lg text-center hover-scale transition bg-white">
              <div class="card-body py-4">
                <i class="fas fa-city text-warning mb-3 fa-2x"></i>
                <div class="display-4 fw-bold text-dark mb-2">10+</div>
                <p class="text-dark mb-0 fw-bold">Cidades atendidas</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Seção Qualidades -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-dark animate__animated animate__fadeInDown">Por que escolher a Regiane como sua corretora?
      </h2>
      <p class="text-muted animate__animated animate__fadeInUp">Experiência, dedicação e resultados comprovados no
        mercado imobiliário do Cariri</p>
    </div>

    <div class="row g-4">
      <div class="col-lg-4 animate__animated animate__fadeInLeft">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition">
          <div class="card-body p-4">
            <div class="rounded-circle bg-warning p-3 d-inline-flex mb-3">
              <i class="fas fa-award fa-2x text-dark"></i>
            </div>
            <h3 class="h5 text-dark">Profissionalismo Certificado</h3>
            <p class="text-muted">Corretora credenciada CRECI 17.214 com mais de 5 anos de experiência no mercado
              imobiliário do Cariri. Atualização constante e conhecimento profundo do mercado local.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 animate__animated animate__fadeInUp">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition">
          <div class="card-body p-4">
            <div class="rounded-circle bg-warning p-3 d-inline-flex mb-3">
              <i class="fas fa-handshake fa-2x text-dark"></i>
            </div>
            <h3 class="h5 text-dark">Atendimento Personalizado</h3>
            <p class="text-muted">Acompanhamento exclusivo em todas as etapas da negociação. Disponibilidade total para
              atender suas necessidades e encontrar o imóvel ideal para você.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 animate__animated animate__fadeInRight">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition">
          <div class="card-body p-4">
            <div class="rounded-circle bg-warning p-3 d-inline-flex mb-3">
              <i class="fas fa-check-circle fa-2x text-dark"></i>
            </div>
            <h3 class="h5 text-dark">Resultados Comprovados</h3>
            <p class="text-muted">Mais de 200 imóveis negociados com sucesso e centenas de clientes satisfeitos. Ampla
              rede de contatos e as melhores oportunidades do mercado.</p>
          </div>
        </div>
      </div>

      <div class="col-12 text-center mt-4 animate__animated animate__fadeInUp">
        <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588988779576')); ?>?text=Olá%20Regiane,%20gostaria%20de%20conhecer%20mais%20sobre%20seu%20trabalho"
          class="btn btn-warning btn-lg px-5 shadow-sm d-inline-block text-break" target="_blank" style="white-space: normal;">
          <i class="fab fa-whatsapp mr-2"></i>
          Fale com a Regiane agora mesmo
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Seção Contato -->
<section class="bg-dark text-light position-relative overflow-hidden">
  <div class="position-absolute top-0 start-0 w-100 h-100"
    style="background: linear-gradient(45deg, rgba(49,47,47,0.9) 0%, rgba(241,190,27,0.1) 100%);"></div>
  <div class="container position-relative py-5">
    <div class="row align-items-center"> 
      <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
        <h2 class="fw-bold mb-4">Vamos conversar sobre seu próximo imóvel?</h2>
        <p class="lead mb-4">Entre em contato para um atendimento personalizado e descubra as melhores oportunidades na
          região do Cariri.</p>

        <div class="d-flex align-items-center mb-3">
          <span class="bg-warning p-2 rounded mr-3">
            <i class="fas fa-phone-alt text-dark"></i>
          </span>
          <div>
            <p class="mb-0"><?php echo esc_html(get_option('regiane_phone', '(88) 98877-9576')); ?></p>
          </div>
        </div>

        <div class="d-flex align-items-center mb-3">
          <span class="bg-warning p-2 rounded mr-3">
            <i class="fas fa-envelope text-dark"></i>
          </span>
          <div>
            <p class="mb-0"><?php echo esc_html(get_option('regiane_email', 'regiane-nunes76@hotmail.com')); ?></p>
          </div>
        </div>

        <div class="d-flex align-items-center mb-4">
          <span class="bg-warning p-2 rounded mr-3">
            <i class="fas fa-map-marker-alt text-dark"></i>
          </span>
          <div>
            <p class="mb-0">Região do Cariri - Ceará</p>
          </div>
        </div>

        <div class="d-flex">
          <a href="https://www.instagram.com/regianenunescorretora/" class="btn btn-light mr-2" target="_blank">
            <i class="fab fa-instagram"></i> Instagram
          </a>
          <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588988779576')); ?>?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
            class="btn btn-light" target="_blank">
            <i class="fab fa-whatsapp"></i> WhatsApp
          </a>
        </div>
      </div>

      <div class="col-lg-6 animate__animated animate__fadeInRight">
        <div class="card border-0 shadow-lg hover-shadow transition">
          <div class="card-body p-4" style="justify-items: center;">
            <h3 class="text-dark mb-4">Envie sua mensagem</h3>

            <?php echo do_shortcode('[wpforms id="39"]'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>