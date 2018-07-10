<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Транспортной компании КИТ - Филиалы");

global $arFilter2;

$arFilter2 = array("PROPERTY_ADDR_DELIVERY" => 0);
// $GLOBALS["arFilter2"] = array("ID" => 1863);
?><?$APPLICATION->IncludeComponent("bitrix:news", "map76", Array(
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"USE_SHARE" => "Y",	// Отображать панель соц. закладок
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"IBLOCK_TYPE" => "filials",	// Тип инфоблока
		"IBLOCK_ID" => "3",	// Инфоблок
		"NEWS_COUNT" => "300",	// Количество новостей на странице
		"USE_SEARCH" => "N",	// Разрешить поиск
		"USE_RSS" => "N",	// Разрешить RSS
		"USE_RATING" => "N",	// Разрешить голосование
		"USE_CATEGORIES" => "N",	// Выводить материалы по теме
		"USE_FILTER" => "N",	// Показывать фильтр
		"SORT_BY1" => "PROPERTY_STATE",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "NAME",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"LIST_FIELD_CODE" => array(	// Поля
			0 => "CODE",
			1 => "CREATED_DATE",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "ADDRESS",
			1 => "LONGITUDE",
			2 => "SCHEDULE",
			3 => "STATE",
			4 => "PHONES",
			5 => "PHONES_EXT",
			6 => "LATITUDE",
			7 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"META_KEYWORDS" => "",	// Установить ключевые слова страницы из свойства
		"META_DESCRIPTION" => "",	// Установить описание страницы из свойства
		"BROWSER_TITLE" => "NAME",	// Установить заголовок окна браузера из свойства
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"DETAIL_FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "EMAIL",
			1 => "ADDRESS",
			2 => "DIVISION",
			3 => "LONGITUDE",
			4 => "EKIT",
			5 => "NAME_BRANCH",
			6 => "POST_INDEX",
			7 => "REGION",
			8 => "SCHEDULE",
			9 => "STATE",
			10 => "PHONES",
			11 => "PHONES_EXT",
			12 => "TZ",
			13 => "LATITUDE",
			14 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DETAIL_PAGER_TITLE" => "Страница",	// Название категорий
		"DETAIL_PAGER_TEMPLATE" => "",	// Название шаблона
		"DETAIL_PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "0",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"PAGER_TITLE" => "Филиалы",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "Y",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "0",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
		"SEF_FOLDER" => "/filials/",	// Каталог ЧПУ (относительно корня сайта)
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"VARIABLE_ALIASES" => array(
			"news" => "",
			"section" => "",
			"detail" => "",
		),
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"SHARE_HIDE" => "N",	// Не раскрывать панель соц. закладок по умолчанию
		"SHARE_TEMPLATE" => "",	// Шаблон компонента панели соц. закладок
		"SHARE_HANDLERS" => "",	// Используемые соц. закладки и сети
		"SHARE_SHORTEN_URL_LOGIN" => "",	// Логин для bit.ly
		"SHARE_SHORTEN_URL_KEY" => "",	// Ключ для для bit.ly
		"FILTER_NAME" => "arFilter2",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "ADDR_DELIVERY",
			1 => "0",
			2 => "0",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>