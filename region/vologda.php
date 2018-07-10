<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Вологда, Вологодская область, отправка груза в Вологду, доставка в Вологду, отправка из Вологды, транспортная компания Вологда, экспедиционная компания Вологда, сборный груз Вологда");
$APPLICATION->SetTitle("Грузоперевозки в Вологду и из Вологды");
?>
<h2>Мы перевезем Ваш груз в Вологду</h2>

<img src="/images/vologda.gif" alt="Вологда" title="Доставка груза в Вологду дешево" align="right">
<p>Транспортная компания КИТ осуществляет перевозку грузов в Вологду и из Вологды по низким ценам. Мы доставляем грузы из Ярославля прямо до подъезда.</p>
<p>Груз доставляется из Ярославля по средам и пятницам.</p>


<p>Наши цены на грузоперевозки весьма умеренные. А география наших филиалов очень интересная.</p>
<h2>Краткая выписка из нашего прайслиста:</h2>
<table class="pricelist table-hover table-condensed table-bordered">
	<thead>
	<tr>
		<th>Город<br></th>
		<th>Из Вологды,<br/>от руб/кг</th>
		<th>В Вологду,<br/>от руб/кг</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td class="left-col">Екатеринбург</td>
		<td>11,20</td>
		<td>9,30</td>
	</tr>
	<tr>
		<td class="left-col">Москва</td>
		<td>6,30</td>
		<td>6,30</td>
	</tr>	
	<tr>
		<td class="left-col">Надым</td>
		<td>24,10</td>
		<td>20,60</td>
	</tr>
	<tr>
		<td class="left-col">Новосибирск</td>
		<td>14,90</td>
		<td>11,00</td>
	</tr>
	<tr>
		<td class="left-col">Новый Уренгой</td>
		<td>20,90</td>
		<td>13,10</td>
	</tr>
	<tr>
		<td class="left-col">Самара</td>
		<td>10,30</td>
		<td>8,60</td>
	</tr>
	<tr>
		<td class="left-col">Санкт-Петербург</td>
		<td>7,80</td>
		<td>8,20</td>
	</tr>
	<tr>
		<td class="left-col">Уфа</td>
		<td>10,40</td>
		<td>8,90</td>
	</tr>
	<tr>
		<td class="left-col">Ярославль</td>
		<td>3,20</td>
		<td>3,20</td>
	</tr>
</tbody>
</table>
<br/>
<div class="alert alert-info bigger" role="alert">
		Будем рады Вам помочь в осуществлении перевозок оборудования или личных вещей. Мы позаботимся о вашем грузе!
</div>
<?$APPLICATION->IncludeFile(
	SITE_DIR."include/action.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>