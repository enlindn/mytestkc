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
            $mes='�ļ����ֱ��ϴ�';
            break;
        case 4:
            $mes='û��ѡ���ļ�';
            break;
        case 6:
            $mes='û���ҵ���ʱĿ¼';
            break;
        case 7:
            $mes='ϵͳ����';
            break;
    }
    exit($mes);
}

$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
//$allowExt=array('jpeg','jpg');
if(!in_array($ext, $allowExt)){
    exit('�Ƿ��ļ�����');
}

//$maxSize=2097152;
if($fileInfo['size']>$maxSize){
    exit('�ļ�̫��');
}

if($flag){
    if(!getimagesize($fileInfo['tmp_name'])){
        exit('������ʵ��ͼƬ����');
    }
}


if(!is_uploaded_file($fileInfo['tmp_name'])){
    exit('�ļ�����ͨ��HTTP POST��ʽ�ϴ�������');
}

//$uploadpath='uploads';
if(!file_exists($uploadpath)){
    mkdir($uploadpath,0777,true);
    chmod($uploadpath,0777);
}
$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
$destination=$uploadpath.'/'.$uniName;
if(!@move_uploaded_file($fileInfo['tmp_name'],$destination)){
    exit('�ļ��ƶ�ʧ��');
}

echo '�ļ��ϴ��ɹ�<br/>';
echo $destination;
return $destination;
}
?>