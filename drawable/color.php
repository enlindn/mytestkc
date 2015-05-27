<?php
/**
 * Created by PhpStorm.
 * User: Illution
 * Date: 5/26/15
 * Time: 14:12
 */

function getColorHex($color) {
    $colorArray['default'] = array(0xFF, 0xFF, 0xFF);
    $colorArray['pink_swan'] = array(0xC4, 0xB5, 0xB2);
    $colorArray['blue'] = array(0x00, 0x00, 0xFF);
    $colorArray['light_grey']=array(0xD5, 0xD5, 0xD5);
    if (array_key_exists($color, $colorArray)) {
        return $colorArray[$color];
    } else {
        return $colorArray['default'];
    }
}

