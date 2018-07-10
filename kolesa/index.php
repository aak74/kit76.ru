<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расчет стоимости перевозки шин и дисков");
$GLOBALS["APPLICATION"]->AddHeadScript("/kolesa/script.js");

?>
<div class="tyres">
  <div class="btn-group tyre-or-disk" data-toggle="buttons">
    <label class="btn btn-lg btn-info active">
      <input type="radio" name="options" id="opt-tyre" autocomplete="off" checked>Расчет параметров шин
    </label>
    <label class="btn btn-lg btn-info">
      <input type="radio" name="options" id="opt-disk" autocomplete="off">Расчет параметров дисков
    </label>
  </div>
  <br/>
  <br/>

  <form class="form-horizontal1 other-params" role="form">
    <div class="form-group container">
      <div class="col-md-3">
        <span>Количество</span>
      </div>
      <div class="form-group col-md-3">
        <input type="text" class="form-control input-lg" id="quantity" placeholder="Количество" value="4">
      </div>
    </div>
    <div class="form-group disk container">
      <div class="col-md-3">
        <span>Ширина диска в дюймах</span>
      </div>
      <div class="form-group col-md-9">
        <input type="text" class="form-control input-lg" id="disk-width" placeholder="Ширина диска, дюйм">
      </div>
    </div>
  </form>

  <form class="form-inline" role="form">
    <div class="form-group container">
      <div class="col-md-3">
        <span>Укажите параметры колеса или шины</span>
      </div>
      <div class="form-group col-md-9">
        <input type="text" class="form-control input-lg tyre" id="tyre-width" placeholder="Ширина шины, мм" value="235"><span class="tyre">/</span>
        <input type="text" class="form-control input-lg tyre" id="tyre-profile" placeholder="Профиль, %" value="70"><span class="tyre">R</span>
        <input type="text" class="form-control input-lg tyre disk" id="disk-diametr" placeholder="Диаметр диска" value="19">
      </div>
    </div>

  </form>     

  <div class="form-group container volume">
    <div class="col-md-3">
      <a href="#" class="btn btn-primary btn-lg calc-volume">Вычислить<br/>объём</a>
    </div>
    <div class="col-md-9">
      <span>Высота = </span><span id="tyre-diametr" class="text-primary11"></span>
      <p>
      <span>Объем = </span><span id="tyre-volume" class="text-primary"></span>
    </p>
    </div>
  </div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>