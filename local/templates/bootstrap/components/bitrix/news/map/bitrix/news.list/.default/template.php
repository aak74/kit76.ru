<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// $GLOBALS["APPLICATION"]->AddHeadScript("http://api-maps.yandex.ru/2.1/?lang=ru-RU");
$GLOBALS["APPLICATION"]->AddHeadScript("http://api-maps.yandex.ru/2.1/?lang=ru-RU&load=package.full");

if ($GLOBALS["USER"]->IsAdmin()) {
	$GLOBALS["APPLICATION"]->AddHeadScript("/filials/update/script.js");
}
// $GLOBALS["APPLICATION"]->AddHeadScript("http://api-maps.yandex.ru/2.1-dev/?lang=ru-RU&load=package.full");
?>

<div id="map" class="map1" style="width: 1000px; height: 800px"></div>

<?if ($GLOBALS["USER"]->IsAdmin()):?>
	<button id="get-location" type="button" class="btn btn-info">Получить НОВЫЕ координаты у Яндекса</button>
	<button id="get-location-all" type="button" class="btn btn-info">Получить ВСЕ координаты у Яндекса</button>
	<button id="update-location" type="button" class="btn btn-success">Обновить координаты в БД</button>
<?endif;?>

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?
// echo '<pre>'; print_r($arResult); echo '</pre>';

$currentState = "";
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
);

// $date = new DateTime();
// $date->sub(new DateInterval("P30D"));

// echo timetostr($date);
$date = strtotime("-30 days")

?>
<div class="table-responsive">
	<table class="table table-condensed">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?if ($currentState != $arItem["PROPERTY_STATE_VALUE"]):?>
			<?$currentState = $arItem["PROPERTY_STATE_VALUE"];?>
			<tr><td colspan="<?=count($arItem["DISPLAY_PROPERTIES"]);?>"><h3><?=$arStates[$currentState]?></h3></td></tr>

		<?endif;?>
		<tr class="filial <?=($arItem["DISPLAY_PROPERTIES"]["LATITUDE"] =="") ? "nowhere": ""?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-id="<?=$arItem["ID"]?>" data-name="<?=$arItem["NAME"]?>" data-code="<?=$arItem["CODE"]?>"
			<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
				data-<?=$arProperty["CODE"]?>="<?=$arProperty["DISPLAY_VALUE"]?>"
			<?endforeach;?>
			data-is-new="<?=((strtotime(str_replace(".", "-", $arItem["CREATED_DATE"]))	 > $date) ? 1 : 0)?>" data-date="<?
			$dateCreate = new DateTime(str_replace(".", "-", $arItem["CREATED_DATE"]));
			echo $dateCreate->format('Y-m-d');			
			// echo 123;			
			?>"
			>
			<td class="NAME">
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			</td>
			<?foreach($arPropsVisible as $pid=>$arProperty):?>
				<td class="<?=$arItem["DISPLAY_PROPERTIES"][$arProperty]["CODE"]?>">
					<?=$arItem["DISPLAY_PROPERTIES"][$arProperty]["DISPLAY_VALUE"]?>
				</td>
			<?endforeach;?>
		</tr>
	<?endforeach;?>
	</table>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
