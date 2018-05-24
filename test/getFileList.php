<?php
header('Content-type: text/javascript; charset=utf-8');

$reqDate = $_GET['showdate'];
  foreach(glob(rtrim("/seasonShots/daily_timelapse/".$reqDate."*.jpg")) as $file) {
    $result[] = $file;
}
 //json化してデータを返す
$jsonTest = json_encode($result);

echo "document.getElementById('id_fileList').textContent=".$jsonTest.";";
 ?>
