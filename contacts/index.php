<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Транспортная компания КИТ - Контакты");
?> 
<p>Обратитесь к нашим специалистам и Вы получите <b><i>профессиональную консультацию</i></b> по грузоперевозкам.</p>
<p>Вы можете обратиться к нам по <b><i>телефону</i></b>, по <b><i>электронной почте</i></b> или получить консультацию <b><i>в нашем офисе</i></b>. Будем рады помочь вам и ответить на все Ваши вопросы. </p>
 
<?$APPLICATION->IncludeFile(
	SITE_DIR."include/contacts.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>