var filials = {
  list: [],

  updateLocations: function () {
    list = [];
    for (var i = 0; i < filials.list.length; i++) {
      if ((filials.list[i].longitude != undefined) && (filials.list[i].latitude != undefined)) {
        list[i] = {id: filials.list[i].id, latitude: filials.list[i].latitude, longitude: filials.list[i].longitude};
      }
    };
    akop.debug.log("updateLocations list", list);

    $.post("/filials/update/updateLocations.php", {list: JSON.stringify(list)})
      .done(function(data) {
        akop.showMessage("Обновлено!", 3000, "success");
      })
      .fail(function() {
        akop.showMessage("Ошибка записи. Повторите позже.", 3000, "danger");
      });   
  },

  getLocationsAll: function () {
    filials.getList();

    for (var i = 0; i < filials.list.length; i++) {
      filials.getLocation(i);
    };
    if (filials.list.length < 2) {
      window.setTimeout(function() {
          akop.debug.log("timeout", filials.list);
          map.show();
        }
        , 2000
      );
    }
    // akop.debug.log("filials.list", filials.list, filials.list.length);
  },

  getLocations: function () {
    console.log("getLocations");
    akop.debug.log("getLocations", filials.list);
    filials.getList();

    for (var i = 0; i < filials.list.length; i++) {
      if ((filials.list[i].longitude == undefined) || (filials.list[i].latitude == undefined)) {
        filials.getLocation(i);
      }
    };
    if (filials.list.length < 2) {
      window.setTimeout(function() {
          akop.debug.log("timeout", filials.list);
          map.show();
        }
        , 2000
      );
    }
    // akop.debug.log("filials.list", filials.list, filials.list.length);
  },

  getList: function () {
    filials.list = [];
    $(".filial").each(function (i, d) {
      filials.list[i] = [];
      for (var key in d.dataset) {
        filials.list[i][key] = d.dataset[key];
      };
    });
  },

  getLocation: function(i) { 
    var address = filials.list[i].name + ", " + filials.list[i].address
    var gc = ymaps.geocode(address).then(
      function (res) {
        point = res.geoObjects.get(0)
        myMap.geoObjects.add(point);
        result = point.geometry.getCoordinates();
        // console.log('getLocation', address, result, i);
        filials.list[i]["latitude"] = result[0];
        filials.list[i]["longitude"] = result[1];
        return result;
      }
    );
  },

}

$(document).ready(function () {
  $("#update-location").on("click", filials.updateLocations);
  $("#get-location").on("click", filials.getLocations);
  $("#get-location-all").on("click", filials.getLocationsAll);
});
