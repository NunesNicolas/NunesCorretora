jQuery(document).ready(function ($) {
  $('#filterForm').on('submit', function (e) {
      e.preventDefault();

      var formData = {
          action: 'filtrar_imoveis',
          type: $('#filterType').val(),
          price_min: $('#filterPriceMin').val(),
          price_max: $('#filterPriceMax').val(),
          bathrooms_min: $('#bathroomsMin').val(),
          bedrooms_min: $('#bedroomsMin').val(),
          garage_min: $('#garageMin').val(),
          location: $('#filterLocation').val(),
      };
      $.ajax({
          url: regiane_vars.ajaxurl,
          type: 'POST',
          data: formData,
          beforeSend: function () {
              $('#content_posts').html('<p class="text-center">Carregando...</p>');
          },
          success: function (response) {
              if (response.success) {
                  $('#content_posts').html(response.data);
              } else {
                  $('#content_posts').html(response.data);
              }
          },
          error: function () {
              $('#content_posts').html('<p class="text-center">Erro ao carregar os imóveis.</p>');
          },
      });
  });
});

jQuery(document).ready(function ($) {
  const arr = [];
  $(".btn-filter").click(function () {
    filter = $(this).data("filter");
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      arr.splice(arr.indexOf(filter), 1);
    } else {
      $(this).addClass("active");
      arr.push(filter);
    }
    $("#filters-publications").trigger("change");
  });

  $("#filters-publications").change(function (event) {
    event.preventDefault();
    console.log('FormData:', formData);
    $.ajax({
      type: "POST",
      url: frontend_ajax_object.ajaxurl,
      data: {
        category: arr,
        action: "filter_publications",
        search: $("#search").val(),
        tipo: $("#tipo").val(),
        de: $("#de").val(),
        ate: $("#ate").val(),
      },
      dataType: "html",
      success: function (data) {
        $("#content_posts").html(data);
      },
    });
  });

  $("#filters-videos-red").change(function (event) {
    event.preventDefault();
    filterVideos();
  });

  if ($("#programa").val() != "" && $("#programa").val() != null) {
    filterVideos();
  }

  $("#filters-videos-parceiros").change(function (event) {
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: frontend_ajax_object.ajaxurl,
      data: {
        action: "filter_videos_parceiros",
        search: $("#search").val(),
        programa: $("#programa").val(),
        de: $("#de").val(),
        ate: $("#ate").val(),
      },
      dataType: "html",
      success: function (data) {
        $("#result-parceiro").html(data);
      },
    });
  });
});

$("#filters-podcasts").change(function (event) {
  event.preventDefault();
  $.ajax({
    type: "POST",
    url: frontend_ajax_object.ajaxurl,
    data: {
      action: "filter_podcasts",
      search: $("#search").val(),
      programa: $("#programa").val(),
      de: $("#de").val(),
      ate: $("#ate").val(),
    },
    dataType: "html",
    success: function (data) {
      $("#result").html(data);
    },
  });
});

function vai(dados) {
  var exibir = dados.dataset.exibir;
  var posttype = dados.dataset.posttype;
  $.ajax({
    type: "POST",
    url: frontend_ajax_object.ajaxurl,
    data: {
      action: "filter_show_more",
      post_type: posttype,
      exibir: exibir,
    },
    dataType: "html",
    success: function (data) {
      if (posttype == "post") {
        $("#result-red").html(data);
      } else if (posttype == "video-parceiro") {
        $("#result-parceiro").html(data);
      } else if (posttype == "podcast") {
        $("#result").html(data);
      } else {
        $("#content_posts").html(data);
      }
    },
  });
}

function changeThumbToVideo(thumb) {
  thumb.innerHTML =
    "<iframe loading='lazy' scrolling='no' width='100%' height='100' src='https://www.youtube.com/embed/" +
    thumb.dataset.videoid +
    "' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
}

function filterVideos() {
  $.ajax({
    type: "POST",
    url: frontend_ajax_object.ajaxurl,
    data: {
      action: "filter_videos_red",
      search: $("#search_red").val(),
      programa: $("#programa").val(),
      de: $("#de_red").val(),
      ate: $("#ate_red").val(),
    },
    dataType: "html",
    success: function (data) {
      $("#result-red").html(data);
    },
  });
}
