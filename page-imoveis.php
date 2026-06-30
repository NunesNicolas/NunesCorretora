<?php
/**
 * Template Name: Imoveis
 */

get_header();

$posts_per_page = 9;
$paged = max(1, get_query_var('paged'), get_query_var('page'));
$imoveis = new WP_Query(array(
    'post_type' => 'imovel',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => 'publish',
));

$map_items = regiane_get_imoveis_map_items();
$total_imoveis = $imoveis->found_posts;
?>

<section class="property-search-hero">
  <div class="container">
    <div class="property-search-heading">
      <span class="section-kicker">Busca de imoveis</span>
      <h1>Imoveis disponiveis</h1>
      <p>Refine sua busca por tipo, faixa de preco, localizacao e caracteristicas.</p>
    </div>
  </div>
</section>

<section class="property-search-section">
  <div class="container">
    <div class="property-search-shell">
      <aside class="property-filter-panel" aria-label="Filtros de imoveis">
        <div class="filter-panel-header">
          <button type="button" class="property-filter-toggle" aria-expanded="true" aria-controls="filterForm">
            <span>Filtros</span>
            <i class="fas fa-chevron-up" aria-hidden="true"></i>
          </button>
          <span id="propertyFilterCount"><?php echo esc_html($total_imoveis); ?> imoveis</span>
        </div>

        <form id="filterForm" class="property-filter-form">
          <div class="filter-field">
            <label for="filterType">Tipo de negocio</label>
            <select class="form-control" id="filterType" name="type">
              <option value="">Todos</option>
              <option value="aluguel">Aluguel</option>
              <option value="venda">Compra</option>
            </select>
          </div>

          <div class="filter-field filter-field-price">
            <label>Faixa de preco</label>
            <div class="filter-grid-two">
              <input type="number" class="form-control" id="filterPriceMin" name="price_min" placeholder="Minimo" min="0">
              <input type="number" class="form-control" id="filterPriceMax" name="price_max" placeholder="Maximo" min="0">
            </div>
          </div>

          <div class="filter-field filter-field-location">
            <label for="filterLocation">Localizacao</label>
            <input type="text" class="form-control" id="filterLocation" name="location" placeholder="Cidade, bairro ou rua">
          </div>

          <div class="filter-field filter-field-features">
            <label>Caracteristicas</label>
            <div class="filter-grid-three">
              <input type="number" class="form-control" id="bedroomsMin" name="bedrooms_min" min="0" placeholder="Quartos">
              <input type="number" class="form-control" id="bathroomsMin" name="bathrooms_min" min="0" placeholder="Banheiros">
              <input type="number" class="form-control" id="garageMin" name="garage_min" min="0" placeholder="Vagas">
            </div>
          </div>

          <div class="filter-field filter-field-action">
            <button type="submit" class="btn btn-primary w-100">
              <i class="fas fa-sliders-h mr-2"></i>Aplicar filtros
            </button>
          </div>
        </form>
      </aside>

      <div class="property-results-panel">
        <div class="property-map-card">
          <div class="property-map-summary">
            <div>
              <span class="section-kicker">Area de busca</span>
              <strong id="propertyResultCount"><?php echo esc_html($total_imoveis); ?></strong>
              <span>imoveis encontrados</span>
            </div>
            <div>
              <span class="section-kicker">No mapa</span>
              <strong id="propertyMapCount"><?php echo esc_html(count($map_items)); ?></strong>
              <span>com localizacao</span>
            </div>
          </div>
          <div id="propertyMap" class="property-map" data-items='<?php echo esc_attr(wp_json_encode($map_items)); ?>' data-total="<?php echo esc_attr($total_imoveis); ?>"></div>
        </div>

        <div class="results-toolbar">
          <h2>Imoveis disponiveis</h2>
          <span id="propertyResultLabel"><?php echo esc_html($total_imoveis); ?> resultado(s)</span>
        </div>

        <div class="row" id="content_posts">
          <?php
          if ($imoveis->have_posts()):
              while ($imoveis->have_posts()):
                  $imoveis->the_post();
                  get_template_part('template-parts/content', 'imovel');
              endwhile;
              wp_reset_postdata();
          else:
              ?>
              <div class="col-12">
                <p class="empty-state text-center">Nenhum imovel cadastrado.</p>
              </div>
              <?php
          endif;
          ?>
        </div>

        <div id="propertyPagination">
          <?php echo regiane_render_imoveis_pagination($paged, $imoveis->max_num_pages); ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
