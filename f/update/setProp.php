<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	$list = json_decode(CAkop::getRequest("list"));
	// CAkop::pr_var($_REQUEST, "_REQUEST");
	$object = new CAkopFilial();
	$result = array();
	$propName = CAkop::getRequest("prop_name");
	$propValue = CAkop::getRequest("prop_value");
	$propValueFilter = CAkop::getRequest("filter");
	$propValueFilter =($propValueFilter != null) ? $propValueFilter : $propValue;
	foreach ($list as $key => $value) {
		// echo $value, " ";
		$res = $object->update(
			$value, 
			array("PROPERTY_VALUES" => array($propName => $propValue))
		);
		$result[] = $value;
	}
	$list = $object->getList(array("NAME" =>"ASC"), array("PROPERTY_" . $propName => $propValueFilter), false, false, array("ID", "NAME"));
	echo json_encode($list, JSON_HEX_AMP);


?>