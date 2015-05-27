<?php
/**
 * Created by PhpStorm.
 * User: Illution
 * Date: 5/26/15
 * Time: 14:03
 */

require_once "../drawable/color.php";

function createImage($digit = 4,
                     $width = 150,
                     $height = 50,
                     $backgroundColor = 'default',
                     $fontColor = 'default') {

    $image = imagecreatetruecolor($width, $height);

    list($red, $green, $blue) = getColorHex($backgroundColor);
    $backgroundColor = imagecolorallocate($image, $red, $green, $blue);
    imagefill($image, 0, 0, $backgroundColor);

    list($red, $green, $blue) = getColorHex($fontColor);
    $fontColor = imagecolorallocate($image, $red, $green, $blue);

    $code = createRandomString($digit);
    $fontfiles = array (
        "Roboto-Bold.ttf",
        "Roboto-Light.ttf",
        "Roboto-Medium.ttf",
        "Roboto-Regular.ttf"
    );

    $root = dirname(dirname(__FILE__));
    for ($i = 0; $i < $digit; $i++) {
        $size = mt_rand(14, 28);
        $angle = mt_rand(-30, 30);
        $x = 10 + $i * $width / $digit + mt_rand(-5, 5);
        $y = mt_rand ( min(25, $height), max(35, $height - $size) );
        $text = $code[$i];
        $fontfile = $root . "/font/roboto/" . $fontfiles [mt_rand ( 0, count ( $fontfiles ) - 1 )];
        $color = imagecolorallocate (
            $image,
            mt_rand ( 0, 80 ),
            mt_rand ( 0, 80 ),
            mt_rand ( 0, 80 )
        );
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }

    for ($i = 0; $i < 200; $i++) {
        $color = imagecolorallocate (
            $image,
            mt_rand ( 80, 180 ),
            mt_rand ( 80, 180 ),
            mt_rand ( 80, 180 )
        );
        $x = mt_rand(0, $width - 1);
        $y = mt_rand(0, $height - 1);
        imagesetpixel($image, $x, $y, $color);
    }

    for ($i = 0; $i < 5; $i++) {
        $color = imagecolorallocate (
            $image,
            mt_rand ( 100, 200 ),
            mt_rand ( 100, 200 ),
            mt_rand ( 100, 200 )
        );
        $x1 = mt_rand(0, $width - 1);
        $x2 = mt_rand(0, $width - 1);
        $y1 = mt_rand(0, $height - 1);
        $y2 = mt_rand(0, $height - 1);
        imageline($image, $x1, $y1, $x2, $y2, $color);
    }

    header("content-type: image/png");
    imagepng($image);
    imagedestroy($image);
}

function createRandomString($digit = 4) {
    $chars = array_merge(range("a", "z"), range("A", "Z"), range(0, 9));

    $string = "";
    for ($i = 0; $i < $digit; $i++) {
        $string .= $chars[array_rand($chars)];
    }
    return $string;
}

createImage(4, 150, 50, 'light_grey');
