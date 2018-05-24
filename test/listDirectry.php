<?php
header('Content-type: text/javascript; charset=utf-8');

//$path = dirname(__FILE__);//自分自身が置かれているディレクトリのファイルリストを取得
//daily_timelapseのディレクトリ内をリスト
$path = "/home/users/1/chicappa.jp-npo-jspe/web/hkose/seasonShots/daily_timelapse";

$dir = scandir($path);

print_r ("親のパス：$path\n");
print ("内包しているファイル・フォルダ：");
print_r ($dir);

 //json化してデータを返す
//$jsonTest = json_encode($dir);

//echo "document.getElementById('id_fileList').textContent=".$jsonTest.";";
 ?>
