<?php
header('content-type:text/html;charset=GBK');
include_once 'upload.func.php';
$fileInfo=$_FILES['myFile'];
$newName=uploadfile($fileInfo);    
?>