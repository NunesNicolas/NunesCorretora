jQuery(document).ready(function ($) {
  /* Configurações DatePicker */
  $.datepicker.regional["pt-BR"] = {
    closeText: "Fechar",
    prevText: "&#x3c;Anterior",
    nextText: "Pr&oacute;ximo&#x3e;",
    currentText: "Hoje",
    monthNames: [
      "Janeiro",
      "Fevereiro",
      "Mar&ccedil;o",
      "Abril",
      "Maio",
      "Junho",
      "Julho",
      "Agosto",
      "Setembro",
      "Outubro",
      "Novembro",
      "Dezembro",
    ],
    monthNamesShort: [
      "Jan",
      "Fev",
      "Mar",
      "Abr",
      "Mai",
      "Jun",
      "Jul",
      "Ago",
      "Set",
      "Out",
      "Nov",
      "Dez",
    ],
    dayNames: [
      "Domingo",
      "Segunda-feira",
      "Ter&ccedil;a-feira",
      "Quarta-feira",
      "Quinta-feira",
      "Sexta-feira",
      "Sabado",
    ],
    dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
    dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
    weekHeader: "Sm",
    dateFormat: "dd/mm/yy",
    firstDay: 0,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: "",
  };
  $.datepicker.setDefaults($.datepicker.regional["pt-BR"]);
  $("#de").datepicker();
  $("#ate").datepicker();
  $("#de_red").datepicker();
  $("#ate_red").datepicker();

  resize();

  $(".navbar-toggler-icon").click(function () {
    $(".background-menu").toggle("slow");
  });

  $(".single-publicacoes .notice-pd-right img").click(function (e) {
    $(".img-giant").css("display", "flex");
    $(".img-giant img").attr("src", $(this).attr("src"));
    $("html, body").css("overflowY", "hidden");
  });
  $(".img-giant").click(function () {
    $(this).toggle();
    $("html, body").css("overflowY", "auto");
  });
  $(".carousel-youtube").owlCarousel({
    onDragged: callback,
    loop: true,
    margin: 0,
    dots: false,
    center: true,
    items: 1,
    autoplay: true,
    autoplayTimeout: 12000,
  });
  $(".carousel-youtube .thumb-youtube").on("click", function () {
    var owl = $(".carousel-youtube");
    owl.trigger("stop.owl.autoplay");
  });
  $(".footer-supporters").owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    items: 1,
    center: true,
  });
  $(".partners-owl").owlCarousel({
    loop: true,
    nav: false,
    dots: false,
    center: true,
    autoWidth: true,
    margin: 20,
    responsive: {
      0: {
        items: 2,
        center: true,
      },
      700: {
        items: 3,
      },
      900: {
        items: 4,
      },
      1000: {
        items: 5,
      },
    },
  });
  $(".partners_owl_mobile").owlCarousel({
    loop: true,
    margin: 20,
    nav: false,
    dots: false,
    center: true,
    items: 2,
  });

  $(".owl-categorys").owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    dots: false,
    center: true,
    autoWidth: true,
  });
  $(".owl-programas").owlCarousel({
    loop: true,
    margin: 20,
    nav: false,
    dots: true,
    center: true,
    autoWidth: true,
  });
  $(".owl-employees").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    center: true,
    items: 3,
    autoWidth: true,
  });
  $(".owl-programas-home").owlCarousel({
    items: 1,
    loop: true,
    nav: false,
    dots: false,
    center: true,
  });
  $(".owl-noticias-home").owlCarousel({
    items: 1,
    loop: true,
    nav: false,
    dots: true,
    center: true,
    autoplay: true,
    autoplayTimeout: 12000,
    autoplayHoverPause: true,
  });
  $(".owl-noticias-destaque").owlCarousel({
    items: 1,
    loop: true,
    nav: true,
    dots: true,
    center: true,
    autoplay: true,
    autoplayTimeout: 12000,
    autoplayHoverPause: true,
  });
  /*  $(".owl-noticias-home").owlCarousel({
     items: 1,
     loop: true,
     nav: true,
     dots: true,
     center: true,
     autoplay: true,
     autoplayTimeout: 3800,
     autoplayHoverPause: true,
   }); */
  $(".owl-banners-home").owlCarousel({
    items: 1,
    loop: true,
    nav: true,
    dots: true,
    center: true,
    autoplay: true,
    autoplayTimeout: 12000,
    autoplayHoverPause: true,
  });
  $(".owl-videos-partners").owlCarousel({
    items: 2,
    loop: true,
    margin: 20,
    nav: false,
    dots: true,
    center: true,
    autoWidth: true,
  });
  $(".newsletter-form").submit(function (event) {
    event.preventDefault();
    var content = $(this).serializeArray();
    $(this).trigger("reset");
    $.ajax({
      type: "POST",
      url: frontend_ajax_object.ajaxurl,
      data: content,
      success: function (data) {
        if (data.code == 200) {
          $("#sucessNewsletter").modal("show");
        } else {
          $("#sucessError").modal("show");
        }
      },
    });
  });
  $("#contact-form").submit(function (event) {
    $("#contact-form #result").hide();
    $("#contact-form #result").removeClass("alert alert-danger");
    $("#contact-form #result").removeClass("alert alert-success");
    event.preventDefault();
    var content = $(this).serializeArray();
    $(this).trigger("reset");
    $.ajax({
      type: "POST",
      url: frontend_ajax_object.ajaxurl,
      data: content,
      success: function (data) {
        if (data.code == 200) {
          $("#contact-form #result").show();
          $("#contact-form #result").addClass("alert alert-success");
          $("#contact-form #result").text("Recebemos Sua Mensagem, Obrigado");
        } else {
          $("#contact-form #result").show();
          $("#contact-form #result").addClass("alert alert-danger");
          $("#contact-form #result").text(
            "Não foi possivel atender sua solicitação"
          );
        }
      },
    });
  });
});

$("#index0").click();
function sliderFunctions(index) {
  $(".owl-programas-home").trigger("to.owl.carousel", [index, 500, true]);
  $(".img-slider-left").removeClass("img-active");
  $("#index" + index).addClass("img-active");
}

var counter = 0;

function callback(event) {
  var direction = event.relatedTarget["_drag"]["direction"];
  if (direction == "right") {
    slideLeft(true);
  } else {
    slideRight(true);
  }
}

$(".button_cx2").click(function () {
  slideRight();
});

$(".button_cx1").click(function () {
  slideLeft();
});

function slideRight(skip = false) {
  if (!skip) {
    $(".carousel-youtube").trigger("next.owl.carousel");
  }
}

function slideLeft(skip = false) {
  if (!skip) {
    $(".carousel-youtube").trigger("prev.owl.carousel");
  }
}

function copiarPix(event) {
  let textoCopiado = document.getElementById("codigopix");
  textoCopiado.select();
  textoCopiado.setSelectionRange(0, 99999);
  document.execCommand("copy");
  alert("Copiado com Sucesso");
}

$(window).resize(function () {
  resize();
});

function resize() {
  if (screen.width <= 990) {
    $(".navbar-collapse").removeClass("navbar-desktop");
    $(".navbar-collapse").addClass("navbar-mobile");
  } else {
    $(".navbar-collapse").removeClass("navbar-mobile");
    $(".navbar-collapse").addClass("navbar-desktop");
    $(".background-menu").hide();
  }

  if ($(".navbar-mobile").is(":visible")) {
    $(".background-menu").show();
  }
}

function goProgram(title, location) {
  window.location.href = location + "?title=" + title;
}




function checkLiked() {
  var likes = JSON.parse(localStorage.getItem('likes')) || [];
  var check = likes.includes(postagem_id);
  if (check) {
    $(".btnLike").addClass('active');
    $(".btnLike").prop('onclick', null); // Removes 'onclick' property if found

  }
}

if (typeof postagem_id !== 'undefined') {
  checkLiked(postagem_id);
}

function liked(event) {
  var a = [];
  var postid = $(event).data("postid");
  a = JSON.parse(localStorage.getItem('likes')) || [];
  a.push(postid);
  localStorage.setItem('likes', JSON.stringify(a));
  if (a.length > 0) {
    var content = { postid: postid, action: 'like_post' };
    $.ajax({
      type: "POST",
      url: frontend_ajax_object.ajaxurl,
      data: content,
      success: function (data) {
        $(event).addClass('active');
        $('#numeroCurtidas').html(data.result);
        $(event).prop('onclick', null); // Removes 'onclick' property if found
      },
    });
  }
}

// POP-UP
document.addEventListener("DOMContentLoaded", function () {
  const popup = document.querySelector(".popup");

  // Verificar se o pop-up já foi exibido antes
  if (!sessionStorage.getItem("popupShown")) {
    popup.style.display = "block";

    // Definir um item no localStorage para indicar que o pop-up já foi exibido
    sessionStorage.setItem("popupShown", true);
  }

  // Fechar o pop-up ao clicar na imagem ou no botão de fechar
  document.addEventListener("click", function (event) {
    if (
      event.target.classList.contains("close-button") ||
      event.target.closest(".popup img")
    ) {
      popup.style.display = "none";
    }
  });
});

// Condicional para resolver o problema da palavra programa no header quando traduzido

document.addEventListener('DOMContentLoaded', function () {
  // Função para atualizar o texto do link com base na linguagem atual
  function updateProgramsLinkText() {
    var gtranslateLink = document.querySelector('.glink.gt-current-lang');
    var programsLink = document.getElementById('programs-conditions');

    if (gtranslateLink && programsLink) {
      if (gtranslateLink.innerHTML === 'ES') {
        programsLink.textContent = 'Los Programas';
      } else if (gtranslateLink.innerHTML === 'EN') {
        programsLink.textContent = 'Programs';
      } else {
        // Para outros idiomas, atualizar conforme necessário.
        // Por exemplo, se for 'PT', definir para 'Os Programas'.
        programsLink.textContent = 'Programas'; // Defina como desejar.
      }
    }
  }

  // Observador de mutação para detectar mudanças na classe "gt-current-lang"
  var observer = new MutationObserver(function (mutationsList, observer) {
    updateProgramsLinkText();
  });

  // Opções de observação para monitorar alterações na classe do elemento
  var observerConfig = { attributes: true, childList: false, subtree: true };

  // Elemento alvo para observar as mudanças
  var targetNode = document.querySelector('html');

  // Iniciar a observação
  observer.observe(targetNode, observerConfig);

  // Atualizar o texto do link inicialmente
  updateProgramsLinkText();

  $(".owl-videos-campanha").owlCarousel({
    items: 1,
    loop: true,
    nav: true,
    dots: false,
    autoplay: false,
  });

  $('.category-button').on('click', function () {
    var category = $(this).data('category');
    
    $('.category-button').removeClass('category-button-selected');
    $(this).addClass('category-button-selected');

    var args_videos = {
      'post_type': 'videos_campanha',
      'posts_per_page': -1,
      'meta_query': {
        'key': 'video_category',
        'value': category,
        'compare': 'LIKE',
      },
    };

    $.ajax({
      url: frontend_ajax_object.ajaxurl,
      type: 'POST',
      data: {
        action: 'filter_videos_campaign',
        category: category
      },
      success: function (response) {
        $('.videos-da-campanha').html(response);
        $(".owl-videos-campanha").owlCarousel({
          items: 1,
          loop: true,
          nav: true,
          dots: false,
          autoplay: false,
        });
      },
      error: function (error) {
        console.error('Erro ao filtrar vídeos: ', error);
      }
    });
  });



});