<?php
function ChangeUrl($url){
    echo "<script type='text/javascript'>location.href='$url';</script>";
}

function alert ($msg,$url="")
{
    $str = '<script type="text/javascript">';
    $str.="alert('".$msg."');";

    if ($url != "")
{
    $str.="window.location.href='{$url}';";
}
else
{
    $str.="window.history.back();";
}
echo $str.='</script>';
}

function onlyalert ($msg)
{
    $str = '<script type="text/javascript">';
    $str.="alert('".$msg."');";
    echo $str.='</script>';
}
?>