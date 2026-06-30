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

  var locationSuggestions = Array.isArray(regiane_vars.locations) ? regiane_vars.locations : [];
  var userPosition = null;
  var selectedMapArea = null;
  var locationSearchTimer = null;
  var locationSearchController = null;

  function normalizeText(value) {
    return String(value || '').normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
  }

  function escapeHtml(value) {
    return String(value || '').replace(/[&<>"']/g, function (character) {
      return {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
      }[character];
    });
  }

  function getDistanceInKm(location) {
    if (!userPosition || location.lat === null || location.lng === null || typeof location.lat === 'undefined' || typeof location.lng === 'undefined') {
      return null;
    }

    var earthRadius = 6371;
    var dLat = (Number(location.lat) - userPosition.lat) * Math.PI / 180;
    var dLng = (Number(location.lng) - userPosition.lng) * Math.PI / 180;
    var lat1 = userPosition.lat * Math.PI / 180;
    var lat2 = Number(location.lat) * Math.PI / 180;
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(lat1) * Math.cos(lat2) *
      Math.sin(dLng / 2) * Math.sin(dLng / 2);

    return earthRadius * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  }

  function getLocationLabel(location) {
    return String(location.label || location.value || location.display_name || location.name || location);
  }

  function getLocationFilterValue(location) {
    return String(location.filterValue || location.value || location.name || location.label || location.display_name || location);
  }

  function getLocationBounds(location) {
    if (location.bounds) {
      return location.bounds;
    }

    if (location.boundingbox && location.boundingbox.length === 4) {
      return [
        [Number(location.boundingbox[0]), Number(location.boundingbox[2])],
        [Number(location.boundingbox[1]), Number(location.boundingbox[3])]
      ];
    }

    return null;
  }

  function getStateCode(stateName) {
    var states = {
      'acre': 'AC',
      'alagoas': 'AL',
      'amapa': 'AP',
      'amazonas': 'AM',
      'bahia': 'BA',
      'ceara': 'CE',
      'distrito federal': 'DF',
      'espirito santo': 'ES',
      'goias': 'GO',
      'maranhao': 'MA',
      'mato grosso': 'MT',
      'mato grosso do sul': 'MS',
      'minas gerais': 'MG',
      'para': 'PA',
      'paraiba': 'PB',
      'parana': 'PR',
      'pernambuco': 'PE',
      'piaui': 'PI',
      'rio de janeiro': 'RJ',
      'rio grande do norte': 'RN',
      'rio grande do sul': 'RS',
      'rondonia': 'RO',
      'roraima': 'RR',
      'santa catarina': 'SC',
      'sao paulo': 'SP',
      'sergipe': 'SE',
      'tocantins': 'TO'
    };
    var normalized = normalizeText(stateName);

    return states[normalized] || stateName || '';
  }

  function formatSuggestionMeta(location) {
    var stateCode = getStateCode(location.state || '');
    var city = location.city || '';

    if (location.type === 'cidade') {
      return stateCode;
    }

    if (city && stateCode) {
      return city + ' - ' + stateCode;
    }

    return city || stateCode || '';
  }

  function makeRemoteLocation(result) {
    var address = result.address || {};
    var name = address.suburb || address.neighbourhood || address.city_district || address.town || address.city || address.village || result.name || result.display_name;
    var city = address.city || address.town || address.village || address.municipality || '';
    var state = address.state || '';

    return {
      label: name,
      value: name,
      filterValue: name,
      type: address.suburb || address.neighbourhood || address.city_district ? 'bairro' : 'cidade',
      city: city,
      state: state,
      lat: Number(result.lat),
      lng: Number(result.lon),
      bounds: getLocationBounds(result),
      source: 'map',
    };
  }

  function renderLocationSuggestions(searchTerm, remoteLocations) {
    var $suggestions = $('#propertyLocationSuggestions');

    if (!$suggestions.length) {
      return;
    }

    var normalizedTerm = normalizeText(searchTerm);
    var typePriority = { bairro: 0, cidade: 1, endereco: 2 };
    var localMatches = locationSuggestions
      .filter(function (location) {
        var label = getLocationLabel(location);
        return !normalizedTerm || normalizeText(label).indexOf(normalizedTerm) !== -1;
      })
      .map(function (location) {
        return Object.assign({}, location, {
          distance: getDistanceInKm(location),
          source: 'site',
        });
      });
    var matches = (remoteLocations || []).concat(localMatches)
      .sort(function (a, b) {
        if (a.distance !== null && b.distance !== null && a.distance !== b.distance) {
          return a.distance - b.distance;
        }

        if (a.distance !== null && b.distance === null) {
          return -1;
        }

        if (a.distance === null && b.distance !== null) {
          return 1;
        }

        var priorityA = Object.prototype.hasOwnProperty.call(typePriority, a.type) ? typePriority[a.type] : 9;
        var priorityB = Object.prototype.hasOwnProperty.call(typePriority, b.type) ? typePriority[b.type] : 9;

        if (priorityA !== priorityB) {
          return priorityA - priorityB;
        }

        return (b.count || 0) - (a.count || 0);
      })
      .slice(0, 12);

    if (!matches.length || !normalizedTerm) {
      $suggestions.removeClass('is-open').empty();
      return;
    }

    $suggestions.html(matches.map(function (location, index) {
      var label = getLocationLabel(location);
      var meta = formatSuggestionMeta(location);
      var distance = location.distance !== null && typeof location.distance !== 'undefined'
        ? ' · ' + location.distance.toFixed(location.distance < 10 ? 1 : 0) + ' km'
        : '';

      return '<button type="button" class="location-suggestion-item" data-index="' + index + '">' +
        '<span>' + escapeHtml(label) + '</span>' +
        '<small>' + escapeHtml((meta || '') + distance) + '</small>' +
        '</button>';
    }).join(''));
    $suggestions.data('locations', matches).addClass('is-open');
  }

  function searchMapLocations(searchTerm) {
    if (!searchTerm || normalizeText(searchTerm).length < 3) {
      renderLocationSuggestions(searchTerm, []);
      return;
    }

    if (locationSearchController) {
      locationSearchController.abort();
    }

    locationSearchController = new AbortController();

    var params = new URLSearchParams({
      format: 'jsonv2',
      addressdetails: '1',
      limit: '8',
      countrycodes: 'br',
      q: searchTerm,
    });

    if (userPosition) {
      var delta = 0.8;
      params.set('viewbox', [
        userPosition.lng - delta,
        userPosition.lat + delta,
        userPosition.lng + delta,
        userPosition.lat - delta
      ].join(','));
      params.set('bounded', '0');
    }

    fetch('https://nominatim.openstreetmap.org/search?' + params.toString(), {
      signal: locationSearchController.signal,
      headers: {
        'Accept': 'application/json',
      },
    })
      .then(function (response) {
        if (!response.ok) {
          return [];
        }

        return response.json();
      })
      .then(function (results) {
        var remoteLocations = (results || []).map(makeRemoteLocation).map(function (location) {
          return Object.assign(location, { distance: getDistanceInKm(location) });
        });

        renderLocationSuggestions(searchTerm, remoteLocations);

      })
      .catch(function (error) {
        if (error.name !== 'AbortError') {
          renderLocationSuggestions(searchTerm, []);
        }
      });
  }

  if (navigator.geolocation && window.isSecureContext) {
    navigator.geolocation.getCurrentPosition(function (position) {
      userPosition = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
      };
      renderLocationSuggestions($('#filterLocation').val());
    }, function () {}, {
      maximumAge: 300000,
      timeout: 4000,
    });
  }

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

          if (selectedMapArea && typeof window.regianePropertyMap.focusArea === 'function') {
            window.regianePropertyMap.focusArea(selectedMapArea);
          }
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

  $('#filterLocation').on('input', function () {
    var value = $(this).val();
    selectedMapArea = null;
    window.clearTimeout(locationSearchTimer);
    renderLocationSuggestions(value, []);
    locationSearchTimer = window.setTimeout(function () {
      searchMapLocations(value);
    }, 350);
  });

  $('#filterLocation').on('change', function () {
    if ($(this).val().trim().length >= 3) {
      loadProperties(1);
    }
  });

  $(document).on('click', '.location-suggestion-item', function () {
    var locations = $('#propertyLocationSuggestions').data('locations') || [];
    var location = locations[Number($(this).data('index'))];

    if (!location) {
      return;
    }

    $('#filterLocation').val(getLocationFilterValue(location));
    $('#propertyLocationSuggestions').removeClass('is-open').empty();
    selectedMapArea = {
      lat: location.lat,
      lng: location.lng,
      bounds: getLocationBounds(location),
    };

    loadProperties(1);
  });

  $(document).on('click', function (event) {
    if (!$(event.target).closest('.filter-field-location').length) {
      $('#propertyLocationSuggestions').removeClass('is-open');
    }
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
