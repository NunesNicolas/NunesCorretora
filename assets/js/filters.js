jQuery(document).ready(function ($) {
  var $filterPanel = $('.property-filter-panel');
  var $filterToggle = $('.property-filter-toggle');
  var lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;

  function setMobileFilterCollapsed(collapsed) {
      if (!$filterPanel.length || window.innerWidth >= 992) {
          return;
      }

      $filterPanel.toggleClass('is-collapsed', collapsed);
      $filterToggle.attr('aria-expanded', collapsed ? 'false' : 'true');
  }

  $filterToggle.on('click', function () {
      setMobileFilterCollapsed(!$filterPanel.hasClass('is-collapsed'));
  });

  $(window).on('scroll', function () {
      var currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

      if ((!window.regianeIgnoreFilterScroll || Date.now() > window.regianeIgnoreFilterScroll) && window.innerWidth < 992 && currentScrollTop > lastScrollTop && currentScrollTop > 80) {
          setMobileFilterCollapsed(true);
      }

      lastScrollTop = Math.max(currentScrollTop, 0);
  });

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
              var payload = response.data || {};
              var html = typeof payload === 'string' ? payload : payload.html;

              $('#content_posts').html(html || '<div class="col-12"><p class="empty-state text-center">Nenhum imóvel encontrado.</p></div>');

              if (window.regianePropertyMap && typeof payload !== 'string') {
                  window.regianePropertyMap.render(payload.map_items || [], Number(payload.count || 0));
              }

              if ($('#propertyFilterCount').length && typeof payload !== 'string') {
                  $('#propertyFilterCount').text(Number(payload.count || 0) + ' imóveis');
              }
          },
          error: function () {
              $('#content_posts').html('<p class="text-center">Erro ao carregar os imóveis.</p>');
          },
      });
  });
});

jQuery(document).ready(function ($) {
  var $filterPanel = $('.property-filter-panel');
  var $filterToggle = $('.property-filter-toggle');
  var lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
  var ignoreScrollUntil = 0;

  if (!$filterPanel.length) {
    return;
  }

  $filterToggle.off('click');
  $('#filterForm').off('submit');

  function setMobileFilterCollapsed(collapsed) {
    if (window.innerWidth >= 992) {
      return;
    }

    $filterPanel.toggleClass('is-collapsed', collapsed);
    $filterToggle.attr('aria-expanded', collapsed ? 'false' : 'true');
  }

  function getPropertyFilterData(page) {
    return {
      action: 'filtrar_imoveis',
      type: $('#filterType').val(),
      price_min: $('#filterPriceMin').val(),
      price_max: $('#filterPriceMax').val(),
      bathrooms_min: $('#bathroomsMin').val(),
      bedrooms_min: $('#bedroomsMin').val(),
      garage_min: $('#garageMin').val(),
      location: $('#filterLocation').val(),
      paged: page || 1,
    };
  }

  function loadProperties(page) {
    $.ajax({
      url: regiane_vars.ajaxurl,
      type: 'POST',
      data: getPropertyFilterData(page),
      beforeSend: function () {
        $('#content_posts').html('<p class="text-center">Carregando...</p>');
      },
      success: function (response) {
        var payload = response.data || {};
        var html = typeof payload === 'string' ? payload : payload.html;

        $('#content_posts').html(html || '<div class="col-12"><p class="empty-state text-center">Nenhum imóvel encontrado.</p></div>');
        $('#propertyPagination').html(typeof payload === 'string' ? '' : (payload.pagination || ''));

        if (window.regianePropertyMap && typeof payload !== 'string') {
          window.regianePropertyMap.render(payload.map_items || [], Number(payload.count || 0));
        }

        if ($('#propertyFilterCount').length && typeof payload !== 'string') {
          $('#propertyFilterCount').text(Number(payload.count || 0) + ' imóveis');
        }
      },
      error: function () {
        $('#content_posts').html('<p class="text-center">Erro ao carregar os imóveis.</p>');
      },
    });
  }

  $filterToggle.on('click', function () {
    ignoreScrollUntil = Date.now() + 700;
    window.regianeIgnoreFilterScroll = ignoreScrollUntil;
    lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
    setMobileFilterCollapsed(!$filterPanel.hasClass('is-collapsed'));
  });

  $(window).on('scroll', function () {
    var currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (Date.now() < ignoreScrollUntil) {
      lastScrollTop = Math.max(currentScrollTop, 0);
      return;
    }

    if (window.innerWidth < 992 && currentScrollTop > lastScrollTop + 4 && currentScrollTop > 80) {
      setMobileFilterCollapsed(true);
    }

    lastScrollTop = Math.max(currentScrollTop, 0);
  });

  $('#filterForm').on('submit', function (e) {
    e.preventDefault();
    loadProperties(1);
  });

  $(document).on('click', '.property-pagination a', function (e) {
    var page = Number($(this).data('page'));

    if (!page) {
      return;
    }

    e.preventDefault();
    loadProperties(page);

    if (document.querySelector('.property-results-panel')) {
      document.querySelector('.property-results-panel').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
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
