<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters["PARAMETERS"] = array(
	array(
		// "PARENT" => $key,
		"NAME" => GetMessage("AKOP_PRINT_SELECTOR_SIBLINGS"),
		"DEFAULT" => "#wrap",
	  "TYPE" => "STRING",
  ),
	array(
		// "PARENT" => $key,
		"NAME" => GetMessage("AKOP_PRINT_PARAM"),
		"DEFAULT" => "u_print=Y",
	  "TYPE" => "STRING",
  ),
);

?>