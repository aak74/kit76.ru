var myMap, 
    // geoObjects = [],
    // clusterer,
    myCollection,
    myPlacemark;

var map = {

  show: function() { 
    $(".filial").each(function (i, d) {
      if (d.dataset["map"].length > 0) {

        myMap.setCenter(
          [d.dataset["map"].split(',')[0], d.dataset["map"].split(',')[1]],
          13, 
          {checkZoomRange: true}
        );
        // myMap = new ymaps.Map("map", {
        //   center: [d.dataset["map"].split(',')[0], d.dataset["map"].split(',')[1]],
        //   zoom: 13,
        //   behaviors: ['scrollZoom', 'drag', 'rightMouseButtonMagnifier'],
        //   controls: ['smallMapDefaultSet', 'routeEditor']
        // }); 

        myCollection = new ymaps.GeoObjectCollection();

        myCollection.add(new ymaps.Placemark(
          [d.dataset["map"].split(',')[0], d.dataset["map"].split(',')[1]], {
            // balloonContentHeader: d.dataset.name,
            hintContent: "ТК КИТ-" + d.dataset.name + ", " + d.dataset.adres,
            iconLayout: 'islands#nightStretchyIcon'
          },
           {
            iconLayout: 'default#image',
            iconImageClipRect: [[0,0], [32, 42]],
            iconImageHref: '/images/kitIcon.png',
            iconImageSize: [24, 31],
            iconImageOffset: [-12, -31]
          }
        ));
        myMap.geoObjects.add(myCollection);    
      }
    });
    
  },

  init: function() { 
    myMap = new ymaps.Map("map", {
      center: [57.673293999992, 39.83873782209],
      zoom: 5,
      behaviors: ['scrollZoom', 'drag', 'rightMouseButtonMagnifier'],
      controls: ['smallMapDefaultSet', 'routeEditor']
    }); 

    myMap.events.add('boundschange', function (e) {
      console.log("boundschange", e);
      if (e.get('oldZoom') != e.get('newZoom')){
/*        
        getSizeFlag(e.get('newZoom'),arPlacemark);
        if (e.get('newZoom') >= 7){
          for (cluster in arClasters){
            arClasters[cluster].options.set({groupByCoordinates:true});
          }
        }else{
          for (cluster in arClasters){
            arClasters[cluster].options.set({groupByCoordinates:false});
          }
        }
*/        
      }
    });


    map.show();
  }

}



$(document).ready(function () {
  ymaps.ready(map.init);
});