<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset='utf-8'>

<meta name = "viewport" content="width = 900">
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

<title>かわごえプロジェクト　総合ページ</title>

</head>
<body onload="pDate()">

<table  class = "imageHeader">
<tr>
  <div class = "tableTitle_1" id = 
"top_title"><p><h2>「東洋大学情報総合学部・かわごえ里山イニシアチブ」<br>太陽電池駆動IoTによる田んぼウオッチ協働プロジェクト</></div>
   かわごえ福田のみんなの田んぼ。一緒に見守ってください。</p>
<div class = "titleImage" >
<td><a href="img/solarCamera_1.jpg "><img src="img/solarCamera_1.jpg" height =140 alt=""></a></td>
<td><a href="img/install_system.jpg"><img src="img/install_system.jpg" height =140 alt=""></td>
<td><a href="img/members.jpg"><img src="img/members.jpg" height =140 alt=""></td>
<td><a href="img/koufukumai.jpg"><img src="img/koufukumai.jpg" height =140 alt=""></td>
<td><a href="img/raspCam.jpg"><img src="img/raspCam.jpg" height =140 alt=""></td></div>
</tr> </table>


<h2>【お知らせ】現在、2020年のプロジェクト始動準備中です</h2>
<h4>１号機は台風にともなう洪水で冠水、修復中。２号機は新機能搭載のための昨日追加のため新規開発中です。</h4>

<div class="notice-border" >
<span class="small-label">過去のデータはこちらから閲覧可能です。</span>
<h2>【新機能】現地の気象データ（２号機で収集）</h2>
<a href="https://ciao-kawagoesatoyama.ssl-lolipop.jp/IM/index.html">現地の気象データ</a>　／　
<a href="https://ambidata.io/ch/channel.html?id=999">現地の気象データグラフ表示</a> 

 <form action="showDailyPicts.php" method="post"
      <label><h2>１号機日付別定時撮影データ閲覧</h2> 表示したい日付を指定：</label>
    <input name="showdate" id="datepicker" type="text" />
    <input type="submit" name="display" value="写真表示"></form>
 <script>
      (function(){
  $("#datepicker").datepicker({
    dateFormat: 'yymmdd',
    monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    dayNames: ['日', '月', '火', '水', '木', '金', '土'],
    dayNamesMin: ['日', '月', '火', '水', '木', '金', '土']
  });
})();
    </script>

収録写真を閲覧します。日にちを指定して過去の写真も確認できます。
1日分の撮影済み写真が一覧できます。<br>

<h2><a href="dailySlideShow_v7.php">【2018年版-1号機】かわごえ里山マコモ田-成長記録スライドショー-New!!</a><p>
<a href="https://ciao-kawagoesatoyama.ssl-lolipop.jp/seasonShots/dailySlideShow_v7.php">【2018年版-２号機】かわごえ里山耕福米-成長記録スライドショー-New!!</a><p></h2>

</div>



<p>
    
2016年8月18日から撮影し続けた写真をスライドショーで閲覧します。<br>表示方法を工夫し、現在はバージョン７のブラウザが動作しています｡
  </>
<p>
スライドショーを開くと、最新の1日分をスライド表示できます。下部のスライドバーで表示開始日・最終日を指定してします。指定の日付から最終日まで同一時刻の写真を「横切り」タイムラプス画像を確認することができます。</p>
<p>動作中でも日付や時刻指定は変更できます｡リアルタイムに反映されます｡</p>

<p>モバイル通信ネットワークなど、スピードが遅い環境で使っていると写真の表示が追いつかず、撮影時刻表示と同期しないという不都合がおきることがあります｡画像の送出間隔を変更できるようにしてありますので、お使いください。<br>
画面下にあるスライダーを左右に動かして、再生速度を変えてください｡300ミリ秒から2000ミリ秒まで指定できます。再生中に操作すると表示速度がリアルタイムに変化します。</p>

<img src="./img/instructions.jpg" style="max-width:98%;" />

<br><br>

<form action="showCapturedPicts.php" method="post"
      <label><h2>２号機：電源投入時テスト撮影</h2> 表示したい日付を指定：</label>
    <input name="showdate" id="datepicker2" type="text" />
    <input type="submit" name="display" value="写真表示"></form>

<script>
      (function(){
  $('#datepicker2').datepicker({
    dateFormat: 'yymmdd',
    monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    dayNames: ['日', '月', '火', '水', '木', '金', '土'],
    dayNamesMin: ['日', '月', '火', '水', '木', '金', '土']
  });
})();
    </script>

<p>電源投入時点のテスト映像を確認します。日にちを指定して、過去のデータも確認できます。<br>
  5時から19時までの営業時間内に電源投入、次回の撮影時（正時）までに8分以上間隔があれば、テスト撮影します。<br>
  7分以内であれば、正時の撮影時間を待ちます。
</>

<br><br>
    お気付きの不都合などがありましたら、<br>
    <a href="mailto:tamboiot@googlegroups.com">tamboiot@googlegroups.com</a> <br>
    にメールをお送りください｡<br>
  </>
</body>
</html>

