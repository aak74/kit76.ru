<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

CModule::IncludeModule("tkkit.api");

$kit = new CKitApi();
$branch = new CAkopBranch();
$list = $kit->getListStore();
foreach ($list as $key1 => $value1) {
	foreach ($value1 as $key2 => $value2) {
		$nameTranslit = Cutil::translit($value2["WERKS_NAME"],"ru", array());

		$arParams = array(
			"NAME" => $value2["WERKS_NAME"],
			"XML_ID" => $value2["WERKS"],
			"CODE" => Cutil::translit($value2["WERKS_NAME"],"ru", array()),
			"DETAIL_TEXT" => $value2["REMARK"],
			"PROPERTY_VALUES" => array(
				"STATE" => $value2["LAND1"], 
				"REGION" => $value2["REGIO"], 
				"NAME_BRANCH" => $value2["ORT01"], 
				"POST_INDEX" => $value2["PSTLZ"], 
				"ADDRESS" => $value2["STRAS"], 
				"ADDR_DELIVERY" => 0, 
				"SCHEDULE" => $value2["ZSCHWORK"], 
				"TZ" => $value2["TRANSPZONE"], 
				"PHONES" => $value2["TEL_NUMBER"], 
				"PHONES_EXT" => $value2["TEL_EXTENS"], 
				"EKIT" => (($value2["EKIT"] == "") ? 0 : 1), 
			)
		);

		$list = $branch->getList(false, array("CODE" => $nameTranslit, "ACTIVE" => ""), false, false, array("ID", "NAME", "XML_ID", "CODE"));
		if (count($list) > 0) {
			unset($arParams["NAME"]);
			unset($arParams["XML_ID"]);
			$res = $branch->update($list[0]["ID"], $arParams);
		} else {
			$res = $branch->add($arParams);
		}
		$arResult[] = $value2["WERKS_NAME"];
	}
}
echo '<pre>'; print_r($arResult); echo '</pre>';

echo "Данные о представительствах из SAP загружены!"
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>