<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$url = "http://tk-kit.ru/calculate/?order";
header('Refresh: 1; URL=' . $url);
?>
Сейчас Вы будете перенаправлены на сайт ТК КИТ. Если этого не произошло, нажмите <a href="<?=$url?>">здесь</a>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>