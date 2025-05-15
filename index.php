<?php

/**
 * Arquivo principal do tema
 */
get_header();

if (have_posts()):
?>
  <style>
    .btn-close {
      position: relative;
      background-color: transparent;
      border: none;
      color: #000;
      /* Cor do "X" */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn-close::before {
      content: "×";
      /* Adiciona o "X" */
      font-size: 1.5rem;
      color: #000;
    }
  </style>

  <!-- Modal de Filtros -->
  <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: white;">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">Filtrar Imóveis</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <div class="modal-body">
          <form id="filterForm">
            <div class="mb-3">
              <label for="filterType" class="form-label">Tipo de Negócio</label>
              <select class="form-select" id="filterType" name="type">
                <option value="">Todos</option>
                <option value="aluguel">Aluguel</option>
                <option value="venda">Compra</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Faixa de Preço</label>
              <div class="d-flex gap-2">
                <input type="number" class="form-control" id="filterPriceMin" name="price_min" placeholder="Preço Mínimo" min="0">
                <input type="number" class="form-control" id="filterPriceMax" name="price_max" placeholder="Preço Máximo" min="0">
              </div>
            </div>
            <div class="mb-3">
              <label for="filterLocation" class="form-label">Localização</label>
              <input type="text" class="form-control" id="filterLocation" name="location" placeholder="Digite a cidade ou bairro">
            </div>
            <div class="mb-3">
              <label for="bathroomsMin" class="form-label">Número mínimo de banheiros</label>
              <input type="number" class="form-control" id="bathroomsMin" name="bathrooms_min" min="0" placeholder="Ex: 2">
            </div>
            <div class="mb-3">
              <label for="bedroomsMin" class="form-label">Número mínimo de quartos</label>
              <input type="number" class="form-control" id="bedroomsMin" name="bedrooms_min" min="0" placeholder="Ex: 3">
            </div>
            <div class="mb-3">
              <label for="garageMin" class="form-label">Número mínimo de vagas de garagem</label>
              <input type="number" class="form-control" id="garageMin" name="garage_min" min="0" placeholder="Ex: 1">
            </div>
            <button type="submit" class="btn btn-primary" id="applyFilters">Aplicar Filtros</button>
          </form>
        </div>  
      </div>
    </div>
  </div>


  <div class="container py-5">
    <!-- Botão de Filtro -->
    <div>


      <h1 class="text-center mb-2 ">Imóveis Disponíveis</h1>

      <div class="text-center mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
          Filtrar Imóveis
        </button>
      </div>

      <div class="row" id="content_posts">
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
