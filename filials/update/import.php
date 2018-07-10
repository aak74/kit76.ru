<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/* Доступно только для администратора */
global $USER;
if (!$USER->IsAdmin()) die();

$branch = new CAkopBranch();
$arResult = $branch->getList();
// pr_var($arResult, "Представительства:");
?>
<h1>Импорт представительств с основного сайта</h1>
<?foreach ($arResult as $key => $value) :?>
	<?
	$branch->add(array(
		"NAME" => $value["NAME"],
		"PREVIEW_TEXT" => $value["URL"],
	));
	?>
<?endforeach;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>