<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$currentState = "";?>
<?if(count($arResult["ITEMS"])>0):?>
	<?foreach ($arResult["ITEMS"] as $key => $arItem) :?>
		<?if ($currentState != $arItem["PROPERTY_STATE_VALUE"]):?>
			<?$currentState = $arItem["PROPERTY_STATE_VALUE"];?>
			<div class="clearfix state"></div>
			<h2><?=$currentState?></h2>
		<?endif;?>

		<div class="col-md-4">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
		</div>
	<?endforeach;?>
<?endif?>
