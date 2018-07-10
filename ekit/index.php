<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отправка товаров наложенным платежом из Ярославля");
?>
<p>Транспортная компания Кит предоставляет Вам возможность отправлять свои товары наложенным платежом из Ярославля и других городов.</p>
<h2>Наши преимущества:</h2>
<ol>
	<li>Низкая стоимость наложенного платежа - всего 2%.</li>
	<li>Деньги будут перечисляться на Ваш расчетный счет не реже двух раз в месяц. В зависимости от суммы за товар частота перечислений может достигать 3-х раз в неделю.</li>
	<li>Более <a href="#list-filials">60 пунктов выдачи заказов</a>. На подходе еще более 20.</li>
	<li>Адресная доставка до подъезда или квартиры.</li>
	<li>Примерка товара.</li>
	<li>Возврат товара.</li>
	<li>Наличие <a href="http://marketplace.1c-bitrix.ru/solutions/echogroup.tkkit/" target="_blank">модуля для CMS 1C-Bitrix</a>.</li>
	<li>Цена на перевозку товаров с НП равна цене обычной перевозки. <a href="price kit76 kg.pdf" target="_blank">Прайслист по весу</a>. <a href="price kit76 kg.pdf" target="_blank">Прайслист по объему</a>.</li>
</ol>
<h2>Для того чтобы отправлять товары из Ярославля наложенным платежом по России и в Крым необходимо сделать следующее:</h2>
<ol>
	<li>Заключить с нами <a href="dogovor.pdf" target="_blank">агентский договор</a>.</li>
	<li>Оформить доверенность на прием наличных денежных средств от ваших покупателей. Образец доверенности в договоре.</li>
	<li>При каждой отправке оформлять <a href="zayavka agentu.xls" target="_blank">заявку агенту</a>.</li>
</ol>
<p>Более подробную информацию Вы можете получить просмотрев презентацию нашего логистического сервиса для Интернет-магазинов.</p>
 <br>
<h2>География перевозок:</h2>
<?
$arFilterEkit = array("PROPERTY_EKIT" => "1")

?>
<div id="list-filials">
<?$APPLICATION->IncludeComponent("bitrix:news.list", "ekit", Array(
	"IBLOCK_TYPE" => "filials",
		"IBLOCK_ID" => "8",
		"NEWS_COUNT" => "200",
		"SORT_BY1" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "",
		"SORT_ORDER2" => "",
		"FILTER_NAME" => "arFilterEkit",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
	),
	false
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>