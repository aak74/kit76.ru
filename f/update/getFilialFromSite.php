<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("tkkit.api");

$code = CAkop::getRequest("code");
$i = CAkop::getRequest("i");


// $script = 'var arObjects = [{"coord":["58.511930030358","51.229247583838"],"adress":"\u041e\u0440\u0441\u043a, \u0443\u043b. ';
// $map = preg_match_all('/(coord\"\:)(.)+(\,\"adress)/g', $script);		
// preg_match('/(coord":)(d)+(d)+(,"adress)/', $script, $map);		
// preg_match('/(\[\")([0-9.])+(\"\,\")([0-9.])+(\"\])/', $script, $map);		
// CAkop::pr_var($map, "map");
// CAkop::pr_var(json_decode($map[0]), "map_decode");

$kit = new CAkBranch();
$elem = $kit->getDetail($code);
$elem["i"] = $i + 1;
// CAkop::pr_var($elem, '$elem');
// echo json_encode($elem[0]["PHONE"], JSON_HEX_AMP);
echo json_encode($elem, JSON_HEX_AMP);


?>