(function () {
  function formatPrice(value) {
    var price = Number(value);

    if (!price) {
      return '';
    }

    return price.toLocaleString('pt-BR', {
      style: 'currency',
      currency: 'BRL',
    });
  }

  function parseItems(mapEl) {
    try {
      return JSON.parse(mapEl.dataset.items || '[]');
    } catch (error) {
      return [];
    }
  }

  function updateCounters(total, mapped) {
    var resultCount = document.getElementById('propertyResultCount');
    var mapCount = document.getElementById('propertyMapCount');
    var resultLabel = document.getElementById('propertyResultLabel');

    if (resultCount) {
      resultCount.textContent = total;
    }

    if (mapCount) {
      mapCount.textContent = mapped;
    }

    if (resultLabel) {
      resultLabel.textContent = total + ' resultado(s)';
    }
  }

  function createMap() {
    var mapEl = document.getElementById('propertyMap');

    if (!mapEl || typeof L === 'undefined' || window.matchMedia('(max-width: 991.98px)').matches) {
      return null;
    }

    var defaultCenter = [-3.7319, -38.5267];
    var map = L.map(mapEl, {
      scrollWheelZoom: false,
    }).setView(defaultCenter, 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap',
    }).addTo(map);

    var markerLayer = L.layerGroup().addTo(map);
    var areaLayer = L.layerGroup().addTo(map);

    function focusArea(area) {
      if (!area) {
        return;
      }

      areaLayer.clearLayers();

      if (area.bounds && area.bounds.length === 2) {
        var bounds = L.latLngBounds(area.bounds);
        map.fitBounds(bounds.pad(0.12), { maxZoom: 15 });
        L.rectangle(bounds, {
          color: '#f1be1b',
          weight: 2,
          fillColor: '#f1be1b',
          fillOpacity: 0.10,
        }).addTo(areaLayer);
      } else if (area.lat && area.lng) {
        var center = [Number(area.lat), Number(area.lng)];
        map.setView(center, 13);
        L.circle(center, {
          radius: 1800,
          color: '#f1be1b',
          weight: 2,
          fillColor: '#f1be1b',
          fillOpacity: 0.12,
        }).addTo(areaLayer);
      }
    }

    function render(items, total) {
      markerLayer.clearLayers();
      areaLayer.clearLayers();

      var bounds = [];

      items.forEach(function (item) {
        if (!item.lat || !item.lng) {
          return;
        }

        var marker = L.marker([item.lat, item.lng]).addTo(markerLayer);
        var price = formatPrice(item.price);
        var popup = '<strong>' + item.title + '</strong>';

        if (item.address) {
          popup += '<br>' + item.address;
        }

        if (price) {
          popup += '<br><span>' + price + '</span>';
        }

        popup += '<br><a href="' + item.url + '">Ver detalhes</a>';
        marker.bindPopup(popup);
        bounds.push([item.lat, item.lng]);
      });

      if (bounds.length) {
        var groupBounds = L.latLngBounds(bounds);
        map.fitBounds(groupBounds.pad(0.25), { maxZoom: 14 });
        var northEast = groupBounds.getNorthEast();
        var southWest = groupBounds.getSouthWest();
        var radius = groupBounds.getCenter().distanceTo(northEast);

        L.circle(groupBounds.getCenter(), {
          radius: Math.max(900, radius),
          color: '#f1be1b',
          weight: 2,
          fillColor: '#f1be1b',
          fillOpacity: 0.12,
        }).addTo(areaLayer);
      } else {
        map.setView(defaultCenter, 11);
        L.circle(defaultCenter, {
          radius: 12000,
          color: '#f1be1b',
          weight: 2,
          fillColor: '#f1be1b',
          fillOpacity: 0.12,
        }).addTo(areaLayer);
      }

      updateCounters(total, bounds.length);
      setTimeout(function () {
        map.invalidateSize();
      }, 120);
    }

    render(parseItems(mapEl), Number(mapEl.dataset.total || 0));

    return {
      render: render,
      focusArea: focusArea,
    };
  }

  document.addEventListener('DOMContentLoaded', function () {
    window.regianePropertyMap = createMap();
  });
})();
