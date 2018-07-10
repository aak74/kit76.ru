<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?$APPLICATION->ShowTitle()?> - ТК Кит</title>
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
	<div class="container" id="page-wrapper">
