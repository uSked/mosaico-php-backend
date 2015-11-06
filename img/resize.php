<?php

$image = new Imagick( realpath( $uploads_dir . $file_name ) );

if ( $method == "resize" )
{
	$image->resizeImage( $width, $height, Imagick::FILTER_LANCZOS, 0 );
}
else // $method == "cover"
{
	$image_geometry = $image->getImageGeometry();

	$width_ratio = $image_geometry[ "width" ] / $width;
	$height_ratio = $image_geometry[ "height" ] / $height;

	$resize_width = $width;
	$resize_height = $height;

	if ( $width_ratio > $height_ratio )
	{
		$resize_width = 0;
	}
	else
	{
		$resize_height = 0;
	}

	$image->resizeImage( $resize_width, $resize_height, Imagick::FILTER_LANCZOS, 0 );

	$image_geometry = $image->getImageGeometry();

	$x = ( $image_geometry[ "width" ] - $width ) / 2;
	$y = ( $image_geometry[ "height" ] - $height ) / 2;

	$image->cropImage( $width, $height, $x, $y );
}
