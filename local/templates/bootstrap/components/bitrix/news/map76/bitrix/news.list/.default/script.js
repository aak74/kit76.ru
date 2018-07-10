var myMap, 
    myPlacemark,
    geoObjects = [],
    clusterer;

var map = {

  show: function() { 

    var list = [];
    $(".filial").each(function (i, d) {
      list[i] = [];
      for (var key in d.dataset) {
        list[i][key] = d.dataset[key];
      };
    });

    // console.log("filials", list);

    // console.log("ymaps.Map", ymaps.Map);
    // console.log("ymaps.map", ymaps.map);
    // console.log("ymaps.Map.zoom", ymaps.Map.zoom);


/*    
    // Заполняем коллекцию данными.
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
            '</address>',
            '<a href="/filials/' + list[i].code + '/">Перейти</a>'
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
*/

    
      console.log(list.length);
    for (var i = 0; i < list.length; i++) {

    // for (var i = 0; i < 137; i++) {
      // if ((typeof list[i].latitude != undefined)) {
      if ((typeof list[i].latitude != undefined) && (typeof list[i].longitude != undefined)) {
/*
        geoObjects[i] = new ymaps.Placemark(
          [list[i].latitude, list[i].longitude], {
            balloonContent: list[i].name,
            hintContent: list[i].name,
            preset: 'islands#nightIcon'
          }
        );
*/        
  console.log(list[i]);
        geoObjects[i] = new ymaps.Placemark(
          [list[i].latitude, list[i].longitude], {
            balloonContentHeader: list[i].name,
            balloonContentBody: [
              '<address>',
              '<strong>Офис ТК КИТ в г. ' + list[i].name + '</strong>',
              '<br/>',
              'Адрес:' + list[i].address,
              '<br/>',
              'Телефоны:' + list[i].phones,
              '</address>',
              '<a href="/filials/' + list[i].code + '/">Перейти</a>'
            ].join(""),
            hintContent: list[i].name,
            iconLayout: 'islands#nightStretchyIcon'
          }, {
            iconLayout: 'default#image',
            iconImageClipRect: [[0,0], [32, 42]],
            iconImageHref: '/images/kitIcon' + ((list[i].isNew == 1) ? 'New' : '') + '.png',
            iconImageSize: [24, 31],
            iconImageOffset: [-12, -31]
          }
        );
      }
    }

  // console.log(geoObjects);

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

    // Добавляем коллекцию меток на карту.
    myMap.geoObjects.add(clusterer);
/*
    myMap.setBounds(clusterer.getBounds(), {
        checkZoomRange: true
    });
*/

    // myMap.geoObjects.add(myCollection);
  },

  init: function() { 
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
});