<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("tkkit.api");

$code = CAkop::getRequest("code");
$next = CAkop::getRequest("next");


// $script = 'var arObjects = [{"coord":["58.511930030358","51.229247583838"],"adress":"\u041e\u0440\u0441\u043a, \u0443\u043b. ';
// $map = preg_match_all('/(coord\"\:)(.)+(\,\"adress)/g', $script);		
// preg_match('/(coord":)(d)+(d)+(,"adress)/', $script, $map);		
preg_match('/(\[\")([0-9.])+(\"\,\")([0-9.])+(\"\])/', $script, $map);		
// CAkop::pr_var($map, "map");
// CAkop::pr_var(json_decode($map[0]), "map_decode");

$kit = new CAkBranch();
$listSite = $kit->getDetail($code);
// CAkop::pr_var($listSite, '$listSite');
// echo json_encode($listSite[0]["PHONE"], JSON_HEX_AMP);


$kit = new CAkopFilial();
$listSect = $kit->getList(false, array("CODE" => $code));
// CAkop::pr_var($listSect, '$listSect');
// CAkop::pr_var($listSect[0]["PHONE"], 'phones');
// CAkop::pr_var(json_decode($listSect[0]["PHONE"]), 'phones');


// $kit = new CAkopBranch();
// foreach ($arBranches as $key => $value) {
// }
echo json_encode($list, JSON_HEX_AMP);


?>