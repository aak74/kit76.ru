<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$GLOBALS["APPLICATION"]->AddHeadScript("http://api-maps.yandex.ru/2.1/?lang=ru-RU&load=package.full");
if ($GLOBALS["USER"]->IsAdmin()) {
	$GLOBALS["APPLICATION"]->AddHeadScript("/filials/update/script.js");
}

// CAkop::pr_var($arResult, "arResult");
// CAkop::pr_var($arResult["DISPLAY_PROPERTIES"], "DP");

$arStates = array(
	"RU" => "Россия",
	"KZ" => "Казахстан",
	"BY" => "Беларусь",
);

$arPropsVisible = array(
  "ADDRESS",
  "SCHEDULE",
  "PHONES",
  "PHONES_EXT",
  // "EKIT",
);

if (!strpos($arResult["NAME"], $arStates[$arResult["PROPERTIES"]["STATE"]["VALUE"]])) {
	$title = $arResult["NAME"] . " (" . $arStates[$arResult["PROPERTIES"]["STATE"]["VALUE"]] . ")";
}
// $GLOBALS["APPLICATION"]->SetTitle($title);
$GLOBALS["APPLICATION"]->SetPageProperty("title", $title);
$APPLICATION->SetPageProperty("keywords", $arResult["PROPERTIES"]["NAME_BRANCH"]["VALUE"] . " доставить груз,быстрая доставка,высокая скорость,дешевая грузоперевозка,низкая цена,грузоперевозки,сборный груз,отправить груз из " . $arResult["PROPERTIES"]["NAME_BRANCH"]["VALUE"]);
$APPLICATION->SetPageProperty("description", "Транспортная компания КИТ предлагает отправку грузов из г." . $arResult["PROPERTIES"]["NAME_BRANCH"]["VALUE"] . " по самым низким ценам. Быстро доставим груз из 2000 городов России, Казахстана и Беларуси в г." . $arResult["PROPERTIES"]["NAME_BRANCH"]["VALUE"]);

// $GLOBALS["APPLICATION"]->ShowTitle();
?>
<div id="map" class="map" style="width: 1000px; height: 600px"></div>
<div class="filial" id="<?=$this->GetEditAreaId($arResult['ID']);?>" data-id="<?=$arResult["ID"]?>" data-name="<?=$arResult["NAME"]?>"
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		data-<?=$arProperty["CODE"]?>="<?=$arProperty["DISPLAY_VALUE"]?>"
	<?endforeach;?>
	>
	<?if ($GLOBALS["USER"]->IsAdmin()):?>
		<form role="form">
		  <div class="form-group">
		    <label for="address">Адрес для поиска</label>
		    <input type="text" class="form-control" id="address" placeholder="Уточните адрес" value="<?=$arResult["DISPLAY_PROPERTIES"]["NAME_BRANCH"]["VALUE"] . ", " . $arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"]?>">
		  </div>
			<button id="get-location" type="button" class="btn btn-info">Уточнить координаты у Яндекса</button>
			<button id="update-location" type="button" class="btn btn-success">Обновить координаты в БД</button>
		</form>
	<?endif;?>

	<div class="filial-info">
		<?foreach($arPropsVisible as $key => $value):?>
			<?if ((isset($arResult["PROPERTIES"][$value]["VALUE"]) && ($arResult["PROPERTIES"][$value]["VALUE"] <> "") && is_array($arResult["PROPERTIES"][$value]["VALUE"]) == false) 
				|| (is_array($arResult["PROPERTIES"][$value]["VALUE"]) && (count($arResult["PROPERTIES"][$value]["VALUE"]) > 0))):?>
				<div class="container">
					<div class="col-md-3"><b><?=$arResult["PROPERTIES"][$value]["NAME"]?>:</b></div>
					<div class="col-md-9">
						<?=(is_array($arResult["PROPERTIES"][$value]["VALUE"]) ? implode($arResult["PROPERTIES"][$value]["VALUE"], ", ") : $arResult["PROPERTIES"][$value]["VALUE"])?>
					</div>
				</div>
			<?endif;?>
			
		<?endforeach;?>
		<?if ($arResult["PROPERTIES"]["EKIT"]["VALUE"] == "1"):?>
			<h3>В этом филиале работает Е-КИТ (наложенный платеж + Стол заказов)</h3>
		<?endif;?>

	</div>
</div>

<?if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y") :?>
	<div class="news-detail-share">
		<noindex>
		<?
		$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
				"HANDLERS" => $arParams["SHARE_HANDLERS"],
				"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
				"PAGE_TITLE" => $arResult["~NAME"],
				"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
				"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
				"HIDE" => $arParams["SHARE_HIDE"],
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);
		?>
		</noindex>
	</div>
<?endif;?>