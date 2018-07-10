<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Центральный экспресс");
?>
<div class="top">
	<div class="header center-block"></div>
	<div class="title center-block">
		<div>
			<div class="col-md-4 center-block">
				<a href="/redirect/calculate.php" class="btn btn-lg btn-warning btn-block"><span class="glyphicon glyphicon-screenshot"></span> ПОСЧИТАТЬ СТОИМОСТЬ</a>
			</div>
			<div class="col-md-4 center-block">
				<a href="/redirect/order.php" class="btn btn-lg btn-warning btn-block"><span class="glyphicon glyphicon-briefcase"></span> ЗАКАЗАТЬ ПЕРЕВОЗКУ</a>
			</div>
			<div class="col-md-4 center-block">
				<a href="/" class="btn btn-lg btn-warning btn-block"><span class="glyphicon glyphicon-home"></span> ПЕРЕЙТИ НА САЙТ</a>
			</div>
		</div>
	</div>
</div>

<div class="description">
	<?$APPLICATION->IncludeFile(
		SITE_DIR."include/express_brief.php",
		Array(),
		Array("MODE"=>"html")
	);?>
</div>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/contacts.php",
	Array(),
	Array("MODE"=>"html")
);?>

<div class="top">
	<div class="features center-block">
		<div class="features-title">
			Наши преимущества:
		</div>
		<div class="feature-left col-md-3"></div>
		<div class="feature1 center-block col-md-2">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/f1_w.png"><br/>НИЗКАЯ<br/>СТОИМОСТЬ
		</div>
		<div class="feature2 center-block col-md-2">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/f2_w.png"><br/>ДОСТАВКА<br/>ДО ДВЕРИ
		</div>
		<div class="feature3 center-block col-md-2">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/f3_w.png"><br/>РЕГУЛЯРНЫЙ<br/>ГРАФИК ДОСТАВОК
		</div>
		<div class="feature-right col-md-3"></div>
	</div>
	<div class="bottom center-block">
		<div>
			<div class="col-md-4 center-block">
				<a href="/redirect/calculate.php" class="btn btn-lg btn-warning btn-block"><span class="glyphicon glyphicon-screenshot"></span> ПОСЧИТАТЬ СТОИМОСТЬ</a>
			</div>
			<div class="col-md-4 center-block">
				<a href="/redirect/order.php" class="btn btn-lg btn-warning btn-block"><span class="glyphicon glyphicon-briefcase"></span> ЗАКАЗАТЬ ПЕРЕВОЗКУ</a>
			</div>
			<div class="col-md-4 center-block">
				<a href="/" class="btn btn-lg btn-warning btn-block"><span class="glyphicon glyphicon-home"></span> ПЕРЕЙТИ НА САЙТ</a>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>