<div class="col-md-6 col-lg-4 mb-4">
    <div class="imovel-card h-100">
        <a href="<?php the_permalink(); ?>">
            <?php if(has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url('imovel-thumb'); ?>" alt="<?php the_title(); ?>">
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/imovel-placeholder.jpg" alt="Imóvel">
            <?php endif; ?>
        </a>
        
        <div class="card-body">
            <h3 class="h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            
            <?php if($price = get_post_meta(get_the_ID(), 'preco', true)): ?>
                <p class="price mb-2">R$ <?php echo number_format($price, 2, ',', '.'); ?></p>
            <?php endif; ?>
            
            <div class="d-flex justify-content-between text-muted small mb-3">
                <?php if($area = get_post_meta(get_the_ID(), 'area', true)): ?>
                    <span><?php echo $area; ?> m²</span>
                <?php endif; ?>
                
                <?php if($quartos = get_post_meta(get_the_ID(), 'quartos', true)): ?>
                    <span><?php echo $quartos; ?> quartos</span>
                <?php endif; ?>
                
                <?php if($banheiros = get_post_meta(get_the_ID(), 'banheiros', true)): ?>
                    <span><?php echo $banheiros; ?> banheiros</span>
                <?php endif; ?>
            </div>
            
            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary w-100">
                Ver detalhes
            </a>
        </div>
    </div>
</div>