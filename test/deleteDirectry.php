<?php
//削除したいディレクトリ（のパス）
$directory_path = "../daily_timelapse/_ld";    //この場合、一つ上の階層にあるdaily_timelapsディレクトリの中の_ldと言うディレクトリを削除する
 
//「$directory_path」で指定されたディレクトリが存在するか確認
if(file_exists($directory_path)){
    //存在したときの処理
    echo "対象のディレクトリが確かに存在します";
    rmdir($directory_path);
    // 削除に成功した時の処理
    print ("削除しました");
    }
else{
    print ("$directory_pathは存在しないよ");
    }
?>
