var myMap, 
    myPlacemark;

var map = {

  show: function() { 

    var list = [];
    $(".filial").each(function (i, d) {
      list[i] = [];
      for (var key in d.dataset) {
        list[i][key] = d.dataset[key];
      };
    });

    // akop.debug.log("show list", list);

    myMap.geoObjects.removeAll();

    myCollection = new ymaps.GeoObjectCollection();

    for (var i = 0; i < list.length; i++) {
      myCollection.add(new ymaps.Placemark(
        [list[i].latitude, list[i].longitude], {
          balloonContentHeader: list[i].name,
          balloonContentBody: [
            '<address>',
            '<strong>Офис ТК КИТ в г. ' + list[i].name + '</strong>',
            '<br/>',
            'Адрес:' + list[i].address,
            '<br/>',
            'Телефоны:' + list[i].phones,
            '</address>'
          ].join(""),
          hintContent: list[i].name,
          iconLayout: 'islands#darkBlueStretchyIcon'
        }, {
          iconLayout: 'default#image',
          iconImageClipRect: [[0,0], [32, 42]],
          iconImageHref: '/images/kitIcon.png',
          iconImageSize: [24, 31],
          iconImageOffset: [-12, -31]
        }
      ));
    }

    // Добавляем коллекцию меток на карту.
    myMap.geoObjects.add(myCollection);    
  },

  init: function() { 

    var list = [];
    $(".filial").each(function (i, d) {
      list[i] = [];
      for (var key in d.dataset) {
        list[i][key] = d.dataset[key];
      };
    });

    var zoom = 14;
    if (list[0].latitude == undefined) {
      list[0].latitude = 51.233078;
      list[0].longitude = 58.525232;
      zoom = 7;
    }

    myMap = new ymaps.Map("map", {
      center: [list[0].latitude, list[0].longitude],
      zoom: zoom,
      behaviors: ['scrollZoom', 'drag', 'rightMouseButtonMagnifier'],
      controls: ['smallMapDefaultSet', 'routeEditor']
      // controls: ['mediumMapDefaultSet']
      // controls: ['largeMapDefaultSet']
      // controls: ["typeSelector"]
    }); 
    map.show();
  }
}

$(document).ready(function () {
  ymaps.ready(map.init);
  $("#address").on("blur", function(e) {
    akop.debug.log("blur e", e);
    e.preventDefault();
    $(".filial").attr("data-name", e.target.value)
    $(".filial").attr("data-address", "")
  });

});