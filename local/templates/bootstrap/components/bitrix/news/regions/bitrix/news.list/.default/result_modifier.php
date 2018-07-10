<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$list = CIBlockSection::GetList(
 	array("SORT" => "ASC", "DEPTH_LEVEL" => "ASC", "NAME" => "ASC"), 
	array("IBLOCK_ID" => 8), 
 	false, 
 	false
);

while ($el = $list->Fetch()) {
	if ($el["DEPTH_LEVEL"] == 1) {
		$arResult["SECTIONS"][$el["ID"]] = $el;
	} else {
		$arResult["SECTIONS"][$el["IBLOCK_SECTION_ID"]]["REGIONS"][] = $el;
	}
}	


foreach ($arResult["ITEMS"] as $key => $value) {
	$arResult["FILIALS"][$value["IBLOCK_SECTION_ID"]][] = $value;
}
?>