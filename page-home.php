<?php
/**
 * Template Name: Home
 */
get_header();
?>

<style>
  :root {
    --primary-color: #f1e2a6;
    --white-color: #ffffff;
    --gray-color: #4a4a4a;
    --light-gray: #f5f5f5;
    --dark-gray: #333333;
    --accent-color: #d4c68c;
  }

  .hero-section {
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/regiana-corretora.jpeg');
    background-size: cover;
    background-position: center;
    min-height: 80vh;
    position: relative;
    display: flex;
    align-items: center;
  }

  .hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
  }

  .hero-content {
    position: relative;
    z-index: 1;
    color: var(--white-color);
  }

  .hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: var(--primary-color);
  }

  .hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    color: var(--white-color);
  }

  .btn-custom {
    background-color: var(--primary-color);
    color: var(--gray-color);
    border: none;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 500;
    border-radius: 4px;
    transition: all 0.3s ease;
  }

  .btn-custom:hover {
    background-color: var(--accent-color);
    color: var(--gray-color);
    transform: translateY(-2px);
  }

  .feature-section {
    padding: 5rem 0;
    background-color: var(--light-gray);
  }

  .feature-card {
    background: var(--white-color);
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
  }

  .feature-card:hover {
    transform: translateY(-5px);
  }

  .feature-icon {
    width: 80px;
    height: 80px;
    background-color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
  }

  .feature-icon i {
    font-size: 2rem;
    color: var(--gray-color);
  }

  .feature-title {
    color: var(--gray-color);
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
  }

  .feature-text {
    color: var(--dark-gray);
    line-height: 1.6;
  }

  .properties-section {
    padding: 5rem 0;
  }

  .section-title {
    color: var(--gray-color);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 3rem;
    text-align: center;
  }

  .property-card {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
  }

  .property-image {
    height: 250px;
    object-fit: cover;
  }

  .property-content {
    padding: 1.5rem;
  }

  .property-title {
    color: var(--gray-color);
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .property-price {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  .property-details {
    color: var(--dark-gray);
    margin-bottom: 1rem;
  }

  .property-details i {
    color: var(--primary-color);
    margin-right: 0.5rem;
  }

  .contact-section {
    background-color: var(--gray-color);
    color: var(--white-color);
    padding: 5rem 0;
  }

  .contact-title {
    color: var(--primary-color);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
  }

  .contact-text {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
  }

  .contact-info {
    margin-bottom: 2rem;
  }

  .contact-info i {
    color: var(--primary-color);
    margin-right: 1rem;
    font-size: 1.2rem;
  }

  .navbar {
    padding: 1rem 0;
  }

  .navbar-nav {
    gap: 2rem;
  }

  .navbar-brand img {
    max-height: 60px;
  }
</style>

<!-- Hero Section -->
<section class="hero-section">
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="hero-content">
          <h1 class="hero-title">Encontre o Imóvel dos Seus Sonhos</h1>
          <p class="hero-subtitle">Com a experiência e dedicação da Regiane Nunes, sua corretora de confiança</p>
          <a href="#properties" class="btn btn-custom">Ver Imóveis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="feature-section">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-home"></i>
          </div>
          <h3 class="feature-title">Imóveis Selecionados</h3>
          <p class="feature-text">Trabalhamos apenas com os melhores imóveis do mercado, garantindo qualidade e
            satisfação.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h3 class="feature-title">Atendimento Personalizado</h3>
          <p class="feature-text">Oferecemos um atendimento exclusivo, entendendo suas necessidades e expectativas.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3 class="feature-title">Segurança e Confiança</h3>
          <p class="feature-text">Toda a transação é realizada com total segurança e transparência.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Properties Section -->
<section class="properties-section" id="properties">
  <div class="container">
    <h2 class="section-title">Imóveis em Destaque</h2>
    <div class="row">
      <?php
      $args = array(
        'post_type' => 'imovel',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
      );
      $query = new WP_Query($args);
      if ($query->have_posts()):
        while ($query->have_posts()):
          $query->the_post();
          ?>
          <div class="col-md-4">
            <div class="property-card">
              <?php if (has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="property-image w-100">
              <?php endif; ?>
              <div class="property-content">
                <h3 class="property-title"><?php the_title(); ?></h3>
                <div class="property-price">R$ <?php echo number_format(get_field('preco'), 2, ',', '.'); ?></div>
                <div class="property-details">
                  <p><i class="fas fa-bed"></i> <?php echo get_field('quartos'); ?> Quartos</p>
                  <p><i class="fas fa-bath"></i> <?php echo get_field('banheiros'); ?> Banheiros</p>
                  <p><i class="fas fa-ruler-combined"></i> <?php echo get_field('area'); ?> m²</p>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-custom w-100">Ver Detalhes</a>
              </div>
            </div>
          </div>
          <?php
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="contact-title">Entre em Contato</h2>
        <p class="contact-text">Estamos prontos para ajudar você a encontrar o imóvel perfeito. Entre em contato conosco
          e agende uma visita.</p>
        <div class="contact-info">
          <p><i class="fas fa-phone-alt"></i> (88) 98877-9576</p>
          <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_option('regiane_email', 'regiane-nunes76@hotmail.com ')); ?>
          </p>
          <p><i class="fas fa-map-marker-alt"></i>
            <?php echo esc_html(get_option('regiane_address', 'Endereço da Corretora')); ?></p>
        </div>
        <a href="https://wa.me/5588988779576?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
          class="btn btn-custom" target="_blank">
          <i class="fab fa-whatsapp me-2"></i>Fale Conosco
        </a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>