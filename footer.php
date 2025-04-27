</main>

<footer class="site-footer bg-gray text-white py-5 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 mb-4 mb-lg-0">
        <h5 class="mb-4 text-primary">Regiane Nunes Corretora</h5>
        <p>Transformando sonhos em realidade através de negócios imobiliários na região do Cariri com ética,
          transparência e dedicação.</p>
        <p class="mb-0 d-flex align-items-center">
          <span class="bg-primary p-2 rounded me-2">
            <i class="fas fa-id-card text-gray"></i>
          </span>
          CRECI 17.214
        </p>
      </div>

      <div class="col-lg-4 mb-4 mb-lg-0">
        <h5 class="mb-4 text-primary">Contato</h5>
        <p class="mb-2 d-flex align-items-center">
          <span class="bg-primary p-2 rounded me-2">
            <i class="fas fa-phone-alt text-gray"></i>
          </span>
          <?php echo esc_html(get_option('regiane_phone', '(XX) XXXX-XXXX')); ?>
        </p>
        <p class="mb-2 d-flex align-items-center">
          <span class="bg-primary p-2 rounded me-2">
            <i class="fas fa-envelope text-gray"></i>
          </span>
          <?php echo esc_html(get_option('regiane_email', 'contato@exemplo.com')); ?>
        </p>
        <p class="mb-0 d-flex align-items-center">
          <span class="bg-primary p-2 rounded me-2">
            <i class="fas fa-map-marker-alt text-gray"></i>
          </span>
          Região do Cariri - Ceará
        </p>
      </div>

      <div class="col-lg-4">
        <h5 class="mb-4 text-primary">Navegação</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-white text-decoration-none">
              <i class="fas fa-home text-primary me-2"></i> Início
            </a>
          </li>
          <li class="mb-2">
            <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="text-white text-decoration-none">
              <i class="fas fa-user text-primary me-2"></i> Sobre Nós
            </a>
          </li>
          <li class="mb-2">
            <a href="<?php echo esc_url(home_url('/imoveis')); ?>" class="text-white text-decoration-none">
              <i class="fas fa-building text-primary me-2"></i> Imóveis
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/regianenunescorretora/" class="text-white text-decoration-none"
              target="_blank">
              <i class="fab fa-instagram text-primary me-2"></i> Instagram
            </a>
          </li>
        </ul>
      </div>
    </div>

    <hr class="my-4 bg-light opacity-25">

    <div class="d-flex justify-content-between align-items-center flex-wrap">
      <p class="mb-0 text-white-50">
        &copy; <?php echo date('Y'); ?> Regiane Nunes Corretora de Imóveis. Todos os direitos reservados.
      </p>
      <div class="social-links">
        <a href="https://www.instagram.com/regianenunescorretora/" class="text-white me-3" target="_blank">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://wa.me/<?php echo esc_html(get_option('regiane_phone', '5588999999999')); ?>?text=Olá%20Regiane,%20estou%20interessado%20em%20seus%20serviços"
          class="text-white" target="_blank">
          <i class="fab fa-whatsapp"></i>
        </a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>