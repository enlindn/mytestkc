<?php
header('content-type:text/html;charset=RBK');
$fileInfo = $_FILES['myFile'];

$filename = $fileInfo['name'];
$type = $fileInfo['type'];
$tmp_name = $fileInfo['tmp_name'];
$size = $fileInfo['size'];
$error = $fileInfo['error'];

$maxSize=2097153;

if($error==0){
    if($fileInfo['size']>$maxSize){
        exit('上传文件过大');
    }
    $allowExt=array('jpg','jpeg');
    //不拆开会报错 但是可以正确上传
    $temp_ext=explode('.', $fileInfo['name']);
    $ext=strtolower(end($temp_ext));
    if(!in_array($ext, $allowExt)){
        exit('非法文件类型');
    }
    if(move_uploaded_file($tmp_name, "uploads/".$filename)){
        echo '上传成功<br/>';
        echo $filename.'<br/>';
        echo "<img src='uploads/".$filename."'></img>";
    }
}else{
    switch($error)
    {
        case 1:
            echo 'shabi wenjian taida';
            break;
        case 2:
            echo 'shabi wenjian chaoguo daxiao';
            break;
        case 3:
            echo '文件部分被上传';
            break;
        case 4:
            echo '没有选择文件';
            break;
        case 6:
            echo '没有找到临时目录';
            break;
        case 7:
            echo '系统错误';
            break;
    }
}