var f = {
	id: 0,
	listFull: {},
	list: {},
	listByProp: {},
	filter: "",
	typeContent: "ekit",
	expressFromName: "",
	expressFromId: 0,

	selectType: function (typeContent) {
		f.typeContent = typeContent;
		switch (typeContent) {
	    case "ekit":
				$(".express").css("display", "none");
				$(".site").css("display", "none");
				$(".ekit").css("display", "inline-block");
				$("#express-from").text("");
				f.showEkit();
				break;
	    case "express":
				$(".ekit").css("display", "none");
				$(".site").css("display", "none");
				$(".express").css("display", "inline-block");
				f.showExpress();
				break;
	    case "site":
				$(".ekit").css("display", "none");
				$(".express").css("display", "none");
				$(".site").css("display", "inline-block");
				f.showSite();
				break;
		}
	},
	
	showSite: function () {
		$.post( "getFilialsFromSite.php")
			.done(function(data) {
				// f.list = JSON.parse(data);
				f.list = JSON.parse(data, function(key, value) {
					// console.log(value["CODE"]);
					// value["NEW"] = 1;
					// console.log(value);
					// value["NEW"] = (value["CODE"] == "abakan");
/*					if (value["CODE"] != undefined) {
						$filial = $('.filial[data-code="' + value["CODE"].toLowerCase() + '"]')[0];
						if ($filial != undefined) {
							value["ID"] = $filial.dataset.id;
						} else {
							value["NEW"] = 1;
						}
					}
*/					
		  		return value;
		  	});

				f.showFilials();
				// f.searchNewFilials();
				// $(".log").text(data);
			})
			.fail(function() {
				akop.showMessage("Ошибка. Повторите позже.", 3000);
			});		
	},

	searchNewFilials: function () {

	},

	showExpress: function (e) {
		$.post( "getExpress.php", {id: f.id})
			.done(function(data) {
				// f.list = JSON.parse(data);
				f.list = JSON.parse(data);
				f.showFilials();
			})
			.fail(function() {
				akop.showMessage("Ошибка. Повторите позже.", 3000);
			});		
	},

	selectExpress: function (e) {
		e = e || window.event;
		// console.log($('#locs-full select option:selected').text());
		$expressFrom = $('#locs-full select option:selected')
		// console.log($expressFrom);
		// console.log($expressFrom[0]);
		f.expressFromName = $expressFrom[0].text;
		f.expressFromId = $expressFrom[0].dataset.id;
		f.id = $expressFrom[0].dataset.id;
		// console.log(f.expressFromId, f.expressFromName);
		$("#express-from").text(f.expressFromName);
		f.showExpress();
	},
	
	changeType: function (e) {
		e = e || window.event;
		// console.log("e", e);
		// console.log("e", e.target.id);
		// console.log("e", e.target.id.substr(5));
		switch (e.target.id) {
	    case "opt-ekit":
				f.selectType("ekit");
		    break;
		  case "opt-express":
				f.selectType("express");
		    break;
		  case "opt-site":
				f.selectType("site");
	      break;
		}
	},
	
	showFull: function () {
		f.filter = document.getElementById("filter-loc-full").value;
		var newSelectFull = "";
		// akop.debug.dir("f.filter", f.filter);
		for (i = 0; i < f.listFull.length; i++ ) {
			if ((f.filter == "") || (f.listFull[i]["NAME"].toLowerCase().indexOf(f.filter.toLowerCase()) > -1)) {
				newSelectFull += "<option class=\"filial\""
					+ "data-id=\"" + f.listFull[i]["ID"] + "\" "
					+ "data-code=\"" + f.listFull[i]["CODE"]+ "\" "
					// + "data-i=\"" + i + "\" "
					+ ">" 
					+ f.listFull[i]["NAME"]
					+ "</option>";
			}
		}
		$("#locs-full select").html(newSelectFull);
	},



	/* Показываем населенные пункты в ТЗ. Данные берем из переданного параметра. Данные должны врнуться из файла "../getNP.php" */
	showFilials: function () {
		var newSelect = "";
		if (f.list != null) {
			for (i = 0; i < f.list.length; i++ ) {
			newSelect += "<option "
				+ ((f.list[i]["NEW"] == 1) ? "class=\"text-danger\"" : "")
				+ "data-id=\"" + f.list[i]["ID"] + "\" "
				+ "data-name=\"" + f.list[i]["NAME"] + "\" "
				+ "data-code=\"" + f.list[i]["CODE"] + "\" "
				+ "data-state=\"" + f.list[i]["STATE"] + "\" "
				+ "data-url=\"" + f.list[i]["URL"] + "\" "
				+ "data-new=\"" + f.list[i]["NEW"] + "\" "
				+ ">" 
				+ f.list[i]["NAME"]
				+ "</option>";
			}
		}
		// akop.debug.dir("newSelect", newSelect);
		
		$("#locs select").html(newSelect);

	},

	/* Запрашиваем данные о городах ТЗ и отображаем их в селекте  */		
	showEkit: function () {
		$.post( "getFilials.php", {id: f.id})
			.done(function(data) {
				// f.list = JSON.parse(data);
				f.list = JSON.parse(data);
				f.showFilials();
			})
			.fail(function() {
				akop.showMessage("Ошибка. Повторите позже.", 3000);
			});		
	},
	
	showAll: function () {
		f.showFull();
		f.showEkit();

	},


	compareData: function (i) {
		if (i < f.listFull.length) {
			$.post("compareData.php", {next: i+1, code: f.listFull[i].CODE})
				.done(function(data) {
					var list = JSON.parse(data);
					$(".log").insertAfter(list.message);
					// f.compareData(list.next)
					// f.showFilials();
				})
				.fail(function() {
					akop.showMessage("Ошибка. Повторите позже.", 3000);
				});					
		}
	},

	addNewFilial: function () {
		var list = [];
		$("#locs select [data-new=\"1\"]").each(function() {
			list[list.length]={name: this.dataset.name, code: this.dataset.code, url: this.dataset.url, state: this.dataset.state};
		});

		// console.log("list", list);
		$.post("addNewFilials.php", {list: JSON.stringify(list)})
			.done(function(data) {
				f.list = JSON.parse(data);
				$(".log").html(data);

				// f.showFilials();
			})
			.fail(function() {
				akop.showMessage("Ошибка. Повторите позже.", 3000);
			});		
	},
	

	addFilial: function (e) {
		f.listByProp = [];
		$('#locs-full select option:selected').each(function(){
			f.listByProp[f.listByProp.length] = this.dataset.id;
		});

		if (f.typeContent == "ekit") {
			f.__setProp("EKIT", 1);
		} else {
			f.__setProp("ADDR", f.expressFromId);
		}
	},

	__setProp: function (propName, propValue, propValueFilter) {
		$.post( "setProp.php", {prop_name: propName, prop_value: propValue, filter: propValueFilter, list: JSON.stringify(f.listByProp)})
			.done(function(data) {
				// f.showEkit();
				var res = JSON.parse(data);
				// akop.debug.log("add.res", res);
				f.list = res;
				f.showFilials();
			})
			.fail(function() {
				akop.showMessage("Ошибка записи. Повторите позже.", 3000);
			}
		);		
	},

	removeFilial: function (e) {
		f.listByProp = [];
		$('#locs select option:selected').each(function(){
			f.listByProp[f.listByProp.length] = this.dataset.id;
		});

		if (f.typeContent == "ekit") {
			f.__setProp("EKIT", 0, 1);
		} else {
			f.__setProp("ADDR", 0, f.expressFromId);
		}
	},

}

$(document).ready(function () {
  $(".ekit-or-express input").on("change", f.changeType);
  f.selectType("ekit");

	$("#tool-add").click(function(e){
		f.addFilial(e);
	});

	$("#tool-remove").click(function(e){
		f.removeFilial(e);
	});

	$("#tool-select").click(function(e){
		f.selectExpress(e);
	});

	$("#tool-add-new").click(function(e){
		f.addNewFilial();
	});

	$("#tool-compare-data").click(function(e){
		$(".log").html("Начинаем сравнение данных сайтов kit76.ru и tk-kit.ru");
		f.compareData();
	});


	$("#filter-loc-full").change(f.showFull);

	$('#f.tab a').click(f.showTab);

	$('.zones-list a').click(function (e) {
	  e.preventDefault()
		f.id=this.dataset.id;
		$('.zones-list a').removeClass("active");
		$(this).addClass("active");
		// f.showEkit();

	});
	// console.log($("#list-filials-full").text());

	// f.listFull = JSON.parse($("#list-filials-full").text());
	
	f.listFull = JSON.parse($("#list-filials-full").text(), function(key, value) {
	  return value;
	});

	// console.log("f.list", f.listFull);

	// f.showFull();	
	f.showAll();	
});