<?php
function add_theme_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri());

    if (is_home()) :
        wp_enqueue_style('home-css', get_template_directory_uri() . '/assets/css/home.css', array(), '1.0', 'all');
    endif;

    if (is_page_template('templates/page-publications.php')) :
        wp_enqueue_style('publications-css', get_template_directory_uri() . '/assets/css/publications.css', array(), '1.0', 'all');
    endif;

    if (is_single()) {
        wp_enqueue_style('single-publicacao-css', get_template_directory_uri() . '/assets/css/single-publicacao.css', array(), '1.0', 'all');
    }

    if (is_page_template('templates/page-partners.php')) :
        wp_enqueue_style('partners-css', get_template_directory_uri() . '/assets/css/partners.css', array(), '1.0', 'all');
    endif;

    if (is_page_template('templates/page-radio.php')) :
        wp_enqueue_style('radio-css', get_template_directory_uri() . '/assets/css/radio.css', array(), '1.0', 'all');
    endif;

    if (is_page_template('templates/page-who-we-are.php')) :
        wp_enqueue_style('who-we-are-css', get_template_directory_uri() . '/assets/css/who-we-are.css', array(), '1.0', 'all');
    endif;

    if (is_page_template('templates/page-podcasts.php')) :
        wp_enqueue_style('podcasts-css', get_template_directory_uri() . '/assets/css/podcasts.css', array(), '1.0', 'all');
    endif;

    if (is_page_template('templates/page-campaign.php')) :
        wp_enqueue_style('campaign-css', get_template_directory_uri() . '/assets/css/campaign.css', array(), '1.0', 'all');
    endif;

    if (is_page_template('templates/page-programas.php')) :
        wp_enqueue_style('programas-css', get_template_directory_uri() . '/assets/css/programas.css', array(), '1.0', 'all');
    endif;


    if (is_page_template('templates/page-videos.php')) :
        wp_enqueue_style('videos-css', get_template_directory_uri() . '/assets/css/videos.css', array(), '1.0', 'all');
    endif;



    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap/bootstrap.css', array(), '1.0', 'all');
    wp_enqueue_style('owl-caroussel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css', array(), '1.0', 'all');
    wp_enqueue_style('owl-caroussel-default', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css', array(), '1.0', 'all');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css', array(), '1.0', 'all');
    wp_enqueue_style('datepicker-css', '//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css', array(), '1.0', 'all');

    wp_enqueue_script('jquery-de-verdade-js', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), 1.1, true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap/bootstrap.min.js', array('jquery'), 1.1, true);
    wp_enqueue_script('owl-carrousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), 1.1, true);
    wp_enqueue_script('jquerydatepicker-js', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js', array('jquery'), 1.1, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), 1.1, true);
    wp_enqueue_script('jquerymask-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js', array(), 1.1, true);


    wp_enqueue_script('filters-js', get_template_directory_uri() . '/assets/js/filters.js', array(), 1.1, true);
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');


function wpdocs_admin_script()
{
    wp_enqueue_script('admin_script', get_template_directory_uri(). '/assets/js/admin.js', array(), '1.0');
}
add_action('admin_enqueue_scripts', 'wpdocs_admin_script');
