<?php 
print_r($_FILES);
$filename=$_FILES['myFile']['name'];
$type=$_FILES['myFile']['type'];
$tmp_name=$_FILES['myFile']['tmp_name'];
$size=$_FILES['myFile']['size'];
$error=$_FILES['myFile']['error'];

move_uploaded_file($tmp_name,'uploads/'.$filename);