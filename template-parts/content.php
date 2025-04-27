<?php
/**
 * Template para exibir o conteúdo de posts padrão
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
  <div class="container">
    <header class="entry-header mb-4">
      <h1 class="entry-title"><?php the_title(); ?></h1>

      <?php if (!is_page()): ?>
      <div class="entry-meta text-muted">
        <small>
          <i class="fas fa-calendar-alt me-1"></i> <?php echo get_the_date(); ?>
          <i class="fas fa-user ms-3 me-1"></i> <?php the_author(); ?>
        </small>
      </div>
      <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail()): ?>
    <div class="entry-thumbnail mb-4">
      <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>"
        class="img-fluid rounded">
    </div>
    <?php endif; ?>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>

    <?php if (!is_page() && has_tag()): ?>
    <footer class="entry-footer mt-4">
      <div class="entry-tags">
        <?php the_tags('<span class="me-2">Tags:</span>', ', '); ?>
      </div>
    </footer>
    <?php endif; ?>
  </div>
</article>