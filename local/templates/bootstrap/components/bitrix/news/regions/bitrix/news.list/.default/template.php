<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$GLOBALS["APPLICATION"]->AddHeadScript("http://api-maps.yandex.ru/2.1/?lang=ru-RU&load=package.full");

	$GLOBALS["APPLICATION"]->AddHeadScript("/f/update/script.js");
// echo '<pre>'; print_r($arResult["FILIALS"]); echo '</pre>';
// echo '<pre>'; print_r($arResult["SECTIONS"]); echo '</pre>';
// echo '<pre>'; print_r($arResult); echo '</pre>';
// echo '<pre>'; print_r($arResult["ITEMS"][0]); echo '</pre>';

?>

<?if ($GLOBALS["USER"]->IsAdmin()):?>
	<form role="form">
		<button id="get-location" type="button" class="btn btn-info">Уточнить координаты у Яндекса</button>
		<button id="update-location" type="button" class="btn btn-success">Обновить координаты в БД</button>
	</form>
<?endif;?>

<div class="filials-map container">
<div class="col-md-3 filials-list">
	<ul class="list-unstyled">
		<?foreach ($arResult['SECTIONS'] as $state) : ?>
			<li><h4><?=$state["NAME"]?></h4>
				<ul class="list-unstyled">
					<?foreach ($state["REGIONS"] as $region) : ?>
						<?if (count($arResult["FILIALS"][$region["ID"]]) < 1) :?>
							<li><a href="<?=$region["SECTION_PAGE_URL"]; ?>"><?=$region["NAME"]?></a>
						<?else:?>
							<?foreach ($arResult["FILIALS"][$region["ID"]] as $key => $value) :?>
								<li><a class="filial 
									<?if ($value["PROPERTIES"]["map"]["VALUE"] == "") echo " nowhere";?>
									<?if ($value["PROPERTIES"]["ADDR"]["VALUE"] != "") echo " text-success";?>
									" href="/f/<?=$value["CODE"]?>/" data-id="<?=$value["ID"]?>" data-key="<?=$key?>" data-name="<?=$value["NAME"]?>" data-code="<?=$value["CODE"]?>"

			 						<?foreach($value["PROPERTIES"] as $pid => $arProperty):
			 							$prop = $arProperty["VALUE"];
			 							// $prop = $value["PROPERTIES"][$arProperty]["VALUE"];
			 							if ($pid == "regim") :?> 
											data-regim="<?=htmlentities($prop["TEXT"], ENT_QUOTES, "UTF-8")?>"
										<?else :?>
											<?if (is_array($prop)) :
												$propValue = "";
												foreach ($prop as $key1 => $value1) {
													$propValue .= (($key1 > 0) ?  "; " : "") . $value1;
												}
											?> 
												data-<?=$pid?>="<?=$propValue?>"
											<?else :?>
												data-<?=$pid?>="<?=$prop?>"
											<?endif;?>
										<?endif;?>
									<?endforeach;?>

			 					><?=$value["NAME"]?></a></li>
							<?endforeach;?>
						<?endif;?>
					<?endforeach;?>
				</ul>
			</li>
		<?endforeach;?>
	</ul>
</div>
	<div id="map" class="map1 col-md-9"></div>
	<!-- <div id="map" class="map1 col-md-9" style="width: 100px; height: 800px"></div> -->
</div>