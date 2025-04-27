<?php get_header(); ?>

<section class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <h1><?php the_title(); ?></h1>
            
            <?php if(has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url('imovel-single'); ?>" alt="<?php the_title(); ?>" class="img-fluid mb-4">
            <?php endif; ?>
            
            <div class="mb-4">
                <?php the_content(); ?>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Informações</h3>
                    
                    <?php if($price = get_post_meta(get_the_ID(), 'preco', true)): ?>
                        <p class="price">R$ <?php echo number_format($price, 2, ',', '.'); ?></p>
                    <?php endif; ?>
                    
                    <ul class="list-group list-group-flush">
                        <?php if($area = get_post_meta(get_the_ID(), 'area', true)): ?>
                            <li class="list-group-item">Área: <?php echo $area; ?> m²</li>
                        <?php endif; ?>
                        
                        <?php if($quartos = get_post_meta(get_the_ID(), 'quartos', true)): ?>
                            <li class="list-group-item">Quartos: <?php echo $quartos; ?></li>
                        <?php endif; ?>
                        
                        <?php if($banheiros = get_post_meta(get_the_ID(), 'banheiros', true)): ?>
                            <li class="list-group-item">Banheiros: <?php echo $banheiros; ?></li>
                        <?php endif; ?>
                        
                        <?php if($endereco = get_post_meta(get_the_ID(), 'endereco', true)): ?>
                            <li class="list-group-item">Endereço: <?php echo $endereco; ?></li>
                        <?php endif; ?>
                    </ul>
                    
                    <button class="btn btn-primary w-100 mt-3">
                        <i class="fas fa-phone me-2"></i> Entrar em contato
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>