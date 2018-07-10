var f = {
  listNew: [],
  listExt: [],
  listInt: [],

  getAllDataInt: function(d) { 
    f.listInt = [];
    $(".filial").each(function(i, d) {
      f.listInt[d.dataset.code.toLowerCase()] = d.dataset;
    });
    console.log(f.listInt);
  },

  getAllDataExt: function(d) { 
    f.listExt = [];
    f.listNew = [];
    $.post("/f/update/getFilialsFromSite.php")
      .done(function(data) {
        f.listExt = JSON.parse(data);
        // $(".log").text(data);
        // console.log(f.listExt);
        for (var i = 0; i < f.listExt.length; i++) {
          // var code = f.listInt[f.listExt[i].CODE.toLowerCase()].code;
          var elem = f.listInt[f.listExt[i].CODE.toLowerCase()];
          // console.log("elem = ", elem);
          if (elem != undefined) {
            $(".f-" + elem.code + " .data-from-site").text(elem.code);
          } else {
            f.listNew[f.listExt[i].CODE] = f.listExt[i];
          }
        };
        $(".log").text(f.listNew);
        console.log(f.listNew);
      })
      .fail(function() {
        akop.showMessage("Ошибка. Повторите позже.", 3000);
      });   
  },

  getDataExt: function(d, i) { 
    console.log("0__d=", d, " i=", i);
    if (i == undefined) i = 0;
    // if (typeof i == 'undefined') i = 0;
    // d = 0;
    console.log("1__d=", d, " i=", i);
    var code = f.listExt[i].CODE;
    $.post("/f/update/getFilialFromSite.php", {code: code, i: i})
      .done(function(response) {
        var elem = JSON.parse(response)
        console.log(elem, elem.ADDRESS, elem["NAME"]);
        var text = "<small>"
          +"email:&nbsp;" + elem["EMAIL"] + "<br/></small>"
          +"Адрес:&nbsp;" + elem.ADDRESS + "<br/>"
          +"Режим работы:&nbsp;" + elem["SCHEDULE"] + "<br/>"
          +"Телефон:&nbsp;" + elem["PHONE"] + "<br/>"
          +"Карта:&nbsp;" + elem["MAP"] + "<br/>";

/*
        text = "";
        for(var key in elem) {
          text += key + ": " +  elem[key] + " ";
        }
*/
        $(".f-" + elem.CODE + " .data-from-site").html(text);
        // if (elem.i < 5) f.getDataExt(0, elem.i);
        if (elem.i < f.listExt.length) f.getDataExt(0, elem.i);
      })
      .fail(function() {
        akop.showMessage("Ошибка. Повторите позже.", 3000);
      });   
  },

  updateDataAll: function(d, i) { 
    if (i == undefined) i = 0;
    var code = f.listExt[i].CODE;
    $.post("/f/update/updateFilial.php", {code: code, i: i})
      .done(function(response) {
        var elem = JSON.parse(response)
        // console.log(elem, elem.ADDRESS, elem["NAME"]);
        if (elem["ADDRESS"] == undefined) {
          var text = "не обновлено!"
        } else {
          var text = "<small>"
            +"email:&nbsp;" + elem["EMAIL"] + "<br/>"
            +"Адрес:&nbsp;" + elem.ADDRESS + "<br/>"
            +"Режим работы:&nbsp;" + elem["SCHEDULE"] + "<br/>"
            +"Телефон:&nbsp;" + elem["PHONE"] + "<br/>"
            +"Карта:&nbsp;" + elem["MAP"] + "<br/></small>";
        }

        $(".f-" + elem.CODE + " .data-from-site").html(text);
        // if (elem.i < 5) f.getDataExt(0, elem.i);
        if (elem.i < f.listExt.length) f.updateDataAll(0, elem.i);
      })
      .fail(function() {
        akop.showMessage("Ошибка. Повторите позже.", 3000);
      });   
  }

}

$(document).ready(function () {
  $("#get-all-data-ext").on("click", f.getAllDataExt);
  $("#get-all-data-int").on("click", f.getAllDataInt);
  $("#get-data-ext").on("click", f.getDataExt);
  $("#update-data-all").on("click", f.updateDataAll);
  
});
