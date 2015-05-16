<?php
error_reporting(E_ALL ^ E_NOTICE);
header('content-type:text/html;charset=GBK');
include_once 'file.func.php';
include_once 'common.func.php';
$fileInfo=$_FILES['myFile'];
$path=$_POST["pathname"];
print_r($fileInfo);
echo "<br/>".$path;
//print_r($fileInfo);
uploadfile($fileInfo,$path);
?>
