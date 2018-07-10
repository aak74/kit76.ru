<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("tkkit.api");
// require_once($_SERVER["DOCUMENT_ROOT"]."/classes/CAkBranch.php");
$kit = new CAkBranch();
$list = $kit->getList();
// CAkop::pr_var($list, '$list');

// $kit = new CAkopBranch();
// foreach ($arBranches as $key => $value) {
// }
echo json_encode($list, JSON_HEX_AMP);


?>