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
        exit('�ϴ��ļ�����');
    }
    $allowExt=array('jpg','jpeg');
    //���𿪻ᱨ�� ���ǿ�����ȷ�ϴ�
    $temp_ext=explode('.', $fileInfo['name']);
    $ext=strtolower(end($temp_ext));
    if(!in_array($ext, $allowExt)){
        exit('�Ƿ��ļ�����');
    }
    if(move_uploaded_file($tmp_name, "uploads/".$filename)){
        echo '�ϴ��ɹ�<br/>';
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
            echo '�ļ����ֱ��ϴ�';
            break;
        case 4:
            echo 'û��ѡ���ļ�';
            break;
        case 6:
            echo 'û���ҵ���ʱĿ¼';
            break;
        case 7:
            echo 'ϵͳ����';
            break;
    }
}