<html>

<head>
    <meta charset="UTF-8" />
    <title>
        <?php echo is_home() ? get_bloginfo('name') : get_the_title() . " | " . get_bloginfo('name') ?>
    </title>
    <meta name="title"
        content="<?php echo is_home() ? get_bloginfo('name') : get_the_title() . " | " . get_bloginfo('name') ?>">
    <meta name="description"
        content="<?php echo is_home() ? get_bloginfo('description') : limitarTexto((wp_strip_all_tags(get_the_content())), 150); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="RED, estação democracia, democracia, red org, rede estação democracia">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Portuguese">
    <?php if (is_single() && 'noticia' == get_post_type()):
        $description = limitarTexto(wp_strip_all_tags(get_the_content()), 150);
        $thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/fake_thumb.jpg';
        $details_img = getimagesize($thumbnail);
        ?>
        <!-- Open Graph Tags -->
        <meta property="og:locale" content="pt_BR" />
        <meta property="og:type" content="article" />
        <meta property="og:description" content="<?php echo $description ?>" />
        <meta property="og:image" content="<?php echo $thumbnail ?>" />
        <meta property="og:image:width" content="<?php echo $details_img[0] ?>">
        <meta property="og:image:height" content="<?php echo $details_img[1] ?>">
        <meta property="og:image:type" content="<?php echo $details_img['mime'] ?>">
        <meta property="og:title" content="<?php echo get_the_title() ?>" />
        <meta property="og:site_name" content="<?php echo get_bloginfo('name') ?>">
        <meta property="og:url" content="<?php echo get_permalink() ?>" />
        <meta property="article:published_time" content="<?php echo get_the_date('Y-m-d\TH:i:s'); ?>" />
        <meta property="article:modified_time" content="<?php echo get_the_modified_date('Y-m-d\TH:i:s'); ?>" />
        <!-- Twitter -->
        <meta name="twitter:title" content="<?php echo get_the_title() ?>">
        <meta name="twitter:description" content="<?php echo $description ?>">
        <meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url() ?>">
        <meta name="twitter:card" content="summary_large_image">
        <!-- End Open Graph Tags -->
    <?php endif; ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VBVKLF6SMN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-VBVKLF6SMN');
    </script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <link rel="icon" type="image/png"
        href="<?php echo get_template_directory_uri() . '/assets/images/icons/favicon.png' ?>" />
    <?php wp_head(); ?>
    <script>
        const frontend_ajax_object = {
            ajaxurl: '<?php echo admin_url('admin-ajax.php') ?>'
        };
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2535916711277050"
        crossorigin="anonymous"></script>
</head>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo get_site_url() ?>">
            <img class="logo-header" src="<?php echo get_template_directory_uri() . '/assets/images/logo.png' ?>">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbar-desktop justify-content-end" id="navbarNavAltMarkup">
            <img class="arrow" src="<?php echo get_template_directory_uri() . '/assets/images/icons/arrow-top.svg' ?>"
                style="display: none;" alt="flecha">
            <div class="navbar-nav">
                <a class="nav-item nav-link navProgramas text-capitalize" href="<?php echo get_site_url() . '/imoveis' ?>"
                    id="programs-conditions">
                    Imóveis
                </a>
                <a class="nav-item nav-link navVideos text-capitalize" href="<?php echo get_site_url() . '/informacoes' ?>">Informações</a>
                <a class="nav-item nav-link navPodcasts text-capitalize" href="<?php echo get_site_url() . '/contato' ?>">Contato</a>
            </div>
            <span class="navbar-text text-white ms-md-5" id="gtranslate-languages">
                <?php echo do_shortcode('[gtranslate]'); ?>
            </span>
        </div>
    </div>
</nav>
<div class="background-menu"></div>


<body>


