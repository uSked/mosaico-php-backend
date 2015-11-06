<?php

chdir( ".." );

require( "config.php" );

if ( $_SERVER[ "REQUEST_METHOD" ] == "GET" )
{
	$files = array();
	
	$dir = scandir( $uploads_dir );
	
	foreach ( $dir as $file_name )
	{
		if ( is_file( $uploads_dir . $file_name ) )
		{
			$file = array(
				"name" => $file_name,
				"url" => $uploads_url . $file_name,
				"size" => filesize( $uploads_dir . $file_name )
			);
			
			if ( file_exists( realpath( $thumbnails_dir . $file_name ) ) )
			{
				$file[ "thumbnailUrl" ] = $thumbnails_url . $file_name;
			}
			
			$files[] = $file;
		}
	}
	
	header( "Content-Type: application/json; charset=utf-8" );
	header( "Connection: close" );
	
	echo json_encode( array( "files" => $files ) );
}
else if ( !empty( $_FILES ) )
{
	$files = array();
	
	foreach ( $_FILES[ "files" ][ "error" ] as $key => $error )
	{
		if ( $error == UPLOAD_ERR_OK )
		{
			$tmp_name = $_FILES[ "files" ][ "tmp_name" ][ $key ];
			
			$file_name = $_FILES[ "files" ][ "name" ][ $key ];

			if ( move_uploaded_file( $tmp_name, $uploads_dir . $file_name ) === TRUE )
			{
				$image = new Imagick( realpath( $uploads_dir . $file_name ) );
					
				$image->resizeImage( $thumbnail_width, $thumbnail_height, Imagick::FILTER_LANCZOS, 0, TRUE );
				$image->writeImage( realpath( $thumbnails_dir ) . "/". $file_name );
				$image->destroy();
				
				$file = array(
					"name" => $file_name,
					"url" => $uploads_url . $file_name,
					"size" => filesize( $uploads_dir . $file_name ),
					"thumbnailUrl" => $thumbnails_url . $file_name
				);
				
				$files[] = $file;
			}
		}
	}
	
	header( "Content-Type: application/json; charset=utf-8" );
	header( "Connection: close" );
	
	echo json_encode( array( "files" => $files ) );
}
