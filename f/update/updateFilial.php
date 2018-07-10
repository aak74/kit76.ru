<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$code = CAkop::getRequest("code");
$objInt = new CAkopFilial();
$elemInt = $objInt->getList(false, array("CODE" => $code));

// CAKop::pr_var($elemInt, "int");

$amountStorage = $objInt->getStorageAmount($elemInt[0]["IBLOCK_SECTION_ID"]);
// echo "amountStorage = ", $amountStorage;

// $elemExt 

if (($elemInt[0]["PROPERTY_PROTECTED_VALUE"] != 1) && ($amountStorage < 2)) {
	$objExt = new CAkBranch();
	$elemExt = $objExt->getDetail($code);
	// CAKop::pr_var($elemExt, "ext");

	$propValues = array(
		"phone" => $elemExt["PHONE"],
		"adres" => $elemExt["ADDRESS"],
		"regim" => $elemExt["SCHEDULE"],
		"email" => $elemExt["EMAIL"],
		// "MAP" => array(0 => $elemExt["MAP"][1] , 1 => $elemExt["MAP"][0]),
	);


	if (is_array($elemExt["MAP"])) $propValues["map"] = $elemExt["MAP"][1] . "," . $elemExt["MAP"][0];

	// if ($elemInt[0]["~PROPERTY_ADDR_VALUE"] > 0)	$propValues["EKIT"] = 0;

	$result = $objInt->update(
		$elemInt[0]["ID"],
		array("PROPERTY_VALUES" => $propValues)
	);
	// CAKop::pr_var($result, "result");
}

$i = CAkop::getRequest("i");
$elemExt["i"] = $i + 1;

echo json_encode($elemExt, JSON_HEX_AMP);



?>

