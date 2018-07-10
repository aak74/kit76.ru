<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?

/**
 * Класс описывает "API ТК Кит"
 * используется API, которое описано http://tk-kit.ru/developers/api/
 *
 * @author Андрей Копылов aakopylov@mail.ru
 */
class CKitApi {
	private $isDecode;

  public function __construct($isDecode) {
  	$this->isDecode = $isDecode;
		return $this;
  }
	
	



	
	/**
	 * Возвращает стоимость перевозки груза
	 * входящие параметры
	 * DELIVERY 	Нужна доставка груза по адресу получателя (не обязательно)
	 * PICKUP 	Нужен забор груза по адресу отправителя (не обязательно)
	 * WEIGHT * 	Вес груза в кг
	 * VOLUME * 	Объём груза в метрах кубических. Если переданы размеры (длина, ширины и высота), то объём считается исходя из размеров и данный параметр не учитывается.
	 * LENGTH * 	Длина груза в сантиметрах (не обязательно)
	 * WIDTH * 	Ширина груза в сантиметрах (не обязательно)
	 * HEIGHT * 	Высота груза в сантиметрах (не обязательно)
	 * SLAND 	Отправка из - Код страны (см. описание функции get_city_list)
	 * SZONE * 	Отправка из - Транспортная зона (см. описание функции get_city_list поле TZONEID)
	 * SCODE 	Отправка из - Код населённого пункта (см. описание функции get_city_list поле ID)
	 * SREGIO 	Отправка из - Код региона (см. описание функции get_city_list)
	 * RLAND 	Доставка в - Код страны (см. описание функции get_city_list)
	 * RZONE * 	Доставка в - Транспортная зона (см. описание функции get_city_list поле TZONEID)
	 * RCODE 	Доставка в - Код населённого пункта (см. описание функции get_city_list поле ID)
	 * RREGIO 	Доставка в - Код региона (см. описание функции get_city_list)
	 * GR_TYPE 	Характер груза (не обязательно) (см. описание функции get_insurance_agents)
	 * LIFNR 	Номер страховой компании (не обязательно) (см. описание функции get_insurance_agents)
	 * PRICE * 	Объявленная стоимость груза
	 * I_SRV 	Массив кодов дополнительных услуг (см. описание функции get_services)
	 */
	public function getPrice($arParams) {
		// if (!isset($arParams["SLAND"])		// "SLAND" => "RU",
		// CModule::IncludeModule("tkkit.api");
		// CAkop::pr_var($arParams, '$arParams');
		// echo "1 -  ", isset($arParams["FROM"]), " --- ", $arParams["TO"], " --- ", isset($arParams["TO"]);
		if ((isset($arParams["FROM"])) && (isset($arParams["TO"]))) {
			// echo "in";
			$cityFrom = self::getCity($arParams["FROM"]);
			$cityTo = self::getCity($arParams["TO"]);
		// CAkop::pr_var($cityFrom, '$cityFrom');
		// CAkop::pr_var($cityTo, '$cityTo');
			$arParams["SZONE"] = $cityFrom["TZONEID"];
			$arParams["SLAND"] = $cityFrom["COUNTRY"];
			$arParams["RZONE"] = $cityTo["TZONEID"];
			$arParams["RLAND"] = $cityTo["COUNTRY"];
			unset($arParams["FROM"]);
			unset($arParams["TO"]);

		} else {
			
		}
		// echo "2";
		// CAkop::pr_var($arParams, '$arParams after');


		$result = self::getInfo("price_order", $arParams);
		return $result;
	}
	


	/**
	 * Возвращает список складов в городе, который указан в переданном параметре $cityName
	 * если параметр не указан, то возвращаются все склады во всех городах
	 * элементы массива:
	 * [WERKS] => 7402 // код склада
   * [LAND1] => RU // страна склада
   * [PSTLZ] => 454053 // почтовый индекс
   * [REGIO] => 74 // код региона
   * [ORT01] => Челябинск // Название города
   * [STRAS] => Троицкий тракт 33 // Адрес
   * [ZSCHWORK] => ПН-ПТ 9.00-18.00, СБ 10.00-17.00 // время работы
   * [ZALTAD] => // Примечание к адресу
   * [STREETCODE] => // Код улицы
   * [TRANSPZONE] => 0000007400 // Транспортная зона
   * [TEL_NUMBER] => 8(351)211 43 75 // Номер телефона
   * [TEL_EXTENS] => // дополнительный номер телефона
   * [REMARK] => // Примечание
   * [EKIT] => X // Наличие кассы Е-КИТ (если не пусто значит касса есть)
	 */
	public function getListStore($cityName = false) {

		// $result = self::getInfo("get_rp", array("N" => $number));
		$result = self::getInfo("get_rp");
		if ($cityName) {
			$res = array();
			foreach ($result as $key => $value) {
				// if (strtoupper($value[0]["ORT01"]) = strtoupper($cityName)) {
				if (strtoupper($value[0]["ORT01"]) == strtoupper($cityName)) {
					foreach ($value as $key1 => $value1) {
						$res[] = $value1;
					}
				}
				$result = $res;
			}
		}
		return $result;
	}

	/**
	 * Возвращает все города, в которые возможна доставка груза
	 * Код страны (RU, KZ). Если код не задан - возвращается список городов и городов спутников 
	 * куда осуществляет доставку ТК КИТ. Если задан - то это справочник городов указанной страны
	 * элементы массива:
	 * [ID] => 020000100000 // Код населённого пункта
 	 * [NAME] => Уфа // Название населённого пункта
 	 * [COUNTRY] => RU // Код страны
 	 * [TZONEID] => 0000000200 // Транспортная зона
 	 * [REGION] => 02 // Код региона
 	 * [TZONE] => Y // Транспортная зона
 	 * [SR] => Y // Если пусто, то услуга забора или доставки в данном населённом пункте обязательны
 	 * [OC] => X // Если не пусто, то данный населённый пункт считается областным центром
 	 * [TP] => гор. Тип населённого пункта
 	 * [SP] => 1
	 */
	public function getListCity($state = false) {
		$obCache = new CPHPCache();
		if($obCache->InitCache(30*60, "KITgetListCityAll" . $state)) {
		   $result = $obCache->GetVars();
		}	elseif($obCache->StartDataCache()) {
			$result = self::getInfo("get_city_list", array("CC" => $state));
			$result = $result["CITY"];
		  $obCache->EndDataCache($result);
	  }
		return $result;
	}
	
	public function getCity($cityName = false) {
		$obCache = new CPHPCache();
		if($obCache->InitCache(30*60, "KITgetListCity" . $cityName)) {
		   $result = $obCache->GetVars();
		}	elseif($obCache->StartDataCache()) {
			$result = self::getListCity("");
			// CModule::IncludeModule("tkkit.api");
			// CAkop::pr_var($result, '$res');
			if ($cityName) {
				$res = array();
				foreach ($result as $key => $value) {
					// if (strtoupper($value[0]["ORT01"]) = strtoupper($cityName)) {
					// echo $value["NAME"], "<br>";
					if (strtoupper($value["NAME"]) == strtoupper($cityName)) {
						$res = $value;
					}
					$result = $res;
				}
			}
		  $obCache->EndDataCache($result);
		}		

		return $result;
	}
	

	
	/**
	 * Возвращает все статусы груза
	 */
	public function getFreightStatus($number) {
		return self::getInfo("checkstat", array("N" => $number));
	}
	

	public function getInfo($funcName, $arParams = false) {
		// $url ="http://tk-kit.ru/API.1/?f=";
		$url ="http://tk-kit.ru/API.1/?clear_cache=Y&f=";
		$ch = curl_init();
		$encoded = '';
		foreach($arParams as $name => $value) {
		  $encoded .= '&' . urlencode($name).'='.urlencode($value);
		}
		$url .= $funcName . $encoded;
		// echo "url = " . $url;

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		ob_start();
		curl_exec($ch);
		$result = ob_get_contents();
		ob_end_clean(); 
		curl_close($ch);
		return json_decode($result, true);
	}

}


?>