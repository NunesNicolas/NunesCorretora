<?php

/**
 * Regiane Corretora - Funções e definições do tema
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Regiane_Corretora
 * @since 1.0
 */

/**
 * Inclui o Bootstrap Navwalker
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Scripts
 */

require_once('model/scripts.php');

/**
 * Supports Wordpress
 */

add_theme_support('post-thumbnails');
add_theme_support('custom-logo', array(
    'height' => 80,
    'width' => 260,
    'flex-height' => true,
    'flex-width' => true,
));

/**
 * Registrar menus de navegação
 */
function regiane_register_menus()
{
    register_nav_menus(array(
        'primary' => 'Menu Principal',
        'footer' => 'Menu do Rodapé'
    ));
}
add_action('init', 'regiane_register_menus');

/**
 * Remove Site Health
 */
add_action('wp_dashboard_setup', 'remove_site_health_dashboard_widget');
function remove_site_health_dashboard_widget()
{
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}

add_filter('wp_fatal_error_handler_enabled', '__return_false');

add_action('admin_menu', 'remove_site_health_menu');

function remove_site_health_menu()
{
    remove_submenu_page('tools.php', 'site-health.php');
}

/**
 * Post Types (Custom Fields and Custom Category)
 */

require_once('model/post-types/imoveis/imoveis.php'); // Imóveis

/**
 *  Ajax
 */

require_once('model/ajax/filters/publications.php'); #Publicações

/* 
 * GET Thumbnail
 */

function check_url_thumbnail($url)
{
    // Use get_headers() function
    $headers = @get_headers($url);

    // Use condition to check the existence of URL
    if ($headers && strpos($headers[0], '200')) {
        $status = true;
    } else {
        $status = false;
    }

    return $status;
}

function wpdocs_remove_menus()
{
    /*
  remove_menu_page('index.php');                  //Dashboard
  remove_menu_page('jetpack');                    //Jetpack* 
  //remove_menu_page('edit.php');                   //Posts
  remove_menu_page('upload.php');                 //Media
  remove_menu_page('edit.php?post_type=page');    //Pages
  remove_menu_page('edit-comments.php');          //Comments
  remove_menu_page('themes.php');                 //Appearance
  remove_menu_page('plugins.php');                //Plugins
  remove_menu_page('tools.php');                  //Tools
  remove_menu_page('options-general.php');        //Settings
  remove_menu_page('edit.php?post_type=acf-field-group'); //ACF
  remove_menu_page('edit.php?post_type=podcast'); //PODCAST 
  */
}
add_action('admin_menu', 'wpdocs_remove_menus');


/**
 * Função para filtrar imóveis
 */

function filtrar_imoveis()
{
    $posts_per_page = 9;
    $paged = !empty($_POST['paged']) ? max(1, intval($_POST['paged'])) : 1;
    $args = array(
        'post_type' => 'imovel',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'meta_query' => array(), // Inicializa o meta_query
    );

    // Filtro por tipo de negócio (aluguel ou venda) baseado no campo personalizado 'tipo_negocio'
    if (!empty($_POST['type'])) {
        $args['meta_query'][] = array(
            'key' => 'tipo_negocio', // Nome do campo personalizado
            'value' => sanitize_text_field($_POST['type']), // Valor enviado pelo formulário
            'compare' => '=', // Verifica igualdade
        );
    }

    // Filtro por faixa de preço
    if (!empty($_POST['price_min']) || !empty($_POST['price_max'])) {
        $price_query = array(
            'key' => 'preco',
            'type' => 'NUMERIC',
        );

        if (!empty($_POST['price_min']) && !empty($_POST['price_max'])) {
            $price_query['value'] = array(intval($_POST['price_min']), intval($_POST['price_max']));
            $price_query['compare'] = 'BETWEEN';
        } elseif (!empty($_POST['price_min'])) {
            $price_query['value'] = intval($_POST['price_min']);
            $price_query['compare'] = '>=';
        } elseif (!empty($_POST['price_max'])) {
            $price_query['value'] = intval($_POST['price_max']);
            $price_query['compare'] = '<=';
        }

        $args['meta_query'][] = $price_query;
    }

    // Filtro por localização (campo preenchível)
    if (!empty($_POST['location'])) {
        $args['meta_query'][] = array(
            'key' => 'endereco', // nome do campo personalizado
            'value' => sanitize_text_field($_POST['location']),
            'compare' => 'LIKE'
        );
    }

    // Filtro por número mínimo de banheiros
    if (!empty($_POST['bathrooms_min'])) {
        $args['meta_query'][] = array(
            'key' => 'banheiros', // Substitua pelo nome do campo personalizado
            'value' => intval($_POST['bathrooms_min']),
            'type' => 'NUMERIC',
            'compare' => '>='
        );
    }

    // Filtro por número mínimo de quartos
    if (!empty($_POST['bedrooms_min'])) {
        $args['meta_query'][] = array(
            'key' => 'quartos', // Substitua pelo nome do campo personalizado
            'value' => intval($_POST['bedrooms_min']),
            'type' => 'NUMERIC',
            'compare' => '>='
        );
    }

    // Filtro por número mínimo de vagas de garagem
    if (!empty($_POST['garage_min'])) {
        $args['meta_query'][] = array(
            'key' => 'garagem', // Substitua pelo nome do campo personalizado
            'value' => intval($_POST['garage_min']),
            'type' => 'NUMERIC',
            'compare' => '>='
        );
    }

    $query = new WP_Query($args);
    $map_args = $args;
    $map_args['posts_per_page'] = -1;
    unset($map_args['paged']);
    $map_items = regiane_get_imoveis_map_items(new WP_Query($map_args));

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'imovel');
        }
        wp_reset_postdata();
        wp_send_json_success(array(
            'html' => ob_get_clean(),
            'count' => $query->found_posts,
            'map_items' => $map_items,
            'pagination' => regiane_render_imoveis_pagination($paged, $query->max_num_pages),
        ));
    } else {
        wp_send_json_error(array(
            'html' => '<div class="col-12"><p class="empty-state text-center">Nenhum imóvel encontrado.</p></div>',
            'count' => 0,
            'map_items' => array(),
            'pagination' => '',
        ));
    }
}
add_action('wp_ajax_filtrar_imoveis', 'filtrar_imoveis');
add_action('wp_ajax_nopriv_filtrar_imoveis', 'filtrar_imoveis');

function regiane_render_imoveis_pagination($current_page, $max_pages)
{
    if ($max_pages <= 1) {
        return '';
    }

    $links = paginate_links(array(
        'base' => '#paged-%#%',
        'format' => '',
        'current' => max(1, intval($current_page)),
        'total' => intval($max_pages),
        'type' => 'array',
        'prev_text' => '&laquo; Anterior',
        'next_text' => 'Próximo &raquo;',
    ));

    if (empty($links)) {
        return '';
    }

    $output = '<nav class="property-pagination" aria-label="Paginação de imóveis">';

    foreach ($links as $link) {
        $link = preg_replace_callback('/href=["\']#paged-(\d+)["\']/', function ($matches) {
            return 'href="#" data-page="' . esc_attr($matches[1]) . '"';
        }, $link);
        $output .= $link;
    }

    $output .= '</nav>';

    return $output;
}

function registrar_scripts_filtro()
{
    wp_enqueue_script('filters', get_template_directory_uri() . '/assets/js/filters.js', array('jquery'), '1.2', true);
    wp_localize_script('filters', 'regiane_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'registrar_scripts_filtro');

function regiane_get_imoveis_map_items($query = null)
{
    $items = array();
    $posts = array();

    if ($query instanceof WP_Query) {
        $posts = $query->posts;
    } else {
        $map_query = new WP_Query(array(
            'post_type' => 'imovel',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ));
        $posts = $map_query->posts;
        wp_reset_postdata();
    }

    foreach ($posts as $post) {
        $lat = get_post_meta($post->ID, 'latitude', true);
        $lng = get_post_meta($post->ID, 'longitude', true);

        if ($lat === '' || $lng === '') {
            continue;
        }

        $items[] = array(
            'id' => $post->ID,
            'title' => get_the_title($post),
            'url' => get_permalink($post),
            'price' => get_post_meta($post->ID, 'preco', true),
            'address' => get_post_meta($post->ID, 'endereco', true),
            'lat' => (float) $lat,
            'lng' => (float) $lng,
        );
    }

    return $items;
}

function regiane_enqueue_property_map()
{
    if (!is_page('imoveis') && !is_post_type_archive('imovel')) {
        return;
    }

    wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4');
    wp_enqueue_script('leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true);
    wp_enqueue_script('property-map', get_template_directory_uri() . '/assets/js/property-map.js', array('leaflet'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'regiane_enqueue_property_map');

/**
 * Tamanhos de imagem customizados
 */
function regiane_add_image_sizes()
{
    add_image_size('imovel-thumb', 600, 450, false);
    add_image_size('imovel-single', 1200, 800, false);
    add_image_size('imovel-carousel', 1200, 800, false);
}
add_action('after_setup_theme', 'regiane_add_image_sizes');

/**
 * Criar páginas padrão se não existirem
 */
function regiane_create_pages()
{
    // Array com as páginas a serem criadas: título, slug e template
    $pages = array(
        'Sobre Nós' => array(
            'slug' => 'sobre',
            'template' => 'page-sobre.php'
        ),
        'Imóveis' => array(
            'slug' => 'imoveis',
            'template' => 'page-imoveis.php'
        )
    );

    foreach ($pages as $title => $page_data) {
        $page_exists = get_page_by_path($page_data['slug']);

        if (!$page_exists) {
            $page_id = wp_insert_post(array(
                'post_title' => $title,
                'post_name' => $page_data['slug'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => '',
            ));

            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        }
    }

    // Configurar página inicial se já não estiver configurada
    $front_page = get_option('page_on_front');
    if (!$front_page) {
        $home = get_page_by_title('Home');
        if (!$home) {
            $home_id = wp_insert_post(array(
                'post_title' => 'Home',
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => '',
            ));
        } else {
            $home_id = $home->ID;
        }

        if ($home_id && !is_wp_error($home_id)) {
            update_option('page_on_front', $home_id);
            update_option('show_on_front', 'page');
        }
    }
}
add_action('after_switch_theme', 'regiane_create_pages');

// Carregar scripts e estilos
function regiane_corretora_scripts()
{
    // jQuery (garantir que seja carregado primeiro)
    wp_enqueue_script('jquery');

    // Bootstrap
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);

    // Swiper
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    // Estilos e scripts do tema
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', array('bootstrap', 'font-awesome', 'google-fonts'));
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'bootstrap', 'swiper'), null, true);
}
add_action('wp_enqueue_scripts', 'regiane_corretora_scripts');



// Configurações do tema
function regiane_corretora_config()
{
    // Configurações de contato
    register_setting('regiane_corretora_options', 'regiane_phone');
    register_setting('regiane_corretora_options', 'regiane_email');
    register_setting('regiane_corretora_options', 'regiane_address');

    // Cria a página de opções
    add_options_page(
        'Configurações da Corretora',
        'Regiane Corretora',
        'manage_options',
        'regiane-corretora',
        'regiane_corretora_options_page'
    );
}
add_action('admin_menu', 'regiane_corretora_config');

// Página de opções
function regiane_corretora_options_page()
{
    ?>
<div class="wrap">
  <h1>Configurações da Regiane Corretora</h1>
  <form method="post" action="options.php">
    <?php settings_fields('regiane_corretora_options'); ?>
    <table class="form-table">
      <tr>
        <th><label for="regiane_phone">Telefone:</label></th>
        <td>
          <input type="text" id="regiane_phone" name="regiane_phone"
            value="<?php echo esc_attr(get_option('regiane_phone')); ?>" class="regular-text">
        </td>
      </tr>
      <tr>
        <th><label for="regiane_email">E-mail:</label></th>
        <td>
          <input type="email" id="regiane_email" name="regiane_email"
            value="<?php echo esc_attr(get_option('regiane_email')); ?>" class="regular-text">
        </td>
      </tr>
      <tr>
        <th><label for="regiane_address">Endereço:</label></th>
        <td>
          <textarea id="regiane_address" name="regiane_address"
            class="regular-text"><?php echo esc_textarea(get_option('regiane_address')); ?></textarea>
        </td>
      </tr>
    </table>
    <?php submit_button(); ?>
  </form>
</div>
<?php
}

function regiane_customize_register($wp_customize)
{
    $wp_customize->add_section('regiane_visual_identity', array(
        'title' => 'Identidade visual',
        'priority' => 30,
    ));

    $colors = array(
        'regiane_color_primary' => array('label' => 'Cor principal', 'default' => '#2f3432'),
        'regiane_color_accent' => array('label' => 'Cor de destaque', 'default' => '#f1be1b'),
        'regiane_color_surface' => array('label' => 'Fundo suave', 'default' => '#f7f4ec'),
    );

    foreach ($colors as $setting => $data) {
        $wp_customize->add_setting($setting, array(
            'default' => $data['default'],
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting, array(
            'label' => $data['label'],
            'section' => 'regiane_visual_identity',
        )));
    }

    $wp_customize->add_setting('regiane_radius', array(
        'default' => 18,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('regiane_radius', array(
        'label' => 'Arredondamento dos componentes',
        'section' => 'regiane_visual_identity',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 0,
            'max' => 32,
            'step' => 1,
        ),
    ));
}
add_action('customize_register', 'regiane_customize_register');

function regiane_print_theme_tokens()
{
    $primary = get_theme_mod('regiane_color_primary', '#2f3432');
    $accent = get_theme_mod('regiane_color_accent', '#f1be1b');
    $surface = get_theme_mod('regiane_color_surface', '#f7f4ec');
    $radius = absint(get_theme_mod('regiane_radius', 18));
    ?>
<style id="regiane-theme-tokens">
:root {
  --primary: <?php echo esc_html($primary); ?>;
  --dark: <?php echo esc_html($primary); ?>;
  --gray-color: <?php echo esc_html($primary); ?>;
  --navbar-bg: <?php echo esc_html($primary); ?>;
  --secondary: <?php echo esc_html($accent); ?>;
  --warning: <?php echo esc_html($accent); ?>;
  --primary-color: <?php echo esc_html($accent); ?>;
  --accent-color: <?php echo esc_html($accent); ?>;
  --theme-surface: <?php echo esc_html($surface); ?>;
  --theme-radius: <?php echo esc_html($radius); ?>px;
  --theme-radius-sm: <?php echo esc_html(max(8, $radius - 8)); ?>px;
}
</style>
<?php
}
add_action('wp_head', 'regiane_print_theme_tokens', 30);

function load_featured_properties()
{
    ob_start();

    $destaques = new WP_Query(array(
        'post_type' => 'imovel',
        'posts_per_page' => 4,
        'orderby' => 'rand'
    ));

    if ($destaques->have_posts()):
        while ($destaques->have_posts()):
            $destaques->the_post();
            get_template_part('template-parts/content', 'imovel');
        endwhile;
    else:
        echo '<div class="col-12 text-center"><p>Nenhum imóvel encontrado.</p></div>';
    endif;

    wp_reset_postdata();

    $output = ob_get_clean();
    wp_send_json_success($output);
}
add_action('wp_ajax_load_featured_properties', 'load_featured_properties');
add_action('wp_ajax_nopriv_load_featured_properties', 'load_featured_properties');

// Variáveis para JS
function regiane_js_vars()
{
    ?>
<script type="text/javascript">
var regiane_vars = {
  ajaxurl: '<?php echo admin_url("admin-ajax.php"); ?>'
};
</script>
<?php
}
add_action('wp_head', 'regiane_js_vars');

// Forçar atualização das regras de permalink quando o tema for ativado
function regiane_flush_rewrite_rules()
{
    regiane_create_pages(); // Criar as páginas
    flush_rewrite_rules(); // Forçar atualização das regras de URL
}
add_action('after_switch_theme', 'regiane_flush_rewrite_rules');

// Adicionar um botão para recriar as páginas e atualizar regras de URL
function regiane_add_recreate_pages_button()
{
    if (isset($_GET['recreate_pages']) && $_GET['recreate_pages'] == 1) {
        regiane_create_pages();
        flush_rewrite_rules();

        // Redirecionar para evitar múltiplos cliques
        wp_redirect(admin_url('themes.php?page=regiane-pages&pages_recreated=1'));
        exit;
    }

    // Adicionar página no menu de temas
    add_theme_page(
        'Páginas do Tema',
        'Páginas do Tema',
        'manage_options',
        'regiane-pages',
        'regiane_pages_callback'
    );
}
add_action('admin_menu', 'regiane_add_recreate_pages_button');

// Callback para a página de administração das páginas do tema
function regiane_pages_callback()
{
    ?>
<div class="wrap">
  <h1>Páginas do Tema Regiane Corretora</h1>

  <?php if (isset($_GET['pages_recreated']) && $_GET['pages_recreated'] == 1): ?>
  <div class="notice notice-success is-dismissible">
    <p>Páginas recriadas com sucesso!</p>
  </div>
  <?php endif; ?>

  <p>Se você estiver enfrentando problemas com as páginas do tema, como a página "Sobre Nós" ou "Imóveis" não
    exibindo corretamente, use o botão abaixo para recriar as páginas do tema e atualizar as regras de URL.</p>

  <a href="<?php echo admin_url('themes.php?page=regiane-pages&recreate_pages=1'); ?>" class="button button-primary">
    Recriar Páginas do Tema
  </a>
</div> <?php
}

// Forçar o uso do template correto baseado no slug da página
function regiane_page_template($template)
{
    global $post;

    if (is_page()) {
        $page_slug = $post->post_name;

        if ($page_slug == 'sobre' && file_exists(get_template_directory() . '/page-sobre.php')) {
            return get_template_directory() . '/page-sobre.php';
        }

        if ($page_slug == 'imoveis' && file_exists(get_template_directory() . '/page-imoveis.php')) {
            return get_template_directory() . '/page-imoveis.php';
        }
    }

    return $template;
}
add_filter('template_include', 'regiane_page_template');

// Função para forçar a criação das páginas agora
function regiane_force_create_pages()
{
    $pages = array(
        'Sobre Nós' => array(
            'slug' => 'sobre',
            'file' => 'page-sobre.php',
            'content' => ''
        ),
        'Imóveis' => array(
            'slug' => 'imoveis',
            'file' => 'page-imoveis.php',
            'content' => ''
        )
    );

    foreach ($pages as $title => $page_data) {
        // Verificar se a página já existe
        $existing_page = get_page_by_path($page_data['slug']);

        if ($existing_page) {
            // Se a página existe, atualize-a para garantir que esteja publicada e com o template correto
            wp_update_post(array(
                'ID' => $existing_page->ID,
                'post_status' => 'publish',
                'page_template' => $page_data['file']
            ));

            // Atualizar o meta de template
            update_post_meta($existing_page->ID, '_wp_page_template', $page_data['file']);
        } else {
            // Se a página não existe, crie-a
            $page_id = wp_insert_post(array(
                'post_title' => $title,
                'post_name' => $page_data['slug'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => $page_data['content']
            ));

            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page_data['file']);
            }
        }
    }

    // Forçar atualização das regras de rewrite
    flush_rewrite_rules();
}

// Adicionando um hook para executar quando o usuário clicar no botão
function regiane_handle_admin_actions()
{
    // Verificar se a ação foi solicitada
    if (isset($_GET['action']) && $_GET['action'] == 'force_create_pages') {
        // Executar a criação de páginas
        regiane_force_create_pages();

        // Redirecionar para evitar problemas de refresh
        wp_redirect(admin_url('index.php?page=regiane-pages-created'));
        exit;
    }
}
add_action('admin_init', 'regiane_handle_admin_actions');

// Adicionar mensagem de notificação para o admin
function regiane_admin_notices()
{
    // Se estamos na tela de administração e a página foi criada
    if (isset($_GET['page']) && $_GET['page'] == 'regiane-pages-created') {
        ?>
<div class="notice notice-success is-dismissible">
  <p><strong>Sucesso!</strong> As páginas do tema foram criadas/atualizadas com sucesso.</p>
</div>
<?php
    }
}
add_action('admin_notices', 'regiane_admin_notices');

// Adicionar a ação ao menu do WordPress
function regiane_add_menu_item()
{
    add_menu_page(
        'Regiane Corretora',
        'Regiane Corretora',
        'manage_options',
        'regiane-menu',
        'regiane_menu_page',
        'dashicons-admin-home',
        20
    );
}
add_action('admin_menu', 'regiane_add_menu_item');

// Conteúdo da página do menu
function regiane_menu_page()
{
    ?>
<div class="wrap">
  <h1>Regiane Corretora - Gerenciamento do Tema</h1>

  <div class="card">
    <h2 class="title">Páginas do Tema</h2>
    <p>Se você estiver tendo problemas com as páginas "Sobre Nós" ou "Imóveis", use o botão abaixo para criar ou
      atualizar essas páginas.</p>

    <a href="<?php echo admin_url('admin.php?page=regiane-menu&action=force_create_pages'); ?>"
      class="button button-primary">
      Criar/Atualizar Páginas do Tema
    </a>
  </div>

  <div class="card" style="margin-top: 20px;">
    <h2 class="title">Configurações Gerais</h2>
    <p>Configure os dados de contato da corretora nas <a
        href="<?php echo admin_url('options-general.php?page=regiane-corretora'); ?>">configurações da
        corretora</a>.</p>
  </div>
</div>
<?php
}

require_once('model/post-types/imoveis/galeria.php');

function regiane_enqueue_fancybox()
{
    wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css');
    wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'regiane_enqueue_fancybox');

// Garante que as imagens sejam redimensionadas corretamente
add_filter('wp_get_attachment_image_src', 'fix_wp_get_attachment_image_src', 10, 4);
function fix_wp_get_attachment_image_src($image, $attachment_id, $size, $icon)
{
    if ($image) {
        $image[1] = $image[1] ?: 1200;
        $image[2] = $image[2] ?: 800;
    }
    return $image;
}

// Força o WordPress a gerar todas as imagens necessárias
add_filter('intermediate_image_sizes_advanced', 'add_custom_image_sizes');
function add_custom_image_sizes($sizes)
{
    $sizes['imovel-carousel'] = array(
        'width' => 1200,
        'height' => 800,
        'crop' => false
    );
    return $sizes;
}
