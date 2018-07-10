<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	$object = new CAkopFilial();
	// $list = $object->getList(array("NAME" =>"DESC"), array("PROPERTY_VALUES" => array("EKIT" => 1)), false, false, array("ID", "NAME"));
	$list = $object->getList(array("NAME" =>"ASC"), array("PROPERTY_EKIT" => 1), false, false, array("ID", "NAME", "CODE"));
	echo json_encode($list, JSON_HEX_AMP);


?>