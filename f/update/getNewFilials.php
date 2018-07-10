<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("tkkit.api");
// require_once($_SERVER["DOCUMENT_ROOT"]."/classes/CAkBranch.php");
$kit = new CAkBranch();
$listSite = $kit->getList();
// CAkop::pr_var($listSite, '$listSite');
CAkop::pr_var($listSite[150], '$listSite');

/*
$kit = new CAkopBranch();
$listDb = $kit->getList();
// CAkop::pr_var($listDb, '$listDb');
CAkop::pr_var($listDb[221], '$listDb');
*/

$kit = new CAkopFilial();
$listSect = $kit->getList();
CAkop::pr_var($listSect[171], '$listSect');

// $kit = new CAkopBranch();
// foreach ($arBranches as $key => $value) {
// }
// echo json_encode($list, JSON_HEX_AMP);


?>