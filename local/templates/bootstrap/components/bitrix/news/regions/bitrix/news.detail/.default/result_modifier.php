<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if ($arResult["PROPERTIES"]["ADDR"]["VALUE"] != false) {
	$list = CIBlockElement::GetList(
	 	array(), 
		array("IBLOCK_ID" => 8, "ID" => $arResult["PROPERTIES"]["ADDR"]["VALUE"]), 
	 	false, 
	 	false, 
	 	array("NAME", "PROPERTY_adres", "PROPERTY_map", "PROPERTY_regim", "PROPERTY_phone", "PROPERTY_email", )
	);

	while ($el = $list->Fetch()) {
		$arResult["ADDR"] = $el;
		$phone = unserialize($el["PROPERTY_PHONE_VALUE"]);
		$arResult["PROPERTIES"]["adres"]["VALUE"] = $el["PROPERTY_ADRES_VALUE"];
		$arResult["PROPERTIES"]["map"]["VALUE"] = $el["PROPERTY_MAP_VALUE"];
		$arResult["PROPERTIES"]["regim"]["VALUE"] = $el["PROPERTY_REGIM_VALUE"];
		$arResult["PROPERTIES"]["phone"]["VALUE"] = $phone["VALUE"];
		$arResult["PROPERTIES"]["email"]["VALUE"] = $el["PROPERTY_EMAIL_VALUE"];
		$arResult["PROPERTIES"]["ADDR"]["VALUE"] = "г. " . $el["NAME"];
	}	
	
}
$arResult["PROPERTIES"]["EKIT"]["VALUE"] = ($arResult["PROPERTIES"]["EKIT"]["VALUE"] == 1) ? "Да" : "Нет";
?>