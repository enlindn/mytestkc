<?php
function readDirectory($path){
    $handle = opendir($path);
    while(($item = readdir($handle))!==false){
        if($item != "." && $item != ".."){
           if(is_file($path."/".$item)){
               $arr['file'][] = $item;
           }
          if(is_dir($path."/".$item)){
              $arr['dir'][] = $item;
         }
        }
    }
    closedir($handle);
    return $arr;
}

function dirsize($path){
    $sum = 0;
    $handle = opendir($path);
    while(($item=readdir($handle))!==false){
        if($item!="."&&$item!=".."){
            if(is_file($path."/".$item)){
                $sum += filesize($path."/".$item);
            }
            if(is_dir($path."/".$item)){
                $sum += dirsize($path."/".$item);
            }
        }
    }
    closedir($handle);
    return $sum;
}
?>