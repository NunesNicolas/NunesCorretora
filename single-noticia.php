<?php
get_header();
while (have_posts()):
    the_post();
    $tipos = get_the_terms(get_the_id(), 'tipos-publicacoes');
    $terms = get_the_terms(get_the_id(), 'category'); ?>
    ?>
    <script>
        const postagem_id = <?php echo get_the_ID(); ?>;
    </script>
    <main class="single-publicacoes">
        <div class="container">



            <div>
                <p class="category" style="margin-bottom: 0px;">
                    <?php if (!is_null($terms) && !empty($terms)): ?>
                        <?php foreach ($terms as $term): ?>
                            <?php echo $term->name; ?>
                            <?php break; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php echo 'Sem Tags'; ?>
                    <?php endif; ?>
                </p>
                <h1 class="main-title col-md-8 desktop" style="padding-left: 0px;">
                    <?php echo get_the_title() ?>
                </h1>
                <h1 class="main-title mobile">
                    <?php echo get_the_title() ?>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <span class="artigo" style="text-align: center;">
                        <?php if (!is_null($tipos) && !empty($tipos)): ?>
                            <?php foreach ($tipos as $term): ?>
                                <?php echo $term->name; ?>
                                <?php break; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php echo 'Vazio'; ?>
                        <?php endif; ?>
                    </span><span class="subtitle">por <span class="text-capitalize">
                            <?php echo get_the_author() ?>
                        </span>
                    </span>
                    <span class="ml-2 languages"  id="news-languages">
                        <span class="navbar-text text-dark ms-md-5 ms-0 ps-0">
                            <?php echo do_shortcode('[gtranslate]'); ?>
                        </span>
                    </span>
                    <div class="mt-3 mb-3">
                        <span class="subtitle">
                            <?php echo get_the_date('d/m/Y H:i') ?>
                            <?php echo get_the_date('U') !== get_the_modified_date('U') ? '&#x2022; Atualizado em ' . get_the_modified_date('d/m/Y H:i') : '' ?>
                        </span>
                    </div>
                    <div class="mt-3">
                        <div class="sociais_links d-inline">
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style"
                                data-a2a-url="<?php echo get_the_permalink() ?>"
                                data-a2a-title="<?php echo get_the_title() ?>">
                                <a type="button" class="btnLike mr-3" data-postid="<?php echo get_the_ID() ?>"
                                    onclick="liked(this)">
                                    <span class="iconeLiked"></span>
                                    <span id="numeroCurtidas">
                                        <?php echo !empty(get_post_field('curtidas')) ? get_post_field('curtidas') : '0' ?>
                                    </span>
                                </a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_whatsapp"></a>
                                <a class="a2a_button_facebook_messenger"></a>
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                            </div>
                        </div>
                    </div>
                    <div class="notice-pd-right">
                        <?php
                        if (get_the_post_thumbnail_url()): ?>
                            <div><img src="<?php echo get_the_post_thumbnail_url() ?>" class="img-top-text"
                                    alt="<?php echo get_the_title() ?>">
                                <?php
                                the_content(); ?>
                            </div>
                            <?php
                        else:
                            the_content();
                        endif;
                        ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 more-publications">
                    <div class="box line-bottom">
                        <span class="more-than">Mais publicações</span>
                        <span class="see-more"><a href="<?php echo get_site_url() . '/publicacoes' ?>">Ver todas
                                ></a></span>
                    </div>
                    <div class="box-column">
                        <?php
                        $args = array(
                            'post_type' => 'noticia',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => 4,

                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()): ?>
                            <?php while ($query->have_posts()):
                                $query->the_post();
                                $tipos = get_the_terms(get_the_id(), 'tipos-publicacoes');
                                $terms = get_the_terms(get_the_id(), 'category'); ?>
                                <div class="other-notice mb-4">
                                    <div class="row no-gutters">
                                        <div class="col-4">
                                            <?php if (get_the_post_thumbnail_url()): ?>
                                                <img src="<?php echo get_the_post_thumbnail_url() ?>" class="card-img"
                                                    alt="<?php echo get_the_title() ?>">
                                            <?php else: ?>
                                                <img src="<?php echo get_template_directory_uri() . '/assets/images/fake_thumb.jpg' ?>"
                                                    class="card-img" alt="<?php echo get_the_title() ?>">
                                            <?php endif; ?>
                                            <div class="tipo">
                                                <p class="text-white">
                                                    <?php if (!is_null($tipos) && !empty($tipos)): ?>
                                                        <?php foreach ($tipos as $term): ?>
                                                            <?php echo $term->name; ?>
                                                            <?php break; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <?php echo 'Vazio'; ?>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <a class="content" href="<?php echo get_the_permalink() ?>">
                                                <div>
                                                    <p class="category" style="margin: 0px;">
                                                        <?php if (!is_null($terms) && !empty($terms)): ?>
                                                            <?php foreach ($terms as $term): ?>
                                                                <?php echo $term->name; ?>
                                                                <?php break; ?>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <?php echo 'Sem Tags'; ?>
                                                        <?php endif; ?>
                                                    </p>
                                                    <h5 class="card-title text-capitalize">
                                                        <?php
                                                        $text = wp_strip_all_tags(get_the_title());
                                                        echo limitarTexto($text, 45);
                                                        ?>
                                                    </h5>
                                                    <small class="subtitle text-capitalize">
                                                        <?php echo get_the_author() ?>
                                                    </small>
                                                    <p class="card-text">
                                                        <?php
                                                        $text = wp_strip_all_tags(get_the_content());
                                                        echo limitarTexto($text, 55);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata() ?>
                        <?php else: ?>
                            <h5 class="text-center mt-4 mb-4">Nenhuma Publicação Encontrada</h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="img-giant">
            <div class="text-center" style="width:90%; height:85%;">
                <img>
                <p class="text-center" style="color: white;">Toque novamente para sair.</p>
            </div>
        </div>
    </main>
    <?php
endwhile;
get_footer();
?>