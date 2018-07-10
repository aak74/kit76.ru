var tyres = {
	tyreOrDisk: "tyre",
	selectType: function (tyreOrDisk) {
		tyres.tyreOrDisk = tyreOrDisk;
		if (tyreOrDisk == "tyre") {
			$(".disk").css("display", "none");
			$(".tyre").css("display", "inline-block");
		} else {
			$(".tyre").css("display", "none");
			$(".disk").css("display", "inline-block");
		}
		$("#tyre-volume").text("");
		$("#tyre-diametr").text("");

	},

	changeType: function (e) {
		e = e || window.event;
		// console.log("e", e);
		// console.log("e", e.target.id);
		// console.log("e", e.target.id.substr(5));
		if (e.target.id == "opt-tyre") {
			tyres.selectType("tyre");
		} else {
			tyres.selectType("disk");
		}
		
	},


	calcVolume: function (e) {
		e = e || window.event;
		// console.log("e", e);
		// e.defaultPrevented();
		e.preventDefault();
		var profile = parseInt($("#tyre-profile").prop("value")) / 100;

		var width = ((tyres.tyreOrDisk == "tyre") ? parseInt($("#tyre-width").prop("value")) : parseInt($("#disk-width").prop("value")) * 25.4) / 1000;
		var diametr = parseInt($("#disk-diametr").prop("value")) * 25.4 / 1000 + profile * width * 2 ;
		var quantity = parseInt($("#quantity").prop("value"));
		console.log("width", width);
		console.log("profile", profile);
		console.log("diametr", diametr);
		console.log("quantity", quantity);

		var volume = width * diametr * diametr * quantity;
		$("#tyre-volume").text(volume.toFixed(2) + "м3");
		$("#tyre-diametr").text(diametr.toFixed(2) + "м");
	}


}

$(document).ready(function () {
	// tyres.calcVolume();
  $(".calc-volume").on("click", tyres.calcVolume);
  // $(".tyre-or-disk input").on("click", tyres.changeType);
  $(".tyre-or-disk input").on("change", tyres.changeType);
  tyres.selectType("tyre");

	/* Навешиваем обработчик, чтобы вводились только цифры */
	$("input:text")
		.off()
		.on("keypress", function (e) {
			// if ("0123456789".indexOf(e.key) < 0) {
			if (((e.charCode < 48) && (e.charCode != 0)) || (e.charCode > 57)){
				e.preventDefault();
			}
		});


});