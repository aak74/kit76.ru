<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Центральный экспресс из Ярославля");
?>
<?$APPLICATION->IncludeFile(
	SITE_DIR."include/express.php",
	Array(),
	Array("MODE"=>"html")
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>