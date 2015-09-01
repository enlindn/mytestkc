<?php
$fileInfo=$_FILES['myFile'];
function uploadfile($fileInfo,$uploadpath='uploads',$flag=true,$allowExt=array('jpeg','jpg'),$maxSize=2097152){
if($fileInfo['error']>0){
    switch($fileInfo['error'])
    {
        case 1:
            $mes='shabi wenjian taida';
            break;
        case 2:
            $mes='shabi wenjian chaoguo daxiao';
            break;
        case 3:
            $mes='文件部分被上传';
            break;
        case 4:
            $mes='没有选择文件';
            break;
        case 6:
            $mes='没有找到临时目录';
            break;
        case 7:
            $mes='系统错误';
            break;
    }
    exit($mes);
}

$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
//$allowExt=array('jpeg','jpg');
if(!in_array($ext, $allowExt)){
    exit('非法文件类型');
}

//$maxSize=2097152;
if($fileInfo['size']>$maxSize){
    exit('文件太大');
}

if($flag){
    if(!getimagesize($fileInfo['tmp_name'])){
        exit('不是真实的图片类型');
    }
}


if(!is_uploaded_file($fileInfo['tmp_name'])){
    exit('文件不是通过HTTP POST方式上传上来的');
}

//$uploadpath='uploads';
if(!file_exists($uploadpath)){
    mkdir($uploadpath,0777,true);
    chmod($uploadpath,0777);
}
$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
$destination=$uploadpath.'/'.$uniName;
if(!@move_uploaded_file($fileInfo['tmp_name'],$destination)){
    exit('文件移动失败');
}

echo '文件上传成功<br/>';
echo $destination;
return $destination;
}
?>