<?php
//作成したいディレクトリ（のパス）
$directory_path = "../daily_timelapse/_lg";    //この場合、一つ上の階層の「fileListTest」というディレクトリの中に＿mdと言うディレクトリを作成する
 
//「$directory_path」で指定されたディレクトリが存在するか確認
if(file_exists($directory_path)){
    //存在したときの処理
    echo "作成しようとしたディレクトリは既に存在します";
}else{
    //存在しないときの処理（「$directory_path」で指定されたディレクトリを作成する）
    if(mkdir($directory_path, 0777)){
        //作成したディレクトリのパーミッションを確実に変更
        chmod($directory_path, 0777);
        //作成に成功した時の処理
        echo "作成に成功しました";
    }else{
        //作成に失敗した時の処理
        echo "作成に失敗しました";
    }
}
?>
