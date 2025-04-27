<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <style>
    :root {
      --primary-color: #f1e2a6;
      --white-color: #ffffff;
      --gray-color: #4a4a4a;
      --light-gray: #f5f5f5;
      --dark-gray: #333333;
    }

    .bg-primary {
      background-color: var(--primary-color) !important;
    }

    .bg-gray {
      background-color: var(--gray-color) !important;
    }

    .text-primary {
      color: var(--primary-color) !important;
    }

    .text-gray {
      color: var(--gray-color) !important;
    }

    .btn-primary {
      background-color: var(--gray-color);
      border-color: var(--gray-color);
    }

    .btn-primary:hover {
      background-color: var(--dark-gray);
      border-color: var(--dark-gray);
    }

    .btn-outline-primary {
      color: var(--gray-color);
      border-color: var(--gray-color);
    }

    .btn-outline-primary:hover {
      background-color: var(--gray-color);
      border-color: var(--gray-color);
      color: white;
    }

    #main-header {
      background-color: var(--gray-color);
      padding-top: 1rem;
      padding-bottom: 1rem;
    }

    #logo-header {
      max-height: 60px;
    }

    main.py-4 {
      margin-top: 0;
      padding-top: 0 !important;
    }

    .icon-box {
      width: 70px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .page-header {
      background-color: var(--primary-color) !important;
      color: var(--gray-color) !important;
    }
  </style>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="site-header">
    <div class="top-bar bg-primary text-white py-2 d-none d-md-block">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <span class="me-3"><i
                  class="fas fa-phone-alt me-2"></i><?php echo esc_html(get_option('regiane_phone', '(XX) XXXX-XXXX')); ?></span>
              <span><i
                  class="fas fa-envelope me-2"></i><?php echo esc_html(get_option('regiane_email', 'contato@exemplo.com')); ?></span>
            </div>
          </div>
          <div class="col-md-6 text-end">
            <div class="social-icons">
              <a href="https://www.instagram.com/regianenunescorretora/" class="text-white me-3" target="_blank">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588999999999')); ?>?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
                class="text-white" target="_blank">
                <i class="fab fa-whatsapp"></i>
              </a>
              <span class="ms-3 text-white-50"><i class="fas fa-id-card me-2"></i>CRECI 17.214</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>">
          <?php
          $custom_logo_id = get_theme_mod('custom_logo');
          if ($custom_logo_id) {
            echo wp_get_attachment_image($custom_logo_id, 'full', false, array(
              'class' => 'img-fluid',
              'style' => 'max-height: 60px;',
              'alt' => 'Regiane Nunes Corretora'
            ));
          } else {
            echo '<h1 class="mb-0 text-primary">Regiane Nunes</h1>';
          }
          ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <?php
          if (has_nav_menu('primary')) {
            wp_nav_menu(array(
              'theme_location' => 'primary',
              'depth' => 2,
              'container' => false,
              'menu_class' => 'navbar-nav ms-auto',
              'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
              'walker' => new WP_Bootstrap_Navwalker()
            ));
          } else {
            // Menu padrão temporário enquanto o usuário não configura um menu
            echo '<ul class="navbar-nav ms-auto">';
            echo '<li class="nav-item"><a href="' . esc_url(home_url('/')) . '" class="nav-link">Início</a></li>';
            echo '<li class="nav-item"><a href="' . esc_url(home_url('/sobre')) . '" class="nav-link">Sobre</a></li>';
            echo '<li class="nav-item"><a href="' . esc_url(home_url('/imoveis')) . '" class="nav-link">Imóveis</a></li>';
            echo '</ul>';
          }
          ?>
          <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588999999999')); ?>?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
            class="btn btn-primary ms-lg-3" target="_blank">
            <i class="fab fa-whatsapp me-2"></i>Fale Comigo
          </a>
        </div>
      </div>
    </nav>
  </header>

  <div id="content" class="site-content">
    <main class="py-4">