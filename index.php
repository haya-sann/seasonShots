<!-- /home/users/0/ciao.jp-kawagoesatoyama/web/seasonShots -->
<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset='utf-8'>

<meta name = "viewport" content="width = 1200">
<style>
  .tableTitle_1 {
font-size:140%;

}

.imageHeader tr {

  height: 10px;
}

.titleImage  {
  width: 10px;
}

.bunner {
  height: 10px;
}

.notice-border{
  padding: 10px; 
  margin-bottom: 10px; 
  border: 3px 
  dashed #333333;
}

.small-label{
  background: #006dd9;
  padding: 3px  10px;
  color: #fff;
}
    /* Datepicker のフォントサイズを小さくする */
    div.ui-datepicker {
        font-size: 70%;
    }
    #dummy {
        height:10px;
    }
</style>

<script type="text/javascript">

   // 当日の日付を取得する関数。y+m+dで動くはずだが、
   //なぜか、数値の和になってしまうので明示的にString()を使って結合した｡
   function pDate(){
            dt = new Date();
            y = dt.getFullYear();
            m  = dt.getMonth() + 1;
             if (m < 10) { m = "0" + m; };
            d  = dt.getDate();
            if (d < 10) { d = "0" + d; };
            document.getElementById("datepicker").value=String(y)+String(m)+String(d);
            document.getElementById("datepicker2").value=String(y)+String(m)+String(d);
        }

</script>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/ui-lightness/jquery-ui.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<title>市村プロジェクト　総合ページ</title>

</head>
<body onload="pDate()">

<table  class = "imageHeader">
<tr>
  <div class = "tableTitle_1" id = 
"top_title"><p><h2>「市村プロジェクトー四万十清流米ウオッチ」<br><span style="color:red">市村さん、このページに使えるデータ下さい</span><br>太陽電池駆動IoTによる田んぼウオッチ</></div>
   市村の田んぼ。一緒に見守ってください。（今日更新）</p>
<div class = "titleImage" >
<td><a href="img/市村田んぼ.jpg"><img src="img/riceField.jpg" height =140 alt=""></td>
<td><a href="img/市村稲刈り.jpg "><img src="img/市村田んぼ.jpg" height =140 alt=""></a></td>
<td><a href="img/市村マコモ.jpg"><img src="img/市村マコモ.jpg" height =140 alt=""></td>
<td><a href="img/tanaka_Panorama.jpg"><img src="img/tanaka_Panorama.jpg" height =140 alt=""></td>
<td><a href="img/solarCamera_1.jpg"><img src="img/solarCamera_1.jpg" height =140 alt=""></td></div>
</tr> </table>


<h2>【お知らせー2023/0X/XX】
<span style="color:red">市村初号機稼働始めました・ついに田んぼの毎日がお部屋でチェックできる</span> </h2>

<div class="notice-border" >
<span class="small-label">【初号機の新機能】現地の気象データ、現地の様子がタイムラプスで見える</span><p>
<a href="https://ciao-kawagoesatoyama.ssl-lolipop.jp/IchimuraProject/IM_Ichimura/index.html">現地の気象データ</a>　／　

<a href="https://ambidata.io/bd/board.html?id=58764">
現地の気象データグラフ表示</a> 
<p>
  <h2>
<a href="https://ciao-kawagoesatoyama.ssl-lolipop.jp/IchimuraProject/IM_Ichimura/seasonShots/dailySlideShow_v7.php">【2023年版-初号機】市村無農薬四万十清流米-成長記録スライドショー-New!!</a>
<p></h2>
スライドショーの写真は高速化のため荒くしてあります。<br>
細部を見るためには［虫眼鏡］アイコンをクリックしてください。
</div>
<p>
<span class="small-label">四万十清流米のふるさとはこちら</span><p>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3340.087917660204!2d132.69722051254624!3d33.15931867339587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x354f67d250c3306f%3A0xc4ef22fd655f8d59!2z44CSNzk4LTIxMDYg5oSb5aqb55yM5YyX5a6H5ZKM6YOh5p2-6YeO55S655uu6buS77yR77yV77yY77yQ!5e0!3m2!1sja!2sjp!4v1681807190756!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<p>

2023年5月ＸＸ日から撮影し続けた写真をスライドショーで閲覧します。<br>表示方法を工夫し、現在はバージョン７のブラウザが動作しています｡
  </>
<p>
スライドショーを開くと、最新の1日分をスライド表示できます。下部のスライドバーで表示開始日・最終日を指定してします。指定の日付から最終日まで同一時刻の写真を「横切り」タイムラプス画像を確認することができます。</p>
<p>動作中でも日付や時刻指定は変更できます｡リアルタイムに反映されます｡</p>

<p>モバイル通信ネットワークなど、スピードが遅い環境で使っていると写真の表示が追いつかず、撮影時刻表示と同期しないという不都合がおきることがあります｡画像の送出間隔を変更できるようにしてありますので、お使いください。<br>
画面下にあるスライダーを左右に動かして、再生速度を変えてください｡300ミリ秒から2000ミリ秒まで指定できます。再生中に操作すると表示速度がリアルタイムに変化します。</p>

<img src="img/instructions.jpg" style="max-width:98%;" />

<br><br>
    お気付きの不都合などがありましたら、<br>
    <a href="mailto:xxx@xxx.jp">xxx@xxx.jp</a> <br>
    にメールをお送りください｡<br>
  </>
</body>
</html>
