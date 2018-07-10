<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($GLOBALS["USER"]->IsAdmin()) {
	
	$listReq = CAkop::getRequest("list");

	$list = json_decode($listReq, true);
	// CAkop::pr_var($list, '$list');

	// $branch = new CAkopBranch();
	CModule::IncludeModule('iblock'); 

	foreach ($list as $key => $value) {
		// CAkop::pr_var($value, '$value');
		// $branch->id = $value["id"];
		if (is_array($value)) {
			CIBlockElement::SetPropertyValuesEx(
				$value["id"], 
				false, 
				array("map" => $value["map"])
			);
		}
	}
}

?>