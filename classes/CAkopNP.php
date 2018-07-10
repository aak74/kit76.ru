<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
require_once("CAkop.php");

/**
 * Класс описывает "Населенные пункты"
 * @author Андрей Копылов aakopylov@mail.ru
 */
class CAkopNP extends CAkopObject{
	protected $iblock = IBLOCK_NP;
	protected $arSelectFields = array("NAME", "PROPERTY_STATE", "PROPERTY_REGION_NUMBER", "PROPERTY_RP", "PROPERTY_NUMBER", "PROPERTY_NAME_NP");
	protected $arRenameFields = array("PROPERTY_STATE_VALUE" => "STATE", "PROPERTY_REGION_NUMBER_VALUE" => "REGION", "PROPERTY_RP_VALUE" => "RP", "PROPERTY_NUMBER_VALUE" => "NP", "PROPERTY_NAME_NP_VALUE" => "NAME_NP");


/*
  public function __construct($params) {
		$this->iblock = IBLOCK_NP;
		return $this;
  }
*/
}

?>
