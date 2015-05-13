<?php
$username='enlindn';
$anewcurl=curl_init('https://uc.kdays.cn/api/account/user_exist');
curl_setopt($anewcurl, CURLOPT_POST, 1);
curl_setopt($anewcurl, CURLOPT_POSTFIELDS, $username);
$rtn=curl_exec($anewcurl);
echo $rtn;
?>