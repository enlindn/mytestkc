<?php
error_reporting(E_ALL ^ E_NOTICE);
header('content-type:text/html;charset=GBK');
include_once 'common.func.php';
$path = $_REQUEST['destination'];
$doCoverFlag = $_REQUEST['docoverflag'];
$soursePath = $_REQUEST['departure'];
echo $path."<br/>".$doCoverFlag."<br/>".$soursePath;
//if (! @move_uploaded_file($soursePath, $destination)) {
//    alert('文件移动失败!', "file.php");
//    exit();
//}

//alert('文件上传成功!', "file.php");
?>