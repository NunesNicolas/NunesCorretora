<?php
/**
 * Template part para exibir os imóveis
 */
if (!function_exists('image_exists_imovel')) {
    function image_exists_imovel($file_path)
    {
        // Usando o caminho do servidor em vez de file_exists
        return @getimagesize($file_path) !== false;
    }
}

$placeholder_image_path = get_template_directory() . '/assets/images/placeholder.jpg';
$placeholder_image = image_exists_imovel($placeholder_image_path)
    ? get_template_directory_uri() . '/assets/images/placeholder.jpg'
    : 'https://via.placeholder.com/400x300?text=Imagem+não+disponível';

// Verificar se é um imóvel em destaque
$is_destaque = get_post_meta(get_the_ID(), 'destaque', true);
?>

<div class="col-md-4 mb-4">
  <div class="card imovel-card h-100">
    <?php if ($is_destaque): ?>
    <span class="badge-destaque">Destaque</span>
    <?php endif; ?>

    <?php if (has_post_thumbnail()): ?>
    <a href="<?php the_permalink(); ?>">
      <img src="<?php the_post_thumbnail_url('imovel-thumb'); ?>" alt="<?php the_title(); ?>" class="card-img-top">
    </a>
    <?php else: ?>
    <img src="<?php echo esc_url($placeholder_image); ?>" alt="<?php the_title(); ?>" class="card-img-top">
    <?php endif; ?>

    <div class="card-body">
      <h5 class="card-title">
        <a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a>
      </h5>

      <?php if ($preco = get_post_meta(get_the_ID(), 'preco', true)): ?>
      <p class="price">R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
      <?php endif; ?>

      <div class="features">
        <?php if ($area = get_post_meta(get_the_ID(), 'area', true)): ?>
        <div class="feature-item">
          <i class="fas fa-vector-square"></i>
          <span><?php echo $area; ?> m²</span>
        </div>
        <?php endif; ?>

        <?php if ($quartos = get_post_meta(get_the_ID(), 'quartos', true)): ?>
        <div class="feature-item">
          <i class="fas fa-bed"></i>
          <span><?php echo $quartos; ?></span>
        </div>
        <?php endif; ?>

        <?php if ($banheiros = get_post_meta(get_the_ID(), 'banheiros', true)): ?>
        <div class="feature-item">
          <i class="fas fa-bath"></i>
          <span><?php echo $banheiros; ?></span>
        </div>
        <?php endif; ?>
      </div>

      <a href="<?php the_permalink(); ?>" class="btn btn-details w-100">
        Ver detalhes <i class="fas fa-arrow-right" style="color: #312F2F"></i>
      </a>
    </div>
  </div>
</div>

<style>
:root {
  --primary: #312F2F;
  --secondary: #F1BE1B;
  --light: #FFFFFF;
  --dark: #312F2F;
  --warning: #F1BE1B;
  --gray-100: #f8f9fa;
  --gray-200: #e9ecef;
  --gray-300: #dee2e6;
  --gray-400: #ced4da;
  --gray-500: #adb5bd;
  --gray-600: #6c757d;
  --gray-700: #495057;
  --gray-800: #343a40;
  --gray-900: #212529;
}

/* Imóveis */
.imovel-card {
  transition: all 0.3s ease;
  border: none;
  overflow: hidden;
  position: relative;
}

.imovel-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.imovel-card .card-img-top {
  transition: transform 0.5s ease;
}

.imovel-card:hover .card-img-top {
  transform: scale(1.05);
}

.imovel-card .card-body {
  position: relative;
  z-index: 1;
}

.imovel-card .card-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.imovel-card .card-title a {
  color: #333;
  transition: color 0.3s ease;
}

.imovel-card:hover .card-title a {
  color: #007bff;
}

.imovel-card .price {
  font-size: 1.2rem;
  font-weight: 700;
  color: #28a745;
  margin-bottom: 0.5rem;
}

.imovel-card .features {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
}

.imovel-card .feature-item {
  display: flex;
  align-items: center;
  color: #6c757d;
  font-size: 0.9rem;
}

.imovel-card .feature-item i {
  margin-right: 0.5rem;
  color: #007bff;
}

.imovel-card .btn-details {
  background: var(--secondary);
  color: var(--dark);
  border: none;
  padding: 0.75rem 1.5rem;
  font-weight: 600;
  font-size: 0.95rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border-radius: 50px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(241, 190, 27, 0.3);
  position: relative;
  overflow: hidden;
}

.imovel-card .btn-details:hover {
  background: var(--secondary);
  color: var(--dark);
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(241, 190, 27, 0.4);
}

.imovel-card .btn-details::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(45deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 100%);
  transform: translateX(-100%);
  transition: transform 0.3s ease;
}

.imovel-card .btn-details:hover::before {
  transform: translateX(100%);
}

.imovel-card .btn-details i {
  margin-left: 8px;
  transition: transform 0.3s ease;
}

.imovel-card .btn-details:hover i {
  transform: translateX(5px);
}

/* Efeito de overlay na imagem */
.imovel-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.1) 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 1;
}

.imovel-card:hover::before {
  opacity: 1;
}

/* Badge de destaque */
.imovel-card .badge-destaque {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: #ffc107;
  color: #000;
  padding: 0.5rem 1rem;
  border-radius: 50px;
  font-weight: 600;
  font-size: 0.8rem;
  z-index: 2;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

/* Animação de entrada */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.imovel-card {
  animation: fadeInUp 0.5s ease forwards;
}

/* Garantir que todos os cards de imóveis tenham o mesmo tamanho */
.imovel-card {
  display: flex;
  flex-direction: column;
  height: 100%; /* Garante que todos os cards tenham a mesma altura */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
}

/* Ajustar a imagem para ter altura fixa */
.imovel-card .card-img-top {
  height: 200px; /* Define uma altura fixa para as imagens */
  object-fit: cover; /* Garante que a imagem seja cortada proporcionalmente */
  width: 100%; /* Garante que a imagem ocupe toda a largura do card */
}

/* Garantir que o conteúdo do card ocupe o restante do espaço */
.imovel-card .card-body {
  flex-grow: 1; /* Faz o conteúdo ocupar o espaço restante */
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Botão de detalhes alinhado ao final */
.imovel-card .btn-details {
  margin-top: auto; /* Empurra o botão para o final do card */
}
/* Garantir que o texto do botão quebre em telas menores */
.btn {
  white-space: normal; /* Permite que o texto quebre em várias linhas */
  word-wrap: break-word; /* Garante que palavras longas sejam quebradas */
  text-align: center; /* Centraliza o texto no botão */
}

/* Ajustar o tamanho do botão em telas menores */
@media (max-width: 576px) {
  .btn {
    font-size: 0.9rem; /* Reduz o tamanho da fonte em telas pequenas */
    padding: 0.5rem 1rem; /* Ajusta o espaçamento interno do botão */
  }
}
</style>