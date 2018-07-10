<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги Транспортной компании КИТ - Ярославль");
?>
<p>Наша компания предоставляет своим клиентам качественный универсальный сервис по следующим направлениям:</p>
<ul> 
  <li>Грузоперевозки по России из Ярославля</li>
  <li>Грузоперевозки из 2000 городов России в Ярославль</li>
	<li>Грузоперевозки в <a href="/region/kazakhstan.php">Казахстан</a> и <a href="/region/belarus.php">Беларусь</a> из Ярославля</li>
	<li>Грузоперевозки из <a href="/region/kazakhstan.php">Казахстана</a> и <a href="/region/belarus.php">Беларусь</a>  в Ярославль</li>
	<li><a href="/ekit/">Перевозка ваших товаров наложенным платежом</a></li>
</ul>
<br />
<h2>Грузоперевозки по России</h2>

<p>Компания является одним из лидеров российского рынка грузоперевозок. Мы перевозим грузы для крупнейших компаний страны. С 2005 года КИТ работает для своих клиентов, являясь образцом надежности и высокого профессионализма.</p> 
<h2>Грузоперевозки по Казахстану и Беларуси</h2>
<p>Компания является одним из лидеров казахского и белорусского рынков грузоперевозок среди российских компаний. Мы перевозим грузы из России в <a href="/region/kazakhstan.php">Казахстан</a>, <a href="/region/belarus.php">Беларусь</a> и в обратном направлении. Высокая скорость перемещения грузов между нашими странами позволяет клиентам быстро получать свои грузы. А низкая стоимость грузоперевозок позволяет существенно экономить на оплате грузоперевозок.</p> 

<p>Цены на перевозки у нас достаточно низкие. Достаточно низкие для Вашего интереса к нам. И достаточные для того, чтобы не экономить на качестве перевозки грузов.</p>

<h2>Перечень услуг</h2>
<?$APPLICATION->IncludeFile(
	SITE_DIR."include/service.php",
	Array(),
	Array("MODE"=>"html")
);?>


<br>
<h2>На <a href="http://tk-kit.ru" target="_blank">основном сайте ТК КИТ</a> вы можете:</h2>	
<ul>
<li><a href="http://tk-kit.ru/calculate/" target="_blank">Рассчитать перевозку</a></li>
<li><a href="http://tk-kit.ru/order/" target="_blank">Заказать перевозку</a></li>
<li><a href="http://tk-kit.ru/customers/rules/" target="_blank">Правила перевозки</a></li>
<li><a href="http://tk-kit.ru/customers/document/" target="_blank">Документы</a></li>
</ul>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>