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
?>