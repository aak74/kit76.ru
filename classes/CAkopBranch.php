<?php
require_once("akop_prolog.php");

/**
 * Класс описывает сущность "Представительство компании"
 * СТАРЫЕ ФИЛИАЛЫ
 *
 * @author Андрей Копылов aakopylov@mail.ru
 */
class CAkopBranch extends CAkopObject{
  public $id;

  public function __construct($id = false) {
		$this->id = $id;
		$this->iblock = IBLOCK_FILIALS;
	}
}

?>