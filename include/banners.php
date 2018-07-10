<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

// $GLOBALS["APPLICATION"]->AddHeadString('<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.3.11/slick.css"/>');
// $GLOBALS["APPLICATION"]->AddHeadString('<link rel="stylesheet" type="text/css" href="/bitrix/templates/.default/slick/slick.css"/>');
// $GLOBALS["APPLICATION"]->AddHeadScript("//cdn.jsdelivr.net/jquery.slick/1.3.11/slick.min.js");
?>

<div class="col-md-8 col-md-offset-21 row1 banners-container1">
<!--  <div class="row"> -->
  <div class="akop-banners container">
    <div>Центральный экспресс из Ярославля</div>
    <div>Весь Центральный экспресс</div>
    <div>Рыбинск</div>
    <div>Вологда</div>
    <div>Череповец</div>
  </div>
</div>

<div class="clearfix"></div>




<div id="carousel-example-generic" class="carousel slide akop-carousel" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
    <li data-target="#carousel-example-generic" data-slide-to="5"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active map-express row">
      <div class="carousel-caption">
        <h3>Доставка дешево из Ярославля до подъезда в города: Рыбинск, Вологду и Череповец</h2>
      </div>
      <div>
        <div class="col-md-7">
          <table class="price-express table-hover table-condensed table-bordered">
            <thead>    
              <tr><th>Город</th><th>График доставки</th><th>Цена от, руб/кг</th></tr>
            </thead>   
            <tbody>    
              <tr><td class="left-col"><b>Рыбинск</b></td><td>понедельник, пятница</td><td>1,1</td></tr>
              <tr><td class="left-col"><b>Вологда</b></td><td>среда</td><td>3,2</td></tr>
              <tr><td class="left-col"><b>Череповец</b></td><td>среда</td><td>3,3</td></tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-5">
          <a href="/express/" class="btn btn-lg btn-success">Узнать подробнее</a>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="carousel-caption">
        <h2>Надежная компания</h2>
      </div>
      <div>
        <div class="col-md-7 bigger">
          <p>
            <span class="label label-info">год основания 2005</span>
          </p>
          <p>
            <a href="/filials/">
              <span class="label label-primary">более 100 филиалов</span>
            </a>
          </p>
          <p>
            <span class="label label-success">2000 городов доставки</span>
          </p>
          <p>
            <a href="/filials/">
              <span class="label label-danger">Россия, Крым, Беларусь, Казахстан</span>
            </a>
          </p>
          <p>
            <span class="label label-info">сборные грузы</span>
          </p>
        </div>
        <div class="col-md-5">
          <a href="/express/" class="btn btn-lg btn-success">Узнать подробнее</a>
        </div>
      </div>
    </div>
    <div class="item map-belarus row">
      <div class="carousel-caption">
        <h2>Доставка груза в любую точку Республики Беларусь</h2>
      </div>
      <div>
        <div class="col-md-7">
          <img src="/images/map-belarus1.png" alt="Республика Беларусь" title="Доставка груза в любую точку Республики Беларусь">
        </div>
        <div class="col-md-5">
          <a href="/region/belarus.php" class="btn btn-lg btn-success">Узнать подробнее</a>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="carousel-caption">
        <h2>Доставка груза в любую точку ЯНАО</h2>
      </div>
      <div>
        <div class="col-md-7">

        </div>
        <div class="col-md-5">
          <a href="/region/yanao.php" class="btn btn-lg btn-success">Узнать подробнее</a>
        </div>
      </div>
    </div>
<!--     <div class="item">
      <div>Весь Центральный экспресс</div>
      <div class="carousel-caption">
      </div>
    </div>
 -->
   </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>