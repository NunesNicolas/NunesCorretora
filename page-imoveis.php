<?php
/*
Template Name: Página de Imóveis
*/
get_header();
?>

<div class="page-header bg-primary text-white py-5 mb-4">
  <div class="container">
    <h1 class="display-4">Nossos Imóveis</h1>
    <p class="lead">Encontre o imóvel ideal para você e sua família</p>
  </div>
</div>

<section class="container py-5">
  <div class="row">
    <div class="col-lg-3 mb-4">
      <!-- Filtros -->
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Filtros</h4>
        </div>
        <div class="card-body">
          <form action="<?php echo home_url('/imoveis/'); ?>" method="get">
            <!-- Formulário de filtros pode ser adicionado depois -->
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-9">
      <div class="row">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $imoveis = new WP_Query(array(
          'post_type' => 'imovel',
          'posts_per_page' => 10,
          'paged' => $paged
        ));

        if ($imoveis->have_posts()):
          while ($imoveis->have_posts()):
            $imoveis->the_post();
            get_template_part('template-parts/content', 'imovel');
          endwhile;

          echo '<div class="col-12">';
          // Paginação
          echo paginate_links(array(
            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format' => '?paged=%#%',
            'current' => max(1, $paged),
            'total' => $imoveis->max_num_pages,
            'prev_text' => '&laquo; Anterior',
            'next_text' => 'Próximo &raquo;',
          ));
          echo '</div>';

          wp_reset_postdata();
        else:
          ?>
          <div class="col-12 text-center py-5">
            <div class="alert alert-info">
              <h4>Nenhum imóvel disponível</h4>
              <p>No momento não temos nenhum imóvel cadastrado. Por favor, tente novamente mais tarde.</p>
            </div>
          </div>
          <?php
        endif;
        ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>