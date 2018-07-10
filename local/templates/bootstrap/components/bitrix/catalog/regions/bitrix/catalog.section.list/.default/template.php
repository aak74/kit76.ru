<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

// echo '<pre>'; print_r($arResult); echo '</pre>';

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
$GLOBALS["APPLICATION"]->AddHeadScript("http://api-maps.yandex.ru/2.1/?lang=ru-RU&load=package.full");

	// $GLOBALS["APPLICATION"]->AddHeadScript("/filials/update/script.js");
// echo '<pre>'; print_r($arResult["FILIALS"][2]); echo '</pre>';
// echo '<pre>'; print_r($arResult["SECTIONS"]); echo '</pre>';



?>
<div class="filials-map container">
<div class="<? echo $arCurView['CONT'];?> col-md-3 filials-list"><?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	?><h1
		class="<? echo $arCurView['TITLE']; ?>"
		id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>"
	><a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>"><?
		echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']
		);
	?></a></h1><?
}
if (0 < $arResult["SECTIONS_COUNT"]) {
?>
	<ul class="<? echo $arCurView['LIST']; ?> list-unstyled">
	<?
		$intCurrentDepth = 1;
		$boolFirst = true;
		foreach ($arResult['SECTIONS'] as &$arSection)
		{
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

			if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
			{
				if (0 < $intCurrentDepth)
					echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul class="list-unstyled">';
			}
			elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
			{
				if (!$boolFirst)
					echo '</li>';
			}
			else
			{
				while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
					$intCurrentDepth--;
				}
				echo str_repeat("\t", $intCurrentDepth-1),'</li>';
			}

			echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
			?>
			<?if (count($arResult["FILIALS"][$arSection["ID"]]) < 1) :?>

				<li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
					<?if ($arSection['RELATIVE_DEPTH_LEVEL'] == 1) :?>
						<h4
					<?else:?>
						<span
					<?endif;?>
					  class="bx_sitemap_li_title">
						<a href="<?=$arSection["SECTION_PAGE_URL"]; ?>"><?=$arSection["NAME"];?></a>
					<?if ($arSection['RELATIVE_DEPTH_LEVEL'] == 1) :?>
						</h4>
					<?else:?>
						</span>
					<?endif;?>
			<?else :?>
				<?foreach ($arResult["FILIALS"][$arSection["ID"]] as $key => $value) :?>
					<li><a class="filial" href="/map/<?=$value["CODE"]?>/" data-key="<?=$key?>" data-name="<?=$value["NAME"]?>" data-code="<?=$value["CODE"]?>"

 						<?foreach($arResult["PROPS"] as $pid => $arProperty):
 							$prop = $value["PROPERTY_" . $arProperty . "_VALUE"];
 						?>
							<?if ($arProperty == "REGIM") :?> 
								data-regim="<?=htmlentities($prop["TEXT"], ENT_QUOTES, "UTF-8")?>"
							<?else :?>
								<?if (is_array($prop)) :
									$propValue = "";
									foreach ($prop as $key1 => $value1) {
										$propValue .= (($key1 > 0) ?  "; " : "") . $value1;
									}
								?> 
									data-<?=$arProperty?>="<?=$propValue?>"
								<?else :?>
									data-<?=$arProperty?>="<?=$prop?>"
								<?endif;?>
							<?endif;?>
						<?endforeach;?>

 					><?=$value["NAME"]?></a></li>
				<?endforeach;?>
			<?endif;?>


		<?
		$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
		$boolFirst = false;
	}
	unset($arSection);
	while ($intCurrentDepth > 1)
	{
		echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
		$intCurrentDepth--;
	}
	if ($intCurrentDepth > 0)
	{
		echo '</li>',"\n";
	}
	?>
	</ul>
<?
	echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?></div>
	<div id="map" class="map1 col-md-9"></div>
	<!-- <div id="map" class="map1 col-md-9" style="width: 100px; height: 800px"></div> -->
</div>