var akop = {
	// _callback: null, // проверить на нужность
	// var messageTimeout = 3000;
  debug: {
      isOn: true,
      log: function() {
          if (this.isOn && window.console)
              console.log.apply(window.console, arguments);
      },
      warn: function() {
          if (this.isOn && window.console)
              console.warn.apply(window.console, arguments);
      },
      dir: function() {
          if (this.isOn && window.console)
              console.dir.apply(window.console, arguments);
      },
      stop: function() {
          if (this.isOn)
              debugger;
      }
  },

  
  _showCover: function () {
    var coverDiv = document.createElement("div");
    coverDiv.id = "cover-div";
    document.body.appendChild(coverDiv);
  },

  _hideCover: function() {
    if (document.getElementById("cover-div")) {
      document.body.removeChild(document.getElementById("cover-div"));
    }
  },
  
  showConfirm: function (textMessage, callback_yes) {
    // akop.debug.dir("showConfirm", textMessage, callback_yes);
    var i=0;
    $(".confirm p")
      .text(textMessage);
      
    
    $("#confirm-yes")
      .off()
      .on("click", function(){
        $(".confirm").css("display", "none");
        // akop.debug.dir("showConfirm", callback_yes, i);
        i++;
        callback_yes.call();
      });
    $("#confirm-no")
      .off()
      .on("click", function(){
        $(".confirm").css("display", "none");
      });
      
    $(".confirm").css("display", "block");
  },
  
  
  showPrompt: function (text, callback) {
    
    /* Переопределяем onsubmit */
    $("#ajax-form")
      .submit(function(e){
        e.preventDefault();
        var value = document.getElementById("prompt-input").value;
        if (value == "") return false; // игнорировать пустой submit

        callback(value);
        akop.hideAjaxPage();
        return false;
      });

    akop.showForm(
      '<input name="text" type="text" id="prompt-input" value="' + text + '">', 
      callback,
      "prompt-input"
    );
  },

  showForm: function (text, callback, elFocus) {
    // akop._callback = callback;
    elFocus = elFocus || "ajax-form-cancel";
    // akop.debug.log("showForm", text, elFocus);
    akop._showCover();
    $(".container-ajax-page")
      .css("display", "block")
      .find(".body-page")
      .html(text);

    /* Переопределяем onsubmit */
    // akop.debug.dir("showForm", $("#ajax-form"));
    $("#ajax-form")
      .off()
      .on("submit", function(e){
        e.preventDefault();
        akop.hideAjaxPage();
        callback();
        // return false;
      });
      
    if (document.getElementById(elFocus)) { 
      document.getElementById(elFocus).focus(); 
    }
  },
  
  showAjaxPage: function (url, callback) {
    // d3.event.preventDefault();
    
    $.get(url, function(response, error) {
      // akop.debug.log("showAjaxPage", response, error);
      // akop._hideCover();
      if (error == null) {

          
        akop.showForm(response, callback, "ajax-form-cancel");
        
      } else {
        akop.showMessage("Ошибка загрузки", 2000);
      }
      
    });
  },
  
  hideAjaxPage: function() {
  
    akop._hideCover();
    $("#container-ajax-page")
      .css("display", "none");
  },
  
  /**
  * Показываем всплывающее сообщение
  */
  showMessage: function (message, messageTimeout) {
    // akop.debug.dir("showMessage", $(".container-ajax"));
    var $container = $(".container-ajax")
    if ($container.length) {
      $container.html(message);
    } else {
      $('<div class="container-ajax">' + message + '</div>')
        .appendTo("body");
    }
      
    /* Скрываем всплывающее сообщение после таймаута*/
    if (messageTimeout != undefined) {
      setTimeout(
        function () {$(".container-ajax").remove()},
        messageTimeout
      );
    }
  },
  /**
  * Показываем всплывающее сообщение, в котором можно совершить действие и закрыть панель
  */
  // showAlert: function (message, linkUrl, linkDesc, alertClass) {
  showAlert: function (message, callbackFunction, linkDesc, alertClass) {
    if (alertClass == undefined) alertClass = "success";
    var $containerAlert = $(akop.containerAlertSelector).html(
      "<div class=\"alert alert-" + alertClass + "\">"
      + message + "&nbsp;"
      + "<a href=\"#\" class=\"alert-link\">" + linkDesc + "</a>"
      // + "<a href=\"" + linkUrl + "\" class=\"alert-link\">" + linkDesc + "</a>"
      + "<button type=\"button\" class=\"close\" aria-hidden=\"true\">&times;</button>"
      + "</div>"
    );

    /* Обработчик на закрытие алерта */
    $containerAlert.find(".close").on("click", function(e) {
      e.preventDefault();
      $(akop.containerAlertSelector).html("");
    });

    /* обраотчик клика по линку */
    $containerAlert.find(".alert-link").on("click", function(e) {
      e.preventDefault();
      callbackFunction.call();
    });
		
	}

}

$(document).ready(function () {
  /** Обработка ссылок, которые должны открываться во всплывающем окне  */
  $(".ajax-page")
    .on("click", akop.showAjaxPage);

  if (typeof calc != "undefined") calc.onload();
	// if (typeof map != "undefined") map.onload();
});
