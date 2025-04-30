</main>

<footer class="site-footer bg-dark text-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 mb-4 mb-lg-0">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Regiane Nunes Corretora"
          class="mb-4" style="max-height: 60px;">
        <p>Transformando sonhos em realidade através de negócios imobiliários na região do Cariri com ética,
          transparência e dedicação.</p>
        <p class="mb-0 d-flex align-items-center">
          <span class="bg-warning p-2 rounded mr-2">
            <i class="fas fa-id-card text-dark"></i>
          </span>
          CRECI 17.214
        </p>
      </div>

      <div class="col-lg-4 mb-4 mb-lg-0">
        <h5 class="mb-4 text-warning">Contato</h5>
        <p class="mb-2 d-flex align-items-center">
          <span class="bg-warning p-2 rounded mr-2">
            <i class="fas fa-phone-alt text-dark"></i>
          </span>
          <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588988779576')); ?>?text=Olá%20Regiane,%20estou%20em%20contato%20contigo%20por%20meio%20do%20site"
            class="text-light text-decoration-none" target="_blank">
            <?php echo esc_html(get_option('regiane_phone', '(88) 98877-9576')); ?>
          </a>
        </p>
        <p class="mb-2 d-flex align-items-center">
          <span class="bg-warning p-2 rounded mr-2">
            <i class="fas fa-envelope text-dark"></i>
          </span>
          <?php echo esc_html(get_option('regiane_email', 'regiane@gmail.com')); ?>
        </p>
        <p class="mb-0 d-flex align-items-center">
          <span class="bg-warning p-2 rounded mr-2">
            <i class="fas fa-map-marker-alt text-dark"></i>
          </span>
          Região do Cariri - Ceará
        </p>
      </div>

      <div class="col-lg-4">
        <h5 class="mb-4 text-warning">Navegação</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-light text-decoration-none">
              <i class="fas fa-home text-warning mr-2"></i> Início
            </a>
          </li>
          <li class="mb-2">
            <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="text-light text-decoration-none">
              <i class="fas fa-user text-warning mr-2"></i> Sobre Nós
            </a>
          </li>
          <li class="mb-2">
            <a href="<?php echo esc_url(home_url('/imoveis')); ?>" class="text-light text-decoration-none">
              <i class="fas fa-building text-warning mr-2"></i> Imóveis
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/regianenunescorretora/" class="text-light text-decoration-none"
              target="_blank">
              <i class="fab fa-instagram text-warning mr-2"></i> Instagram
            </a>
          </li>
        </ul>
      </div>
    </div>

    <hr class="my-4 bg-warning opacity-25">

    <div class="d-flex justify-content-between align-items-center flex-wrap">
      <p class="mb-0 text-light-50">
        &copy; <?php echo date('Y'); ?> Regiane Nunes Corretora de Imóveis. Todos os direitos reservados.
      </p>
      <div class="social-links">
        <a href="https://www.instagram.com/regianenunescorretora/" class="text-light mr-3" target="_blank">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588999999999')); ?>?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
          class="text-light" target="_blank">
          <i class="fab fa-whatsapp"></i>
        </a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>