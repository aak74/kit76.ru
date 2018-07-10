<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
CModule::IncludeModule("tkkit.api");
// require_once($_SERVER["DOCUMENT_ROOT"]."/classes/CAkBranch.php");
$kit = new CAkBranch();
$arBranches = $kit->getList();

$kit = new CAkopBranch();
foreach ($arBranches as $key => $value) {
	$nameTranslit = Cutil::translit($value["NAME"],"ru", array());

	$list = $kit->getList(false, array("NAME" => $value["NAME"]), false, false, array("ID"));
	// $arResult[$key]["ADDR_DELIVERY"] = (is_array($list) ? "N" : "Y");
	if (is_array($list)) {
		// $kit->update($list[0]["ID"], array("PROPERTY_VALUES" => array("EXT_URL" => $value["URL"], "ADDR_DELIVERY" => 1)));
		$kit->update($list[0]["ID"], array("PROPERTY_VALUES" => array("EXT_URL" => $value["URL"])));
	} else {
		$kit->add(array("NAME" => $value["NAME"], "CODE"=>$nameTranslit, "XML_ID" => $value["NAME"], "PROPERTY_VALUES" => array("EXT_URL" => $value["URL"]), "ADDR_DELIVERY" => 1));
	}
	// $arResult[$key]["ADDR_DELIVERY"] = (is_array($list) ? "N" : "Y");
	$arResult[] = $value["NAME"];

}

CAkop::pr_var($arResult, '$arResult');
echo "Данные об основных городах доставки с сайта tk-kit.ru загружены!"

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>