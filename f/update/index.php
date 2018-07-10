<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$GLOBALS["APPLICATION"]->AddHeadScript("/f/update/propChange.js");

$object = new CAkopFilial();
$list = $object->getList(array("NAME" =>"ASC"), false, false, false, array("ID", "NAME", "CODE"));

?>
<h1>Обновить данные:</h1>
<div><a href="rpFromSAP.php">Филиалы из SAP</a></div>
<div><a href="basicFromSite.php">Перечень основные города доставки с сайта</a></div>
<div><a href="basicFromSiteData.php">Данные об основных городах доставки</a></div>
<br/><br/><br/>


<div id="tz-tabContent" class="tab-content locations clearfix">
  <div class="btn-group ekit-or-express" data-toggle="buttons">
    <label class="btn btn-lg btn-info active">
      <input type="radio" name="options" id="opt-ekit" autocomplete="off" checked>Е-КИТ
    </label>
    <label class="btn btn-lg btn-info">
      <input type="radio" name="options" id="opt-express" autocomplete="off">Экспрессы
    </label>
    <label class="btn btn-lg btn-info">
      <input type="radio" name="options" id="opt-site" autocomplete="off">Данные с сайта
    </label>
  </div>
	<div>
		<span id="express-from" class="text-primary"></span>
  </div>

	<div id="np" class="tab-pane fade active in locations">

		<div id="locs-full" class="form-group col-md-4">
			<form role="form" class="form-horizontal">
				<div class="row">
			    <label for="filter-loc-full" class="col-md-2 control-label">Поиск</label>
			    <div class="col-md-10">
			  		<input type="text" class="form-control" id="filter-loc-full" placeholder="Строка поиска">
			    </div>
		  	</div>
				<select multiple class="form-control" size="30">
				</select>
			</form>
		</div>
		<div id="tools" class="col-md-2 form-group row">
			<div class="express">
				<button id="tool-select" type="button" class="btn btn-primary btn-block">Выбрать<br/>источник<br/>экспресса</button>
			</div>
			<button id="tool-add" type="button" class="btn btn-success btn-block">Добавить &gt;&gt;</button>
			<button id="tool-remove" type="button" class="btn btn-danger btn-block">Удалить &lt;&lt;</button>
			<div class="site">
				<button id="tool-add-new" type="button" class="btn btn-primary btn-block">Добавить<br/>новые города</button>
				<button id="tool-compare-data" type="button" class="btn btn-info btn-block">Сверить<br/>данные</button>
			</div>
		</div>
		<div id="locs" class="col-md-4 form-group">
			<form role="form" class="form-horizontal">
				<div class="row">
			    <label for="filter-loc" class="col-md-2 control-label">Поиск</label>
			    <div class="col-md-10">
			  		<input type="text" class="form-control" id="filter-loc" placeholder="Строка поиска" disabled>
			    </div>
		  	</div>
				<select multiple class="form-control" size="30">
				</select>
			</form>
		</div>
	</div>
</div>
<div class="log"></div>
<div class="helper" id="list-filials-full" style="display:none;"><?=json_encode($list, JSON_HEX_AMP)?></div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>