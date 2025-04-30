<?php
/**
 * Template Name: Página Sobre
 */
get_header();

// Verificar se as imagens existem, caso contrário usar placeholders
function image_exists_sobre($file_path)
{
  // Usando o caminho do servidor em vez de file_exists
  return @getimagesize($file_path) !== false;
}

// Regiane image
$regiane_image = image_exists_sobre(get_template_directory() . '/assets/images/regiane.jpg')
  ? get_template_directory_uri() . '/assets/images/house.jpg'
  : 'https://via.placeholder.com/600x400?text=Regiane+Corretora';

// Equipe image
$equipe_image = image_exists_sobre(get_template_directory() . '/assets/images/equipe.jpg')
  ? get_template_directory_uri() . '/assets/images/house.jpg'
  : 'https://via.placeholder.com/600x400?text=Nossa+Equipe';
?>

<div class="page-header bg-dark text-light py-5 mb-4">
  <div class="container">
    <h1 class="display-4">Sobre Nós</h1>
    <p class="lead">Conheça a história e os valores da Regiane Corretora</p>
  </div>
</div>

<section class="container py-5">
  <div class="row align-items-center mb-5">
    <div class="col-lg-6 mb-4 mb-lg-0">
      <h2 class="fw-bold mb-4 text-dark">Nossa História</h2>
      <p class="lead text-dark">Mais de 5 anos de excelência no mercado imobiliário cearense.</p>
      <p class="text-dark">A Regiane Corretora nasceu da paixão por ajudar pessoas a encontrar seu lar ideal. Com sede
        em Fortaleza,
        atuamos em todo o estado do Ceará, oferecendo um atendimento personalizado e transparente.</p>
      <p class="text-dark">Fundada pela corretora Regiane, nossa empresa tem como missão transformar o sonho da casa
        própria em
        realidade, com segurança, profissionalismo e cuidado com cada cliente.</p>
    </div>
    <div class="col-lg-6">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/house.jpg" alt="Sobre nós"
        class="img-fluid rounded shadow">
    </div>
  </div>

  <div class="row mb-5">
    <div class="col-12 text-center mb-4">
      <h2 class="fw-bold text-dark">Nossos Valores</h2>
      <p class="lead text-dark">Princípios que guiam nosso trabalho todos os dias</p>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body text-center p-4">
          <div class="rounded-circle bg-dark p-3 d-inline-flex mb-3">
            <i class="fas fa-handshake text-warning fa-2x"></i>
          </div>
          <h3 class="h5 mb-3 text-dark">Transparência</h3>
          <p class="text-muted mb-0">Trabalhamos com total transparência em todos os processos, desde a
            primeira visita até a conclusão do negócio.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body text-center p-4">
          <div class="rounded-circle bg-dark p-3 d-inline-flex mb-3">
            <i class="fas fa-users text-warning fa-2x"></i>
          </div>
          <h3 class="h5 mb-3 text-dark">Atendimento Personalizado</h3>
          <p class="text-muted mb-0">Cada cliente é único e merece um atendimento exclusivo. Entendemos suas
            necessidades para oferecer as melhores opções.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body text-center p-4">
          <div class="rounded-circle bg-dark p-3 d-inline-flex mb-3">
            <i class="fas fa-shield-alt text-warning fa-2x"></i>
          </div>
          <h3 class="h5 mb-3 text-dark">Segurança</h3>
          <p class="text-muted mb-0">Garantimos a segurança jurídica em todas as transações, com documentação
            completa e assessoria especializada.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php

get_footer();
?>