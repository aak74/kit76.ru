var myMap, 
    myPlacemark,
    objectManager,
    geoObjects = [],
    clusterer;

var map = {
  listExpressRoot: [],

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
    $(".filial-info").remove();
    $filial = $(e.target);

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
        '<strong>Режим работы:</strong> ' + phpjs.html_entity_decode(list.regim),
        '<br/>',
        '<strong>email:</strong>' + list.email,
        '<br/><br/>',
        '<a href="#" data-map="' + list.map + '" data-j="' + list.j + '" class="show-on-map">Показать на карте</a>',
        '<br/><br/>',
        '<a href="/f/' + list.code + '/" class="btn btn-primary">Перейти на карточку филиала</a>',
        '</div>'
      ].join(""));

    $(".show-on-map").on("click", map.showOnMap)
  },

  show: function() { 
    objectManager = new ymaps.ObjectManager({
      clusterize: true,
      geoObjectOpenBalloonOnClick: true,
      clusterOpenBalloonOnClick: true,
      clusterDisableClickZoom: true,
      clusterHideIconOnBalloonOpen: false,
    });

    objectManager.clusters.options.set('preset', 'islands#invertedNightClusterIcons');

    objectManager.objects.options.set({
      iconLayout: 'default#image',
      iconImageClipRect: [[0,0], [32, 42]],
      iconImageHref: '/images/kitIcon.png',
      iconImageSize: [24, 31],
      iconImageOffset: [-12, -31]
    });
    myMap.geoObjects.add(objectManager);   

    var j = -1;
    $(".filial").each(function (i, d) {
      if (d.dataset["map"].length > 0) {
        objectManager.add({
          "type": "Feature", 
          "id": j, 
          "geometry": {
            "type": "Point", 
            "coordinates": [d.dataset["map"].split(',')[0], d.dataset["map"].split(',')[1]]
          },
          "properties": {
            balloonContentHeader: d.dataset.name,
            balloonContentBody: [
              '<address>',
              '<h3>Офис и склад ТК КИТ в г. ' + d.dataset.name + '</h3>',
              '<br/>',
              '<strong>Адрес:</strong> ' + d.dataset.adres,
              '<br/>',
              '<strong>Телефоны:</strong><br/>' + String(d.dataset.phone).replace(/;/g, "<br/>"),
              '</address>',
              '<strong>Режим работы:</strong> ' + phpjs.html_entity_decode(d.dataset.regim),
              '<br/>',
              '<strong>email:</strong>' + d.dataset.email,
              '<br/><br/>',
              '<a href="/f/' + d.dataset.code + '/" class="btn btn-primary">Перейти на карточку филиала</a>'
            ].join(""),
            
            hintContent: d.dataset.name,
            iconLayout: 'islands#nightStretchyIcon'
          }
        });
          

        j++;
      }
      d.dataset.j = j;
    });
  },

  setSizeIcon: function(mapZoom) {
    console.log("setSizeIcon", mapZoom);
   
    if(mapZoom <= 7) {
      objectManager.options.set('preset', 'islands#greenDotIcon');
    }
    if(mapZoom>=10){
    }
  },

  init: function() {
    $(".filials-map>div")
      .css("height", window.innerHeight - 80 + "px");
    
    $("#map")
      .css("width", parseInt($("#content-wrapper").css("width")) * 0.7 + "px");
    myMap = new ymaps.Map("map", {
      center: [60, 70],
      zoom: 4,
      behaviors: ['scrollZoom', 'drag', 'rightMouseButtonMagnifier'],
      controls: ['smallMapDefaultSet', 'routeEditor']
    }); 
 
    myMap.events.add('boundschange', function (e) {
      console.log("boundschange", e);
      if (e.get('oldZoom') != e.get('newZoom')) {
        map.setSizeIcon(e.get('newZoom'));
      }
    });
    map.show();
  }
}

$(document).ready(function () {

  $('.filial[data-addr!=""]').each(function (i, d) {
    // console.log(d.dataset.addr);
    // console.log($('.filial[data-id="' + d.dataset.addr + '"]'));
    if (d.dataset.addr != 0) {
      if (map.listExpressRoot[d.dataset.addr] == undefined) {
        map.listExpressRoot[d.dataset.addr] = $('.filial[data-id="' + d.dataset.addr + '"]')[0].dataset;
      }
      d.dataset.phone = map.listExpressRoot[d.dataset.addr].phone;
      d.dataset.email = map.listExpressRoot[d.dataset.addr].email;
      d.dataset.regim = map.listExpressRoot[d.dataset.addr].regim;
      d.dataset.adres = "Адресная доставка из г." + map.listExpressRoot[d.dataset.addr].name;
    }
  });
  
  ymaps.ready(map.init);

  $(".filial").on("click", map.showDetails)
  
});