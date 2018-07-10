<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/* Доступно только для администратора */
global $USER;
if (!$USER->IsAdmin()) die();

$branch = new CAkopBranch();
// $arResult = $branch->getList(array("ID"=> "108"));
$arResult = $branch->getList();
?>
<h1>Импорт представительств с основного сайта</h1>
<?
foreach ($arResult as $branchValue) {
	
	$branchDetail = $branch->getDetail($branchValue["PREVIEW_TEXT"]);
	// $branchDetail["STATE"] = "Россия";
	foreach ($branchDetail as $key => $value) {
		// unset($branchDetail[$key]["NAME"]);
		// pr_var($branchDetail[$key], $branchValue["ID"]);
		// $branchDetail["DELETED"] = "";

		/* Если складодин, то просто обновляем данные, если больше одного, тогда добавляем новый */
		if ($key == 0) {
			$branch->id = $branchValue["ID"];
		} else {
			$newSklad = $branch->add(array(
				"NAME" => $branchValue["NAME"],
				"PREVIEW_TEXT" => $branchValue["PREVIEW_TEXT"],
			));
			$branch->id = $newSklad["ID"];
		}
		$updateResult = $branch->update(
			array(
				"NAME" => $branchDetail[$key]["NAME"],
				// "PREVIEW_TEXT" => $value["URL"],
				"PROPERTY_VALUES" => $branchDetail[$key]
			)
		);
	}
	// pr_var($updateResult, "updateResult");
	// CIBlockElement::SetPropertyValuesEx($value["ID"], 3, array("STATE" => "RUSSIA"));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>