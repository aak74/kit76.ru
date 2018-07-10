<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$GLOBALS["APPLICATION"]->AddHeadScript("http://api-maps.yandex.ru/2.1/?lang=ru-RU&load=package.full");
if ($GLOBALS["USER"]->IsAdmin()) {
	$GLOBALS["APPLICATION"]->AddHeadScript("/f/update/script.js");
}

// CAkop::pr_var($arResult, "arResult");
// CAkop::pr_var($arResult["PROPERTIES"]["phone"], "arResult");
// CAkop::pr_var(unserialize($arResult["PROPERTIES"]["phone"]["VALUE"]), "arResult");
// echo "phones__", unserialize($arResult["PROPERTIES"]["phone"]["VALUE"]);
// CAkop::pr_var($arResult["ADDR"], "arResult");
// CAkop::pr_var($arResult["PROPERTIES"], "DP");


// if (!strpos($arResult["NAME"], $arStates["STATE]["VALUE"]])) {
// }
// $title = "Филиал транспортной компании КИТ в г. " . $arResult["NAME"];
// $GLOBALS["APPLICATION"]->SetTitle($arResult["NAME"]);	
// $GLOBALS["APPLICATION"]->SetPageProperty("page_title", $title);
// $APPLICATION->SetPageProperty("title", "быстрая доставка в Ярославль");
$APPLICATION->SetPageProperty("keywords", $arResult["NAME"] 
		. " доставить груз,быстрая доставка в Ярославль,высокая скорость,дешевая грузоперевозка,низкая цена,грузоперевозки,сборный груз,отправить груз из " 
		. $arResult["NAME"] 
		. " в Ярославль,отправить груз из Ярославля в " 
		. $arResult["NAME"]);
$APPLICATION->SetPageProperty("description", "Транспортная компания КИТ предлагает отправку грузов из г." 
		. $arResult["NAME"] 
		. " по самым низким ценам. Быстро доставим груз из 2000 городов России, Казахстана и Беларуси в г." 
		. $arResult["NAME"]);

// $GLOBALS["APPLICATION"]->ShowTitle();
// CMain::ShowProperty("page_title");
// CMain::SetPageProperty('title', 'Page Title');
?>


<div class="filial container" data-id="<?=$arResult["ID"]?>" data-name="<?=$arResult["NAME"]?>"
	<?foreach($arResult["PROPERTIES"] as $pid=>$arProperty):?>
		data-<?=$pid?>="<?=$arProperty["VALUE"]?>"
	<?endforeach;?>
	>
	<div class="presentation">
		<p>
			Через Транспортную компанию КИТ Вы всегда можете перевезти свой груз от 1кг до 20 тонн по очень низким ценам. Мы <strong>перевезем Ваш груз дешево, но качественно и быстро</strong>. А наши доброжелательные сотрудники всегда помогут Вам соориентироваться в мире перевозок сборных грузов.
		</p>
		<p>
			<?if ($arResult["NAME"] == "Ярославль"):?>
				<strong>Отправьте свой груз</strong> из г.<a href="/contacts/" class="btn btn-info btn-xs">Ярославль</a> в любой из наших <a href="/f/" class="btn btn-info btn-xs">более 100 филиалов</a>. Вы убедитесь, что наши <a href="/redirect/tariff.php" class="btn btn-info btn-xs">цены</a> весьма умеренные. Качеством и скоростью грузоперевозки Вы тоже останетесь довольны.
			<?else :?>
				<strong>Отправьте свой груз</strong> из г.<?=$arResult["NAME"]?> в г.<a href="/contacts/" class="btn btn-info btn-xs">Ярославль</a> (или любой из наших <a href="/f/" class="btn btn-info btn-xs">более 100 филиалов</a>). Вы убедитесь, что наши <a href="/redirect/tariff.php" class="btn btn-info btn-xs">цены</a> весьма умеренные. Качеством и скоростью грузоперевозки Вы тоже останетесь довольны.
			<?endif;?>
			<strong>Низкие цены</strong> действуют и при доставке грузов в г. <?=$arResult["NAME"]?>.
		</p>
	</div>

	<div class="filial-info container">
		<div class="col-md-6">
			<?foreach($arResult["PROPERTIES"] as $key => $value):?>
				<?if ((isset($value["VALUE"]) && ($key == "regim"))):?> 
					<div class="property clearfix">
						<div class="col-md-6"><b><?=$value["NAME"]?>:</b></div>
						<div class="col-md-6">
							<?=$value["~VALUE"]["TEXT"]?>
						</div>
					</div>
				<?elseif ((
						$key != "sxema") &&
						(
							(isset($value["VALUE"]) && ($value["VALUE"] <> "") && is_array($value["VALUE"]) == false) 
							|| (is_array($value["VALUE"]) && (count($value["VALUE"]) > 0))
						)
					):?>
					<div class="property clearfix">
						<div class="col-md-6"><b><?=$value["NAME"]?>:</b></div>
						<div class="col-md-6">
							<?=(is_array($value["VALUE"]) ? implode($value["VALUE"], "<br/> ") : $value["VALUE"])?>
						</div>
					</div>
				<?endif;?>
			<?endforeach;?>
		</div>
		<div class="col-md-6">
			<?$APPLICATION->IncludeFile(
				SITE_DIR."include/action.php",
				Array(),
				Array("MODE"=>"html")
			);?>
		</div>
	</div>
</div>

<div id="map" class="map" style="width: 1000px; height: 600px"></div>
<?if ($GLOBALS["USER"]->IsAdmin()):?>
	<form role="form">
	  <div class="form-group">
	    <label for="address">Адрес для поиска</label>
	    <input type="text" class="form-control" id="address" placeholder="Уточните адрес" value="<?=$arResult["NAME"]?>">
	  </div>
		<button id="get-location" type="button" class="btn btn-info">Уточнить координаты у Яндекса</button>
		<button id="update-location" type="button" class="btn btn-success">Обновить координаты в БД</button>
	</form>
<?endif;?>
<br/>

<?if ($arResult["PROPERTIES"]["sxema"]["VALUE"] != "") :?>
	<div class="scheme">
		<h2>Схема проезда:</h2>
		<img src="<?=CFile::GetPath($arResult["PROPERTIES"]["sxema"]["VALUE"])?>" title="Схема прозеда до филиала Транспортной компании КИТ в г. "<?=$arResult["NAME"]?> alt="Схема прозеда до филиала Транспортной компании КИТ в г. "<?=$arResult["NAME"]?>>
	</div>
<?endif;?>

<div class="container">
	<div class="col-md-6">
		<?$APPLICATION->IncludeFile(
			SITE_DIR."include/action.php",
			Array(),
			Array("MODE"=>"html")
		);?>
	</div>
	<div class="col-md-6">
		<ul class="list-unstyled">
			<li><a href="#">Прайс-лист на перевозку грузов из г. <?=$arResult["NAME"]?> в другие города</a></li>
			<li><a href="#">Прайс-лист на перевозку грузов в г. <?=$arResult["NAME"]?> из других городов</a></li>
			<li><a href="#">Прайс-лист на забор/доставку груза по г. <?=$arResult["NAME"]?> и области</a></li>
			<li><a href="#">Прайс-лист на погрузо-разгрузочные работы</a></li>
		</ul>
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