<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="news-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<a href="/f/<?=$arItem["CODE"]?>/"><?=$arItem["NAME"]?>
	</div>
<?endforeach;?>
</div>
