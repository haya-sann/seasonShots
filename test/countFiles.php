<?php
$searchFiles = '../daily_timelapse/_lg/*.jpg';
$iterator = new GlobIterator($searchFiles);
print ("Counting files in ".$searchFiles."<br>");
printf("Matched %d item(s)<br><br><br>", $iterator->count());

$searchFiles = '../daily_timelapse/_md/*.jpg';
$iterator = new GlobIterator($searchFiles);
print ('シングルクオーテーション：Counting files in $searchFiles<br>');
printf("Matched %d item(s)<br><br><br>", $iterator->count());

$searchFiles = '../daily_timelapse/_sm/*.jpg';
$iterator = new GlobIterator($searchFiles);
print ("ダブルクオーテーション：Counting files in $searchFiles<br>");
printf("Matched %d item(s)<br><br><br>", $iterator->count());

?>
