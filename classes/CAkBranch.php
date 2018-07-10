<?php
require_once("akop_prolog.php");

/**
 * Класс описывает сущность "Представительство компании"
 * данные поступают с сайта tk-kit.ru
 *
 * @author Андрей Копылов aakopylov@mail.ru
 */
class CAkBranch {
    public $id;
	

  public function __construct($id) {
		$this->id = $id;
	}

  public function getDetail($code) {
		require_once('phpQuery.php');
		
		// $filename = KIT_URL .  $name;
		$filename = KIT_URL . "/contact/" . $code;

		// Открываем файл $filename
		phpQuery::newDocumentFileHTML($filename);

		$result = array();
		// Для каждого тега 'tr' выведем строки таблицы
		// foreach (pq('.cb2') as $key => $value){
		
		// $script = pq("#contab>script")->text();
		// $map = preg_match_all('/(coord\"\:)(.)+(\,\"adress)/g', $map);
		// CAkop::pr_var($map, "map");

		foreach (pq('.cb2') as $key => $sklad){
		// foreach (pq('div') as $key => $value){
			// pr_var($value->html(), "Склад");
			// pr_var($key, "Склад");
			// pr_var(pq($value)->html(), "Склад");
			$address0 = pq($sklad)->find("div.text");
			// echo $address;
			// $address5 = trim(str_replace("Адрес: ", "", $address));
			$address1 = explode("<br>", $address0->html());
			// CAkop::pr_var($address1, "address1");
			$address = trim(preg_replace("/<(.)*<\/b>/", '', $address1[0]));
			// $address2 = pq($sklad)->find("div.text");
			// $address3 = pq($address)->find("a")->remove();
			$phones = explode("<br>", pq($sklad)->find("div.phones>span")->html());
			// CAkop::pr_var($phones, "phones");
			// $address3 = pq($address)->find("a");
			// pq($address)->
			$script = pq('#contab script')->text();

			preg_match('/(\[\")([0-9.])+(\"\,\")([0-9.])+(\"\])/', $script, $map);
			// CAkop::pr_var($map, "map");
			// CAkop::pr_var(json_decode($map[0]), "map_decode");

			$result = array(
				"CODE" => $code,
				"NAME" => pq($sklad)->find("h2")->text(),
				"PHONE" => $phones,
				"ADDRESS" => $address,
				"MAP" => json_decode($map[0]),
				"SCHEME" => trim(pq($address2)->find(".sxema-link")->attr("href")),
				"SCHEDULE" => trim(preg_replace("/<(.)*<\/b>/", '', $address1[3])),
				"EMAIL" => trim(str_replace("E-mail: ", "", pq($address2)->find(".xdf")->text())),
			);
		}
		return $result;
	}

  public function getList() {
  	
		require_once('phpQuery.php');
		
		$filename = KIT_URL . "/contact/representative/";

		// Открываем файл $filename
		phpQuery::newDocumentFileHTML($filename);

		$result = array();
		// Для каждого тега 'tr' выведем строки таблицы
		// foreach (pq('.cb2') as $key => $value){
		
		// foreach (pq('.citys:lt(1) li') as $key => $branch){
		foreach (pq('.citys:eq(0) li') as $key => $branch){
			$result[] = $this->__getElement($branch, "RU");
		}
		foreach (pq('.citys:eq(1) li') as $key => $branch){
			$result[] = $this->__getElement($branch, "KZ");
		}
		foreach (pq('.citys:eq(2) li') as $key => $branch){
			$result[] = $this->__getElement($branch, "BY");
		}

		$object = new CAkopFilial();
		$list = $object->getListCity();
		// CAkop::pr_var($list, "from DB");
		foreach ($result as $key => $value) {
			if ($list[$value["CODE"]] == null) {
				$result[$key]["NEW"] = 1;
			}
		}

		return $result;
	}

	private function __getElement($branch, $state) {
		// CAkop::pr_var($branch, "branch");
		$url = pq($branch)->find("a")->attr("href");
			$result = array(
				"NAME" => pq($branch)->text(),
				"STATE" => $state,
				"URL" => $url,
				"CODE" => $this->__getSymbolCode($url)
			);
		return $result;
	
	}

	private function __getSymbolCode($value) {
		return strtolower(str_replace("/", "", str_replace("/contact/", "", $value)));
	}
}

?>