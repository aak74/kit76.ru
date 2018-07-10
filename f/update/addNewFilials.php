<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	$list = json_decode(CAkop::getRequest("list"));
	$object = new CAkopFilial();
	$result = array();
	foreach ($list as $key => $value) {
		CAkop::pr_var($value, "value");
		$object->addNewFilial($value->name, $value->code, $value->state);
		// $object->addSection($value["name"], $value["code"], $value["state"]);
/*		$res = $object->update(
			$value, 
			array("PROPERTY_VALUES" => array($propName => $propValue))
		);
		$result[] = $value;
*/		
	}



	echo json_encode($result, JSON_HEX_AMP);


?>