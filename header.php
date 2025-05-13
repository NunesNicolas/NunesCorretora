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
      --accent-color: #d4c68c;
      --navbar-bg: #4a4a4a;
    }

    body {
      font-family: 'Poppins', sans-serif;
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
      background-color: var(--gray-color) !important;
      border-color: var(--gray-color) !important;
      color: var(--white-color) !important;
    }

    .btn-primary:hover {
      background-color: var(--dark-gray) !important;
      border-color: var(--dark-gray) !important;
      color: var(--white-color) !important;
    }

    .btn-outline-primary {
      color: var(--gray-color) !important;
      border-color: var(--gray-color) !important;
    }

    .btn-outline-primary:hover {
      background-color: var(--gray-color) !important;
      border-color: var(--gray-color) !important;
      color: var(--white-color) !important;
    }

    #main-header {
      background-color: var(--gray-color);
      padding-top: 1rem;
      padding-bottom: 1rem;
    }

    #logo-header {
      max-height: 60px;
    }

    main {
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

    .navbar {
      background-color: var(--navbar-bg) !important;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 1.5rem 0;
    }

    .navbar-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }

    .navbar-brand {
      padding: 0;
      margin-right: 3rem;
    }

    .navbar-brand img {
      max-height: 60px;
      width: auto;
    }

    .navbar-nav {
      gap: 2.5rem;
      margin-right: 3rem;
    }

    .navbar-nav .nav-link {
      color: var(--white-color) !important;
      font-weight: 500;
      padding: 0.5rem 1rem;
      font-size: 1rem;
      transition: color 0.3s ease;
      position: relative;
    }

    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background-color: var(--primary-color);
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .navbar-nav .nav-link:hover::after {
      width: 100%;
    }

    .navbar-nav .nav-link:hover {
      color: var(--primary-color) !important;
    }

    .navbar-nav .nav-link.active {
      color: var(--primary-color) !important;
    }

    .navbar-nav .nav-link.active::after {
      width: 100%;
    }

    .top-bar {
      background-color: var(--gray-color);
      color: var(--white-color);
      padding: 0.5rem 0;
      font-size: 0.9rem;
    }

    .top-bar a {
      color: var(--white-color);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .top-bar a:hover {
      color: var(--primary-color);
    }

    .social-icons a {
      font-size: 1.1rem;
      margin-left: 1rem;
    }

    .btn-whatsapp {
      background-color: var(--primary-color) !important;
      color: var(--gray-color) !important;
      border: none;
      padding: 0.75rem 2rem;
      border-radius: 4px;
      font-weight: 500;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .btn-whatsapp:hover {
      background-color: var(--accent-color) !important;
      color: var(--gray-color) !important;
      transform: translateY(-2px);
    }

    @media (max-width: 991.98px) {
      .navbar-container {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar-brand {
        margin-right: 0;
        margin-bottom: 1rem;
      }

      .navbar-nav {
        gap: 1rem;
        padding: 1rem 0;
        margin-right: 0;
        width: 100%;
      }

      .btn-whatsapp {
        width: 100%;
        margin-top: 1rem;
      }
    }
  </style>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="site-header">
    <div class="top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <a href="https://wa.me/5588988779576?text=Olá%20Regiane,%20estou%20em%20contato%20contigo%20por%20meio%20do%20site"
                class="text-white text-decoration-none" target="_blank"><span class="mr-3"><i
                    class="fas fa-phone-alt mr-2"></i>(88) 98877-9576</span></a>
              <span><i
                  class="fas fa-envelope mr-2"></i><?php echo esc_html(get_option('regiane_email', 'regiane-nunes76@hotmail.com')); ?></span>
            </div>
          </div>
          <div class="col-md-6 d-flex justify-content-end">
            <div class="social-icons">
              <a href="https://www.instagram.com/regianenunescorretora/" class="text-white" target="_blank">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="https://wa.me/5588988779576?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
                class="text-white" target="_blank">
                <i class="fab fa-whatsapp"></i>
              </a>
              <span class="ml-3 text-white-50"><i class="fas fa-id-card mr-2"></i>CRECI 17.214</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Regiane Nunes Corretora">
          </a>




          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>"
                  href="<?php echo esc_url(home_url('/')); ?>">Início</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo is_page('sobre') ? 'active' : ''; ?>"
                  href="<?php echo esc_url(home_url('/sobre')); ?>">Sobre Nós</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo is_page('imoveis') ? 'active' : ''; ?>"
                  href="<?php echo esc_url(home_url('/imoveis')); ?>">Imóveis</a>
              </li>
            </ul>
          </div>

          <a href="https://wa.me/5588988779576?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
            class="btn btn-whatsapp" target="_blank">
            <i class="fab fa-whatsapp mr-2"></i>Fale Comigo
          </a>
        </div>
      </div>
    </nav>
  </header>

  <div id="content" class="site-content">
    <main class="">