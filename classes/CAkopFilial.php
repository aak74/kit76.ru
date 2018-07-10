<?php
require_once("akop_prolog.php");

/**
 * Класс описывает сущность "филиал компании"
 *
 * @author Андрей Копылов aakopylov@mail.ru
 */
class CAkopFilial extends CAkopObject{
  public $id;
  private $arStates = array("RU" => 941, "KZ" => 1150, "BY" => 1174);
	protected $arSelectFields = array("ID", "IBLOCK_SECTION_ID", "NAME", "PROPERTY_phone", "PROPERTY_email", "PROPERTY_adres", "PROPERTY_map", "PROPERTY_regim", "PROPERTY_sxema", "PROPERTY_EKIT", "PROPERTY_ADDR", "PROPERTY_PROTECTED", "PROPERTY_EXTRA");
	protected $arRenameFields = array("PROPERTY_PHONE_VALUE" => "PHONE", "PROPERTY_EMAIL_VALUE" => "EMAIL", "PROPERTY_ADRES_VALUE" => "ADDRESS", "PROPERTY_MAP_VALUE" => "MAP", "PROPERTY_REGIM_VALUE" => "SCHEDULE", "PROPERTY_SXEMA_VALUE" => "SCHEME", "PROPERTY_EKIT_VALUE" => "EKIT", "PROPERTY_ADDR_VALUE" => "ADDR");


  public function __construct($id) {
		$this->id = $id;
		$this->iblock = IBLOCK_FILIAL;
	}

  // public function addSection($name, $code, $state) {
  public function addNewFilial($name, $code, $state) {
  	$object = new CIBlockSection;
		$id = $object->Add(array(
		  "ACTIVE" => true,
		  "IBLOCK_SECTION_ID" => $this->arStates[$state],
		  "IBLOCK_ID" => $this->iblock,
		  "NAME" => $name,
		  "CODE" => $code,
		  "SORT" => 500,
	  ));

	  // CAkop::pr_var($res, $object->LAST_ERROR);
	  if ($id > 0) {
	  	
	  	$object = new CIBlockElement;
			$id = $object->Add(array(
			  "ACTIVE" => true,
			  "IBLOCK_SECTION_ID" => $id,
			  "IBLOCK_ID" => $this->iblock,
			  "NAME" => $name,
			  "CODE" => $code,
			  "SORT" => 500,
		  ));
	  }

	  return $id;
	}


  public function getListCity() {
		$list = CIBlockSection::GetList(
		 	array("SORT" => "ASC", "DEPTH_LEVEL" => "ASC", "NAME" => "ASC"), 
			array("IBLOCK_ID" => $this->iblock), 
		 	false, 
		 	false
		);

		$result = array();
		while ($el = $list->Fetch()) {
			if ($el["DEPTH_LEVEL"] > 1) {
				$result[strtolower($el["CODE"])] = $el;
			}
/*			if ($el["DEPTH_LEVEL"] == 1) {
				$arResult["SECTIONS"][$el["ID"]] = $el;
			} else {
				$arResult["SECTIONS"][$el["IBLOCK_SECTION_ID"]]["REGIONS"][] = $el;
			}
			// $arResult["FILIALS"][$el["IBLOCK_SECTION_ID"]][$el["ID"]] = $el;
*/			
		}	
		return $result;
  }
  
  public function getStorageAmount($sectionId) {
  	$result = 0;
	  if ($sectionId > 0) {
	  	// CAkop::pr_var(array(
			 //  "ACTIVE" => true,
			 //  "IBLOCK_SECTION_ID" => $sectionId,
			 //  "IBLOCK_ID" => $this->iblock,
		  // ), "prvar");

	  	$res = CIBlockElement::GetList(false, array(
			  "ACTIVE" => "Y",
			  "SECTION_ID" => $sectionId,
			  "IBLOCK_ID" => $this->iblock,
		  ));
	  	while($ob = $res->GetNextElement()) {
	  		$result++;
	  	}
		}

		return $result;		// return CIBlockSection::GetCount(array("IBLOCK_ID" => $this->iblock, "IBLOCK_SECTION_ID" => $sectionId));
  }

}

?>