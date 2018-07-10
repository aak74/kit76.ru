<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Транспортная компания Кит - это современная высокотехнологичная компания в сфере перевозок сборных грузов. Мы не только зарабатываем сами, но даем заработать другим. Наши низкие цены на грузоперевозки позволяет нашим клиентам зарабатывать больше.");
$APPLICATION->SetPageProperty("keywords", "Ярославль, грузоперевозки, транспорт, сборные грузы, низкие цены на перевозку, перевозки дешево, транспортные компании Ярославля");
$APPLICATION->SetPageProperty("title", "Информация о ТК КИТ в Ярославле");
$APPLICATION->SetTitle("Транспортная компания КИТ в Ярославле");
?>
<?$APPLICATION->IncludeFile(
	SITE_DIR."banners/1.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?$APPLICATION->IncludeFile(
	SITE_DIR."about/index.php",
	Array(),
	Array("MODE"=>"html")
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>