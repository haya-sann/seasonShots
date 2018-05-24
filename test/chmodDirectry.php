<?php
//作成したいディレクトリ（のパス）
$directory_path = "../daily_timelapse/_lg";    //この場合、一つ上の階層の「fileListTest」というディレクトリの中に＿mdと言うディレクトリを作成する
 
//「$directory_path」で指定されたディレクトリが存在するか確認
if(file_exists($directory_path)){
    //存在したときの処理
    echo "作成しようとしたディレクトリは既に存在します";
    //作成したディレクトリのパーミッションを確実に変更
    chmod($directory_path, 0705);
    //作成に成功した時の処理
    print ("作成に成功しました");
    
}else{
    print ("$directory_pathは存在しないよ");
    }
?>
