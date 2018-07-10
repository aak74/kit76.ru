var filials = {
  list: [],

  updateLocations: function () {
    list = [];
    $(".filial").each(function (i, d) {
      if (d.dataset["map"].length > 0) {
        list[i] = {id: d.dataset.id, map: d.dataset.map};
      }
    });

    // akop.debug.log("updateLocations list", list);

    $.post("/f/update/updateLocations.php", {list: JSON.stringify(list)})
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
    // console.log("getLocations");
    // akop.debug.log("getLocations", filials.list);

    $(".filial").each(function (i, d) {
      // console.log("message", d);
      if (d.dataset["map"].length == 0) {
        filials.getLocation(d);
      }
    });

    if (filials.list.length < 2) {
      window.setTimeout(function() {
          // akop.debug.log("timeout", filials.list);
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

  getLocation: function(d) { 
    // var address = filials.list[i].name + ", " + filials.list[i].address
    // console.log("d.dataset.name", d.dataset.name);
    var gc = ymaps.geocode(d.dataset.name).then(
      function (res) {
        point = res.geoObjects.get(0)
        myMap.geoObjects.add(point);
        result = point.geometry.getCoordinates();
        d.dataset.map = result[0] + ", " + result[1];
        return result;
      }
    );
  },

}

$(document).ready(function () {
  // console.log("update script onready");
  $("#update-location").on("click", filials.updateLocations);
  $("#get-location").on("click", filials.getLocations);
  $("#get-location-all").on("click", filials.getLocationsAll);

  $("#address").on("blur", function(e) {
    // akop.debug.log("blur e", e);
    e.preventDefault();
  });


});
