<?php echo "<h1>電源投入時テスト画像一覧　　<button type='button' onclick='history.back()'>元のページに戻る</button></h1>";
$reqDate = $_POST['showdate']; //return date example:20170502
$reqDate = "20170502"; //just for test

$dir = dirname(__FILE__) . '/daily_timelapse/';

$fileList = scandir($dir);
foreach($fileList as $value ){
  $file = $dir . $value;
  if (!is_file($file)) continue;
  $modifiedDate = date("Ymd", filemtime($file));  //取得したファイルの変更日時を取得
  if($modifiedDate == $reqDate){ //指定日に一致するなら
          echo "$file was last modified at: " . $modifiedDate .PHP_EOL;

}
$result[] = $file;

$numberOfPictures = count($result);
echo "<!DOCTYPE html><html><head><meta charset='utf-8'>";
echo "<style type='text/css'>";
echo "<!--";
echo "id.pictureBox {width: 90%;}";
echo "-->";
echo "</style>";
   echo "</head>";
  echo "<body><p>".substr($reqDate, 0, 4)."年".substr($reqDate, 4, 2)."月".substr($reqDate, 6, 2)."日――の電源投入時テスト画像：".$numberOfPictures."枚ありました<p>";
for ($i = $numberOfPictures -1; $i > -1; $i--) {
    echo "<a href=";
    echo $result[$i];
    echo ">";
    echo substr($result[$i], -16, 4)."年".substr($result[$i], -12, 2)."月".substr($result[$i], -10, 2)."日――".substr($result[$i], -8, 2)."時".substr($result[$i], -6, 2)."分の画像";
    echo "<img src=".$result[$i]." width = '95%'></a>";
    echo "<br><br>";
 }
   echo "<button type='button' onclick='history.back()'>元のページに戻る</button>";

   echo "</body></html>";

?>
