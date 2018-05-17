<?php

  include('config.php');

  $debug = isset($_GET['debug']);

  $dir = $thumbdir;
  if (!file_exists($dir)) {
    die('Error: Directory not found.');
  }

  $dh  = opendir($dir);
  $files = array();
  while (false !== ($fileName = readdir($dh))) {
    $ext = substr($fileName, strrpos($fileName, '.') + 1);
    if(in_array($ext, array("jpg","jpeg","png","gif"))){
      $files[] = (object) array(
        'cached' => 0,
        'fileName' => $fileName,
        'dir_full' => $largedir,
        'dir_thumb' => $thumbdir,
        'dir_medium' => $meddir,
        'timestamp' => (int)filemtime($thumbdir . $fileName),
        'dateString' => date('Y/m/d H:i', filemtime($thumbdir . $fileName))
      );
    }
  }

  //CONVERT FILENAME TO TIMESTAMP
  date_default_timezone_set('Asia/Tokyo'); 
  for($i = 0; $i < sizeof($files); $i++){
    $fileName = $files[$i]->fileName;

    if(strrpos($files[$i]->fileName, '_') !== FALSE){
      $fileName = substr($files[$i]->fileName, strrpos($files[$i]->fileName, '_')+1); //NORMALIZE
    }
    $files[$i]->timestamp = strtotime(substr($fileName, 0, strrpos($fileName, '.')));
    $files[$i]->dateString = date('Y/m/d H:i', $files[$i]->timestamp);
    $files[$i]->hour = date('G', $files[$i]->timestamp);

    $files[$i]->timestamp = $files[$i]->timestamp*1000; //CONVERT TO JAVASCRIPT TIME
  }

  usort($files, "compare");

  if($debug){
    echo '<pre>';
    print_r($files);
  }else{
    echo json_encode($files);
  }

  function compare($a, $b){
    if ($a->timestamp == $b->timestamp){ return 0; }
    return ($a->timestamp < $b->timestamp) ? -1 : 1;
  }
  
?>
