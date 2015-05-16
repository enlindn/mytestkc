<?php
include_once 'common.func.php';
function transByte($size)
{
    $arr = array(
        "B",
        "KB",
        "MB",
        "GB"
    );
    $i = 0;
    while ($size >= 1024) {
        $size /= 1024;
        $i ++;
    }
    return round($size, 2) . $arr[$i];
}

function delFile($filename){
    if(unlink($filename))
        return true;
    else return false;
}

function downFile_fake($filename){
    header("content-disposition:attachment;filename=".basename($filename));
    header("content-length:".filesize($filename));
    readfile($filename);
}

function downFile($fileName, $fancyName = '', $forceDownload = true, $speedLimit = 0, $contentType = '') {
    if (!is_readable($fileName))
    {
        header("HTTP/1.1 404 Not Found");
        return false;
    }

    $fileStat = stat($fileName);
    $lastModified = $fileStat['mtime'];

    $md5 = md5($fileStat['mtime'] .'='. $fileStat['ino'] .'='. $fileStat['size']);
    $etag = '"' . $md5 . '-' . crc32($md5) . '"';

    header('Last-Modified: ' . gmdate("D, d M Y H:i:s", $lastModified) . ' GMT');
    header("ETag: $etag");

    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastModified)
    {
        header("HTTP/1.1 304 Not Modified");
        return true;
    }

    if (isset($_SERVER['HTTP_IF_UNMODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_UNMODIFIED_SINCE']) < $lastModified)
    {
        header("HTTP/1.1 304 Not Modified");
        return true;
    }

    if (isset($_SERVER['HTTP_IF_NONE_MATCH']) &&  $_SERVER['HTTP_IF_NONE_MATCH'] == $etag)
    {
        header("HTTP/1.1 304 Not Modified");
        return true;
    }

    if ($fancyName == '')
    {
        $fancyName = basename($fileName);
    }

    if ($contentType == '')
    {
        $contentType = 'application/octet-stream';
    }

    $fileSize = $fileStat['size'];

    $contentLength = $fileSize;
    $isPartial = false;

    if (isset($_SERVER['HTTP_RANGE']))
    {
        if (preg_match('/^bytes=(\d*)-(\d*)$/', $_SERVER['HTTP_RANGE'], $matches))
        {
            $startPos = $matches[1];
            $endPos = $matches[2];

            if ($startPos == '' && $endPos == '')
            {
                return false;
            }

            if ($startPos == '')
            {
                $startPos = $fileSize - $endPos;
                $endPos = $fileSize - 1;
            }
            else if ($endPos == '')
            {
                $endPos = $fileSize - 1;
            }

            $startPos = $startPos < 0 ? 0 : $startPos;
            $endPos = $endPos > $fileSize - 1 ? $fileSize - 1 : $endPos;

            $length = $endPos - $startPos + 1;

            if ($length < 0)
            {
                return false;
            }

            $contentLength = $length;
            $isPartial = true;
        }
    }

    // send headers
    if ($isPartial)
    {
        header('HTTP/1.1 206 Partial Content');
        header("Content-Range: bytes $startPos-$endPos/$fileSize");

    }
    else
    {
        header("HTTP/1.1 200 OK");
        $startPos = 0;
        $endPos = $contentLength - 1;
    }

    header('Pragma: cache');
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Accept-Ranges: bytes');
    header('Content-type: ' . $contentType);
    header('Content-Length: ' . $contentLength);

    if ($forceDownload)
    {
        header('Content-Disposition: attachment; filename="' . rawurlencode($fancyName). '"');
    }

    header("Content-Transfer-Encoding: binary");

    $bufferSize = 2048;

    if ($speedLimit != 0)
    {
        $packetTime = floor($bufferSize * 1000000 / $speedLimit);
    }

    $bytesSent = 0;
    $fp = fopen($fileName, "rb");
    fseek($fp, $startPos);
    while ($bytesSent < $contentLength && !feof($fp) && connection_status() == 0 )
    {
        if ($speedLimit != 0)
        {
            list($usec, $sec) = explode(" ", microtime());
            $outputTimeStart = ((float)$usec + (float)$sec);
        }

        $readBufferSize = $contentLength - $bytesSent < $bufferSize ? $contentLength - $bytesSent : $bufferSize;
        $buffer = fread($fp, $readBufferSize);

        echo $buffer;

        ob_flush();
        flush();

        $bytesSent += $readBufferSize;

        if ($speedLimit != 0)
        {
            list($usec, $sec) = explode(" ", microtime());
            $outputTimeEnd = ((float)$usec + (float)$sec);

            $useTime = ((float) $outputTimeEnd - (float) $outputTimeStart) * 1000000;
            $sleepTime = round($packetTime - $useTime);
            if ($sleepTime > 0)
            {
                usleep($sleepTime);
            }
        }
    }
    return true;
}

function findIfExisted($uploadpath,$filename){
    $handle=opendir($uploadpath);
    $existedFlag = 0;
    while(($item=readdir($handle))!==false){
        if($item!="."&&$item!=".."){
            if(is_file($uploadpath."/".$item)){
                if($item==$filename)
                    $existedFlag = 1;
            }
        }
    }
    closedir($handle);
    return $existedFlag;
}


function uploadfile($fileInfo, $uploadpath = "sitefile", $maxSize = 2097152)
{
    if ($fileInfo['error'] > 0) {
        switch ($fileInfo['error']) {
            case 1:
                $mes = '文件大小不符合!';
                break;
            case 2:
                $mes = '文件大小不符合!';
                break;
            case 3:
                $mes = '文件部分被上传!';
                break;
            case 4:
                $mes = '没有选择文件!';
                break;
            case 6:
                $mes = '没有找到临时目录!';
                break;
            case 7:
                $mes = '系统错误!';
                break;
        }
        alert($mes, "file.php");
        exit();
    }
  
    // $maxSize=2097152;
    if ($fileInfo['size'] > $maxSize) {
        alert('文件太大!', "file.php");
        exit();
    }
    
    if (! is_uploaded_file($fileInfo['tmp_name'])) {
        alert('文件不是通过HTTP POST方式上传上来的!', "file.php");
        exit();
    }
    
    if (! file_exists($uploadpath)) {
        alert('路径无效!', "file.php");
        exit();
    }
    
    $existedFlag = findIfExisted($uploadpath, $fileInfo['name']);
    
    if(!$existedFlag){
        $destination=$uploadpath.'/'.$fileInfo['name'];
    }else{
        onlyalert("文件是重复的,已重命名!");
        $i=1;
        $ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
        $destination=$uploadpath.'/'.basename($fileInfo['name'],".".$ext)." (".$i.").".$ext;
        while(findIfExisted($uploadpath, basename($fileInfo['name'],".".$ext)." (".$i.").".$ext)){
            $i++;
            $destination=$uploadpath.'/'.basename($fileInfo['name'],".".$ext)." (".$i.").".$ext;
        }
    }
    if (! @move_uploaded_file($fileInfo['tmp_name'], $destination)) {
        exit('文件上传失败!');
    }
    
    alert('文件上传成功!', "file.php");
    ChangeUrl("file.php");
    
    
    return $existedFlag;
}

/*function doupload($uploadpath, $fileInfo)
{
    $destination=$uploadpath.'/'.$fileInfo['name'];
    if (! @move_uploaded_file($fileInfo['tmp_name'], $destination)) {
        exit('文件上传失败!');
    }
    
    alert('文件上传成功!', "file.php");
}

function doupload_existed($uploadpath, $fileInfo)
{
    $ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
    $destination=$uploadpath.'/'.basename($fileInfo['name'],".".$ext)." (1).".$ext;
    if (! @move_uploaded_file($fileInfo['tmp_name'], $destination)) {
        //alert('文件移动失败!', "file.php");
        exit('文件上传失败!');
    }

    alert('文件上传成功!', "file.php");
}

function doupload($uploadpath,$fileInfo,$iscflag)
{
    if(!$iscflag){
        $destination=$uploadpath.'/'.$fileInfo['name'];
    }else{
        $ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
        $destination=$uploadpath.'/'.basename($fileInfo['name'],".".$ext)." (1).".$ext;
    }
    if (! @move_uploaded_file($fileInfo['tmp_name'], $destination)) {
        exit('文件上传失败!');
    }

    alert('文件上传成功!', "file.php");
    ChangeUrl("file.php");
}*/
?>