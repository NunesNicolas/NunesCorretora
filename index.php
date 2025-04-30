<?php
/**
 * Arquivo principal do tema
 */
get_header();

if (have_posts()):
  ?>
<div class="container py-5">
  <h1 class="text-center mb-5">Imóveis Disponíveis</h1>
  <div class="row">
    <?php
      while (have_posts()):
        the_post();
        get_template_part('template-parts/content', get_post_type());
      endwhile;
      ?>
  </div>

  <div class="mt-4">
    <?php
      the_posts_pagination(array(
        'prev_text' => '&laquo; Anterior',
        'next_text' => 'Próximo &raquo;',
      ));
      ?>
  </div>
</div>
<?php
else:
  ?>
<div class="container py-5">
  <div class="row">
    <div class="col-12 text-center">
      <h2>Nenhum conteúdo encontrado</h2>
      <p>Não foi possível encontrar o conteúdo que você está procurando.</p>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Voltar à página inicial</a>
    </div>
  </div>
</div>
<?php
endif;

get_footer();