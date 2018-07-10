<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
require_once("CAkop.php");

/**
 * Класс описывает "объект" в системе "ЦУП"
 *
 * @author Андрей Копылов aakopylov@mail.ru
 */
class CCupObject {
	protected $iblock;
	protected $arSelectFields = array();
	protected $arRenameFields = array();
  public $id;
  public $name;
  public $description;

  public function __construct($params) {
		if ($params = $this->getData($params)) {
			$this->id = $params["ID"];
			$this->name = htmlspecialchars($params["NAME"], ENT_QUOTES);
			$this->description = htmlspecialchars($params["DETAIL_TEXT"], ENT_QUOTES);
		}
		return $this;
  }
	
	
  public function getData($params) {
	/**
	 * По параметру определяем читать данные из БД или нам они уже переданы
	 */
		if (!is_array($params)) {
			$this->id = $params;

			/**
			* Выбираем элемент по ID, 
			*/
			$list = CIBlockElement::GetList(
				false, 
				array("IBLOCK_ID" => $this->iblock, "ID" => $this->id, "!PROPERTY_DELETED" => 1), 
				false, 
				false, 
				// array("ID", "NAME", "DETAIL_TEXT")
				array()
			);
			$params = $list->GetNext();
		}
	
		return $params;
  }
	
	/** Возвращает список элементов инфоболка в соответствии с переданными параметрами */	
	/**
	 * По параметру определяем читать данные из БД или нам они уже переданы
	 * $arOrder = Array("SORT"=>"ASC"),
	 * $arFilter = Array(),
	 * $arGroupBy = false,
	 * $arNavStartParams = false,
	 * $arSelectFields = Array()
	 */
  public function getList($arOrder = false, $arFilter = false, $arGroupBy = false, $arNavStartParams = false, $arSelectFields = false) {
		if (!$arSelectFields) $arSelectFields = $this->arSelectFields;

		$arFilter["IBLOCK_ID"] = $this->iblock;
		$arFilter["!PROPERTY_DELETED"] = 1;

		// CAkop::pr_var($arFilter, "CCupObject");
		  	// $arSelectField = array("ID", "NAME", "CODE");


		$list = CIBlockElement::GetList(
			$arOrder,
			$arFilter, 
			$arGroupBy, 
			$arNavStartParams, 
			$arSelectFields
		);
		
		$i = -1;

		while ($el = $list->GetNext()) {
			if (count($this->arRenameFields) == 0) {
				$result[] = $el;
			} else {
				$i++;
				foreach ($el as $key => $value) {
					$result[$i][(isset($this->arRenameFields[$key]) ? $this->arRenameFields[$key] : $key)] = $value;
					// echo $key, " - ", $value, " = ", $this->arRenameFields[$key], "<br>";
				}

			}
		}
		// }
		return $result;
  }
	
	/** Помещает объект в корзину */
	public function mark4delete($params) {
		$result = false;
		if (is_array($params)) {
			$elementId = $params["ID"];
		} else {
			$elementId = $params;
		}
		
		CIBlockElement::SetPropertyValuesEx(
			$elementId, 
			$this->iblock, 
			array("DELETED" => 1)
		);
		$result = array("ERRORS" => array(), "HTML" => "", "OK" => true, "ID" => $elementId);
		
		return $result;
	}

	

	public function delete($params) {
		$result = false;
		if (is_array($params)) {
			$elementId = $params["id"];
		} else {
			$elementId = $params;
		}
		$res = CIBlockElement::Delete($elementId);
		if ($res) {
			$result = array("ERRORS" => array(), "HTML" => "", "OK" => true, "ID" => $elementId);
		} else {
			$result = array("ERRORS" => array("0" => $el->LAST_ERROR), "HTML" => "", "OK" => false);
		}
		
		return $result;
	}

	
	public function add($params) {
		$result = false;
		if (is_array($params)) {
			$el = new CIBlockElement;
			$params["IBLOCK_ID"] = $this->iblock;
			$params["IBLOCK_SECTION_ID"] = false;
			$params["PREVIEW_TEXT_TYPE"] = "text";
			$params["DETAIL_TEXT_TYPE"] = "text";
			$elem_id = $el->Add($params);
			if ($elem_id) {
				$result = array("ERRORS" => array(), "HTML" => "", "OK" => true, "ID" => $elem_id);
			} else {
				$result = array("ERRORS" => array("0" => $el->LAST_ERROR), "HTML" => "", "OK" => false);
			}
		}
		
		return $result;
	}

	public function update($params) {
		$result = false;
		if (is_array($params)) {
			$el = new CIBlockElement;
			$params["IBLOCK_ID"] = $this->iblock;
			$params["IBLOCK_SECTION_ID"] = false;
			$params["PREVIEW_TEXT_TYPE"] = "text";
			$params["DETAIL_TEXT_TYPE"] = "text";

			$elem_id = $el->Update($this->id, $params);
			if ($elem_id) {
				$result = array("ERRORS" => array(), "HTML" => "", "OK" => true);
			} else {
				$result = array("ERRORS" => array("0" => $el->LAST_ERROR), "HTML" => "", "OK" => false);
			}
		}
		return $result;
	}


	/**
	 * Возвращает ID раздела в соответствии с параметрами
	 * при необходимости создает новый раздел в соответствии с переданными параметрами
	 */
	public function getSectionId($arParams, $isAdd = false) {
		$list = CIBlockSection::GetList(
			false, 
			$arParams,
			false
		);
		if ($el = $list->Fetch()) {
			$result = $el["ID"];
		} else {
			$result = -1;
			if ($isAdd) {
				$bs = new CIBlockSection;
				$result =  $bs->Add($arParams);
			}
		}
		return $result;
	}


	public function getIblockId ($iblockCode) {
		$res = CIBlock::GetList(
			array(), 
			array("CODE"=>$iblockCode)
		);
		$iblock = $res->Fetch();
		return ($iblock)?$iblock["ID"]:false;
	}



}

?>
