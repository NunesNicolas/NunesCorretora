// Efeito de scroll no header
document.addEventListener('DOMContentLoaded', function() {
  const navbar = document.querySelector('#main-header .navbar');
  
  if (navbar) {
      window.addEventListener('scroll', function() {
          if (window.scrollY > 50) {
              navbar.classList.add('scrolled');
          } else {
              navbar.classList.remove('scrolled');
          }
      });
  }
});

document.addEventListener('DOMContentLoaded', function() {
  const header = document.querySelector('#main-header .navbar');
  
  if(header) {
      window.addEventListener('scroll', function() {
          if(window.scrollY > 50) {
              header.classList.add('scrolled');
          } else {
              header.classList.remove('scrolled');
          }
      });
  }
  
  // Inicializa tooltips do Bootstrap
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});

jQuery(document).ready(function($) {
  // Efeito de scroll no header
  $(window).scroll(function() {
      if ($(this).scrollTop() > 50) {
          $('#main-header .navbar').addClass('scrolled');
      } else {
          $('#main-header .navbar').removeClass('scrolled');
      }
  });
  
  // Carrega os imóveis via AJAX se não houver nenhum
  if ($('#featured-properties').children().length === 1) {
      $.ajax({
          url: regiane_vars.ajaxurl,
          type: 'POST',
          data: {
              action: 'load_featured_properties'
          },
          success: function(response) {
              if (response.success) {
                  $('#featured-properties').html(response.data);
              }
          }
      });
  }
  
  // Tooltips
  $('[data-bs-toggle="tooltip"]').tooltip();
  
  // Formulário de contato
  $('#contact-form').on('submit', function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      
      $.ajax({
          url: regiane_vars.ajaxurl,
          type: 'POST',
          data: formData + '&action=regiane_contact_form',
          beforeSend: function() {
              $('#contact-form button').prop('disabled', true).html('Enviando...');
          },
          success: function(response) {
              if (response.success) {
                  $('#contact-form').html('<div class="alert alert-success">' + response.data + '</div>');
              } else {
                  $('#contact-form').prepend('<div class="alert alert-danger">' + response.data + '</div>');
                  $('#contact-form button').prop('disabled', false).html('Enviar mensagem');
              }
          }
      });
  });
  
  // Animação ao scroll
  $(window).on('scroll', function() {
      $('.animate-on-scroll').each(function() {
          var position = $(this).offset().top;
          var scroll = $(window).scrollTop();
          var windowHeight = $(window).height();
          
          if (scroll > position - windowHeight + 200) {
              $(this).addClass('animated');
          }
      });
  });
});