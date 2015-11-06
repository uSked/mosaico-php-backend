<?php

chdir( ".." );

require( "config.php" );

if ( $_SERVER[ "REQUEST_METHOD" ] == "GET" )
{
	$params = explode( ",", $_GET[ "params" ] );
	
	$width = (int) $params[ 0 ];
	$height = (int) $params[ 1 ];
	
	if ( $_GET[ "method" ] == "placeholder" )
	{
		$image = new Imagick();

		$image->newImage( $width, $height, "#707070" );

		$image->setImageFormat( "png" );

		$x = 0;
		$y = 0;
		$size = 40;

		$draw = new ImagickDraw();

		while ( $y < $height )
		{
			$draw->setFillColor( "#808080" );

			$points = [
				[ "x" => $x, "y" => $y ],
				[ "x" => $x + $size, "y" => $y ],
				[ "x" => $x + $size * 2, "y" => $y + $size ],
				[ "x" => $x + $size * 2, "y" => $y + $size * 2 ]
			];

			$draw->polygon( $points );

			$points = [
				[ "x" => $x, "y" => $y + $size ],
				[ "x" => $x + $size, "y" => $y + $size * 2 ],
				[ "x" => $x, "y" => $y + $size * 2 ]
			];

			$draw->polygon( $points );

			$x += $size * 2;

			if ( $x > $width )
			{
				$x = 0;
				$y += $size * 2;
			}
		}

		$draw->setFillColor( "#B0B0B0" );
		$draw->setFontSize( $width / 5 );
		$draw->setFontWeight( 800 );
		$draw->setGravity( Imagick::GRAVITY_CENTER );
		$draw->annotation( 0, 0, $width . " x " . $height );

		$image->drawImage( $draw );

		header( "Content-type: image/png" );

		echo $image;
	}
	else
	{
		$file_name = $_GET[ "src" ];
			
		$path_parts = pathinfo( $file_name );

		switch ( $path_parts[ "extension" ] )
		{
			case "png":
				$mime_type = "image/png";
				break;

			case "gif":
				$mime_type = "image/gif";
				break;

			default:
				$mime_type = "image/jpeg";
				break;
		}

		$file_name = $path_parts[ "basename" ];

		$image = new Imagick( realpath( $uploads_dir . $file_name ) );
		
		if ( $_GET[ "method" ] == "resize" )
		{
			$image->resizeImage( $width, $height, Imagick::FILTER_LANCZOS, 0 );
		}
		else // $_GET[ "method" ] == "cover"
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

		header( "Content-type: " . $mime_type );
			
		echo $image;
	}
}
