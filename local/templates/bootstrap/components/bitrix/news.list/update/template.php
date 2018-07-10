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
$this->setFrameMode(true);
?>
<div class="get-data">
  <a id="get-all-data-int" href="#" class="btn btn-lg btn-info">1. Загнать данные в массив</a>
  <a id="get-all-data-ext" href="#" class="btn btn-lg btn-info">2. Получить данные с основного сайта списском</a>
  <a id="update-data-all" href="#" class="btn btn-lg btn-info">3. обновить данные с основного сайта по 1 филиалу</a>
  <a id="get-data-ext" href="#" class="btn btn-lg btn-info">Получить данные с основного сайта по 1 филиалу</a>
</div>
<div class="log">
</div>


<div class="news-list">
	<table class="table table-hover">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<tr class="filial f-<?=$arItem["CODE"]?>" data-id="<?=$arItem["ID"]?>" data-code="<?=$arItem["CODE"]?>">
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<td>
					<?=$arItem["NAME"]?>
				</td>
				<td>
					<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<small>
							<?=$arProperty["NAME"]?>:&nbsp;
							<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
								<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
							<?else:?>
								<?=$arProperty["DISPLAY_VALUE"];?>
							<?endif?>
							</small><br />
						<?endforeach;?>
							<small>
									Карта:&nbsp;<?=$arItem["PROPERTIES"]["map"]["VALUE"]?>
							</small><br />
					</p>
				</td>
				<td class="data-from-site">
					data from site
				</td>
		<?endforeach;?>
	</table>
</div>
