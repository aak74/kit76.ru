<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Ярославль, Ярославская область, отправка груза в Ярославль, доставка в Ярославль, отправка из Ярославля, транспортная компания Ярославль, экспедиционная компания Ярославль, сборный груз Ярославль");
$APPLICATION->SetPageProperty("title", "Информация о Транспортной компании КИТ в Ярославле");
$APPLICATION->SetTitle("Информация о Транспортной компании КИТ в Ярославле");
?>
<p><b>&laquo;ТК КИТ&raquo;</b> &mdash; одна из крупнейших транспортных компаний российского рынка. ТК Кит работает в России с 2005 года и на сегодняшний день сеть насчитывает более 100 филиалов. Мы осуществляем доставку в 2000 населенных пунктов России, Казахстана и Беларуси.</p>
<h2>
	<span class="label label-info">год основания 2005</span>
	<a href="/f/">
		<span class="label label-primary">более 100 филиалов</span>
	</a>
	<span class="label label-success">2000 городов доставки</span>
	<a href="/f/">
		<span class="label label-danger">Россия, Крым, Беларусь, Казахстан</span>
	</a>
	<span class="label label-info">сборные грузы</span>
</h2>

<p>Сравните наши цены, с ценами других транспортных компаний в городе Ярославль. Вы удивитесь насколько дешевле можно осуществлять перевозку грузов через транспортную компанию КИТ!</p>
<h2>
Примеры наших цен на грузоперевозки:
</h2>
<table class="pricelist table-hover table-condensed table-bordered">
	<thead>
		<th>Город</th>
		<th>Цена, от руб/кг</th>
	</thead>
	<tbody>
		<tr>
			<td>Москва</td>
			<td>3,10</td>
		</tr>
		<tr>
			<td>Санкт-Петербург</td>
			<td>4,60</td>
		</tr>
		<tr>
			<td>Екатеринбург</td>
			<td>8,00</td>
		</tr>
		<tr>
			<td>Казань</td>
			<td>6,70</td>
		</tr>
		<tr>
			<td>Надым</td>
			<td>20,90</td>
		</tr>
		<tr>
			<td>Нефтеюганск</td>
			<td>12,20</td>
		</tr>
		<tr>
			<td>Нижневартовск</td>
			<td>11,70</td>
		</tr>
		<tr>
			<td>Новосибирск</td>
			<td>11,70</td>
		</tr>
		<tr>
			<td>Новый Уренгой</td>
			<td>17,70</td>
		</tr>
		<tr>
			<td>Ноябрьск</td>
			<td>13,90</td>
		</tr>
		<tr>
			<td>Самара</td>
			<td>7,10</td>
		</tr>
		<tr>
			<td>Сургут</td>
			<td>10,90</td>
		</tr>
		<tr>
			<td>Тюмень</td>
			<td>9,50</td>
		</tr>
		<tr>
			<td>Ханты-Мансийск</td>
			<td>15,00</td>
		</tr>
		<tr>
			<td class="head" colspan="2">Крым</td>
		</tr>
		<tr>
			<td>Евпатория</td>
			<td>13,40</td>
		</tr>
		<tr>
			<td>Севастополь</td>
			<td>12,80</td>
		</tr>
		<tr>
			<td>Симферополь</td>
			<td>12,10</td>
		</tr>
		<tr>
			<td>Феодосия</td>
			<td>13,40</td>
		</tr>
		<tr>
			<td>Ялта</td>
			<td>13,40</td>
		</tr>
		<tr>
			<td class="head" colspan="2">Казахстан</td>
		</tr>
		<tr>
			<td>Актау</td>
			<td>20,30</td>
		</tr>
		<tr>
			<td>Актобе</td>
			<td>10,90</td>
		</tr>
		<tr>
			<td>Алматы</td>
			<td>20,60</td>
		</tr>
		<tr>
			<td>Астана</td>
			<td>13,30</td>
		</tr>
		<tr>
			<td>Караганда</td>
			<td>20,60</td>
		</tr>
		<tr>
			<td>Костанай</td>
			<td>12,70</td>
		</tr>
	</tbody>
</table>
Это очень небольшая выдержка из нашего прайслиста. <a href="http://tk-kit.ru/customers/tariff/" target="_blank">Здесь</a> Вы можете убедиться, что наши цены на перевозку грузов гораздо ниже, чем у большинства транспортных компаний в Ярославле.<br/><br/>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/service.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/contacts.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/action.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>