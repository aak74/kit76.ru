<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$branch = new CAkopBranch();
$arResult = $branch->getDetail(getRequest("name", true));
// pr_var($arResult, "Склады--");
?>
<?foreach ($arResult as $key => $value) :?>
	<div class="sklad">
	    <h2><?=$value["NAME"]?></h2>
	    <dl class="dl-horizontal">
		    <dt>Телефон</dt>
		    <dd>
				<?foreach ($value["PHONES"] as $phone) : ?>
					<?=$phone?><br>
				<?endforeach;?>
		    </dd>
		    <dt>Email</dt>
		    <dd><?=$value["EMAIL"]?></dd>
		    <dt>Адрес</dt>
		    <dd><?=$value["ADDRESS"]?></dd>
		    <dt>Режим работы</dt>
		    <dd><?=$value["SCHEDULE"]?></dd>
	    </dl>		
		<p></p>
		<img src="<?=KIT_URL?><?=$value["SCHEME"]?>" width="600">
	</div>

<?endforeach;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>