<?php
//header('Content-type: text/javascript; charset=utf-8');

$searchFiles = '../daily_timelapse/*.jpg';
$iterator = new GlobIterator($searchFiles);
print ("Counting files in ".$searchFiles."<br>");
printf("Matched %d item(s)<br><br><br>", $iterator->count());

$searchFiles = '../daily_timelapse/_lg/*.jpg';
$iterator = new GlobIterator($searchFiles);
print ("Counting files in ".$searchFiles."<br>");
printf("Matched %d item(s)<br><br><br>", $iterator->count());

$searchFiles = '../daily_timelapse/_md/*.jpg';
$iterator = new GlobIterator($searchFiles);
print ("Counting files in $searchFiles<br>");
printf("Matched %d item(s)<br><br><br>", $iterator->count());

$searchFiles = '../daily_timelapse/_sm/*.jpg';
$iterator = new GlobIterator($searchFiles);
print ("Counting files in $searchFiles<br>");
printf("Matched %d item(s)<br><br><br>", $iterator->count());

?>
