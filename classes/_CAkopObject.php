<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
/**
 * Класс описывает "объект"
 *
 * @author Андрей Копылов aakopylov@mail.ru
 */
	
CModule::IncludeModule('iblock'); 


class CAkopObject {
	protected $iblock;
	// private $iblock;
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
    public function getList($params) {
		/**
		 * По параметру определяем читать данные из БД или нам они уже переданы
		 */
		// if (is_array($params)) {
			$params["IBLOCK_ID"] = $this->iblock;
			// $params["IBLOCK_SECTION_ID"] = false;
			$params["!PROPERTY_DELETED"] = 1;

			$list = CIBlockElement::GetList(
				false, 
				array($params), 
				false, 
				false, 
				// array("ID", "NAME", "DETAIL_TEXT")
				array()
			);
			while ($el = $list->GetNext()) {
				$result[] = $el;
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

			pr_var($params, "params");

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
			$params["PROPERTY_VALUES"]["DELETED"] = 0;
			
			$elem_id = $el->Update($this->id, $params);
			if ($elem_id) {
				$result = array("ERRORS" => array(), "HTML" => "", "OK" => true);
			} else {
				$result = array("ERRORS" => array("0" => $el->LAST_ERROR), "HTML" => "", "OK" => false);
			}
		}
		return $result;
	}

}

?>
