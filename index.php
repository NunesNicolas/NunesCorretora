<?php
/**
 * Arquivo principal do tema
 */
get_header();

if (have_posts()):
  ?>


  <!-- Modal de Filtros -->
  <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: white;">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">Filtrar Imóveis</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="filterForm">
            <div class="mb-3">
              <label for="filterType" class="form-label">Tipo de Imóvel</label>
              <select class="form-select" id="filterType" name="type">
                <option value="">Todos</option>
                <option value="casa">Casa</option>
                <option value="apartamento">Apartamento</option>
                <option value="terreno">Terreno</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="filterPrice" class="form-label">Faixa de Preço</label>
              <select class="form-select" id="filterPrice" name="price">
                <option value="">Todos</option>
                <option value="0-100000">Até R$ 100.000</option>
                <option value="100000-300000">R$ 100.000 - R$ 300.000</option>
                <option value="300000-500000">R$ 300.000 - R$ 500.000</option>
                <option value="500000+">Acima de R$ 500.000</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="filterLocation" class="form-label">Localização</label>
              <input type="text" class="form-control" id="filterLocation" name="location" placeholder="Digite a cidade ou bairro">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" id="applyFilters">Aplicar Filtros</button>
        </div>
      </div>
    </div>
  </div>


<div class="container py-5">
   <!-- Botão de Filtro -->
    <div>
 

  <h1 class="text-center mb-2">Imóveis Disponíveis</h1>
  
  <div class="text-center mb-4">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
      Filtrar Imóveis
    </button>
  </div>

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