<?php

  include('config.php');
  
  $med_h = 800;
  $thumb_h = 640;

  $dh  = opendir($photo_dir_Sandbox);
  if(!$dh){
    echo 'Error: Can\'t Read directory.' . $photo_dir_Sandbox;
    die();
  }

  $files = array();
  while (false !== ($fileName = readdir($dh))) {
    $ext = substr($fileName, strrpos($fileName, '.') + 1);
    if(in_array($ext, array("jpg","jpeg","png","gif"))){
      if(!file_exists($photo_dir_Sandbox . "_sm/" . $fileName)){
        
        $org_img = imagecreatefromjpeg( $photo_dir_Sandbox . $fileName);
        imagejpeg($org_img, $photo_dir_Sandbox . "_lg/" . $fileName);

        $thumb_img = imagescale($org_img, $thumb_h);
        imagejpeg($thumb_img, $photo_dir_Sandbox . "_sm/" . $fileName);
        imagedestroy($thumb_img);

        $med_img = imagescale($org_img, $med_h);
        imagejpeg($med_img, $photo_dir_Sandbox . "_md/" . $fileName);
        imagedestroy($med_img);
        
        imagedestroy($org_img);
        unlink($photo_dir_Sandbox . $fileName);

        echo 'Converted: ' . $fileName;
        die();
      }
    }
  }
  echo 'Photo conversion finished.';
?>
