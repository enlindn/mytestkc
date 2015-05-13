<?php
	$image = imagecreatetruecolor( 100, 30);
	$bgcolor = imagecolorallocate( $image, 255, 255, 255);
	imagefill($image, 0, 0, $bgcolor);
	
	for ( $i = 0; $i < 4; $i++) {
		$fontsize = 6;
		$fontcolor = imagecolorallocate( $image, 0, 0, 0);
		$fontcontent = rand( 0, 9);
		
		$x = 0;
		$y = 0;
		
		imagestring($image, #fontsize, $x, $y, $fontcontent, $fontcolor);
	}
	
	header( 'content-type: image/png');
	imagepng( $image);
	
	// end
	imagedestroy( $image);