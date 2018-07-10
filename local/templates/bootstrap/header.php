<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?//$APPLICATION->ShowMeta("keywords")?>
	<?//$APPLICATION->ShowMeta("description")?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
	
	<link href="<?=SITE_TEMPLATE_PATH?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="<?=SITE_TEMPLATE_PATH?>/bootstrap/css/bootstrap-theme.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/common.css" />
	
<?
CJSCore::Init(array("jquery"));
// $GLOBALS["APPLICATION"]->ShowHead();
$APPLICATION->ShowHead();
?>
		
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
	 <!-- Bootstrap -->

<script src="<?=SITE_TEMPLATE_PATH?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/tools.js"></script>
		
</head>
<body>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<div id="page-wrapper">
		
	
				<div class="top-menu1">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "top-simple", Array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "Y",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => "",
	"MAX_LEVEL" => "1",	
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"ALLOW_MULTI_SELECT" => "N",
	),
	false
);?>


				</div>			

			<div id="header" class="container">
				<?$APPLICATION->IncludeFile(
							SITE_DIR."include/contacts_top.php",
							Array(),
							Array("MODE"=>"html")
						);?>
			</div>


				
		
	<div id="wrap">
			<div id="content-wrapper" class="container">
					<div id="workarea">
							<div id="breadcrumb">
							<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", array(
	"START_FROM" => "1",
	"PATH" => "",
	"SITE_ID" => "-"
	),
	false
);?>
							</div>
							<div id="workarea-inner">
								<h1><?$APPLICATION->ShowTitle();?></h1> 
			<?//$APPLICATION->IncludeComponent("akop:print", "", Array(), false);?>

