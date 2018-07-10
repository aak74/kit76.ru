var myMap, 
    myPlacemark,
    geoObjects = [],
    clusterer;

var map = {

  showOnMap: function (e) {
    e = e || window.event;
    e.preventDefault();
    myMap.setCenter(
      [e.target.dataset["map"].split(',')[0], e.target.dataset["map"].split(',')[1]],
      10, 
      {checkZoomRange: true}
    );
  }, 

  showDetails: function (e) {
    e = e || window.event;
    e.preventDefault();
    // console.log("e", e);
    $(".filial-info").remove();
    $filial = $(e.target);
    // console.log("filial", $filial);
    // console.log("filial", $filial.data());

    var list = $filial.data();

    $filial.after(
      [
        '<div class="filial-info bg-info">',
        '<address>',
        '<h3>Офис ТК КИТ в г. ' + list.name + '</h3>',
        '<br/>',
        '<strong>Адрес:</strong> ' + list.adres,
        '<br/>',
        '<strong>Телефоны:</strong><br/>' + String(list.phone).replace(/;/g, "<br/>"),
        '</address>',
        // '<br/>',
        '<strong>Режим работы:</strong> ' + phpjs.html_entity_decode(list.regim),
        '<br/>',
        // 'Режим работы:' + eval(list.regim),
        '<strong>email:</strong>' + list.email,
        '<br/><br/>',
        '<a href="#" data-map="' + list.map + '" data-j="' + list.j + '" class="show-on-map">Показать на карте</a>',
        '<br/><br/>',
        '<a href="/f/' + list.code + '/" class="btn btn-primary">Перейти на карточку филиала</a>',
        '</div>'
      ].join(""));

    $(".show-on-map").on("click", map.showOnMap)
    // e.defaultPrevented();


  },

  show: function() { 

    // var list = [];
    var j = -1;
    $(".filial").each(function (i, d) {
      
      console.log('d.dataset["map"].length', d.dataset["map"], d.dataset["map"].length);
      if (d.dataset["map"].length > 0) {
        // j++;

        geoObjects[j++] = new ymaps.Placemark(
          [d.dataset["map"].split(',')[0], d.dataset["map"].split(',')[1]], {
            balloonContentHeader: d.dataset.name,
            balloonContentBody: [
              // '<div class="filial-info bg-info">',
              '<address>',
              '<h3>Офис ТК КИТ в г. ' + d.dataset.name + '</h3>',
              '<br/>',
              '<strong>Адрес:</strong> ' + d.dataset.adres,
              '<br/>',
              '<strong>Телефоны:</strong><br/>' + String(d.dataset.phone).replace(/;/g, "<br/>"),
              '</address>',
              // '<br/>',
              '<strong>Режим работы:</strong> ' + phpjs.html_entity_decode(d.dataset.regim),
              '<br/>',
              // 'Режим работы:' + eval(d.dataset.regim),
              '<strong>email:</strong>' + d.dataset.email,
              // '<br/><br/>',
              // '<a href="#" data-map="' + d.dataset.map + '" class="show-on-map">Показать на карте</a>',
              '<br/><br/>',
              '<a href="/f/' + d.dataset.code + '/" class="btn btn-primary">Перейти на карточку филиала</a>'
              // '</div>'
            ].join(""),
            
            hintContent: d.dataset.name,
            iconLayout: 'islands#nightStretchyIcon'
          }, {
            iconLayout: 'default#image',
            iconImageClipRect: [[0,0], [32, 42]],
            iconImageHref: '/images/kitIcon' + ((d.dataset.isNew == 1) ? 'New' : '') + '.png',
            iconImageSize: [24, 31],
            iconImageOffset: [-12, -31]
            
          }
        );
      }
      d.dataset.j = j;
      // }

      // console.log(j);
    });
    console.log(geoObjects, j);

    clusterer = new ymaps.Clusterer({
      preset: 'islands#invertedNightClusterIcons',
      groupByCoordinates: false,
      clusterDisableClickZoom: true,
      clusterHideIconOnBalloonOpen: false,
      geoObjectHideIconOnBalloonOpen: false
    }),

    clusterer.options.set({
        gridSize: 32,
        // maxZoom: 3,
        // hasBalloon:false,
        clusterDisableClickZoom: true
    });

    clusterer.add(geoObjects);

    myMap.geoObjects.add(clusterer);
      // console.log(list);
    // };

  },

  init: function() {
    $(".filials-map>div")
      .css("height", window.innerHeight - 80 + "px");
    
    $("#map")
      .css("width", parseInt($("#content-wrapper").css("width")) * 0.7 + "px");
      // .css("height", "800px");
    myMap = new ymaps.Map("map", {
      center: [60, 70],
      zoom: 4,
      behaviors: ['scrollZoom', 'drag', 'rightMouseButtonMagnifier'],
      controls: ['smallMapDefaultSet', 'routeEditor']
      // controls: ['smallMapDefaultSet']
    }); 
 
    map.show();
  }
}

$(document).ready(function () {
  ymaps.ready(map.init);

  $(".filial").on("click", map.showDetails)
  
});