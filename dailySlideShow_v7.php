<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="ja">
  <head>

    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, mobile-web-app-capable">

    <title><?=$title ?></title>

    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/ui-lightness/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="./assets/js/datepicker-ja.js"></script>
    <script type="text/javascript" src="./assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="https://use.fontawesome.com/a87ac8a19a.js"></script>

  </head>
  <body>
    <div id="main-wrapper">      
      <nav class="pure-g pure-form">
        <div class="pure-u-8-24 title">
          <a href="./index.php" class="button_home">
            <i class="fa fa-home fa-lg"></i>
            <br/>トップページ
          </a>
          <p><?=$title ?></p>
          <a href="https://ciao-kawagoesatoyama.ssl-lolipop.jp/IchimuraProject/IM_Ichimura/index.html">気象データ</a>／<a href="https://ambidata.io/bd/board.html?id=58764">グラフ</a>
        </div>
        <div class="pure-u-8-24">
          <label>日付で検索</label>
          <input name="showDate" class="datepicker" type="text" onChange="searchDate()" >
        </div>
        <div class="pure-u-8-24">
          <label>時刻で横切</label>
          <select name="showHour" id="showHour">
            <option value="">全フレームを表示</option>
            <option value="10">10時のみ</option>
            <option value="11">11時のみ</option>
            <option value="12">12時のみ</option>
            <option value="13">13時のみ</option>
            <option value="14">14時のみ</option>
            <option value="15">15時のみ</option>
          </select>
          </form>
        </div>
        
      </nav>
      <div class="pure-g">
        <div class="slideshow pure-u" style="background-image:url(./img/riceField.jpg);">
          <div class="slideshow-widget">
            <div id="button_start"></div>

            <div id="timeStamp">［タイムスタンプ表示エリア］</div><br/>
            <div id="button_magnifier"><span class="tooltips">この画像を高精細表示!!</span></div>
          </div>
          <div class="loading">
            <div class="dot a"></div>
            <div class="dot b"></div>
            <div class="dot c"></div>
            <div class="dot d"></div>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-1" id="slider-wrapper">
          <div class="slider-label">
            <div class="header">スクラブ (<span></span>日間)</div>
            <span class="range-start"><span></span></span>
            <span class="range-end"><span></span></span>
          </div>
          <div id="slider">
            <div id="custom-range" class="ui-slider-range full"></div>
            <div id="custom-handle" class="ui-slider-handle"></div>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-1" id="slider-wrapper-range">
          <div class="slider-label">
            <span class="range-header">再生範囲: <span></span></span>
            <span class="start">撮影開始:<br/><span></span></span>
            
            <span class="end">撮影終了:<br/><span></span></span>
          </div>
          <div id="slider-range">
            <div class="ui-slider-range"></div>
            <!--div id="custom-range2" class="ui-slider-range last5"></div-->
            <div id="custom-handle-min"  class="ui-slider-handle"></div>
            <div id="custom-handle-max" class="ui-slider-handle"></div>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-1" id="speed">
          <label>再生スピード</label>
          <i class="slow"></i><div id="speed"></div><i class="fast"></i>
        </div>
      </div>
  </div>
  <script src="./assets/js/functions.js"></script>
  <script src="./assets/js/main.js"></script>
</body>
</html>
