<?php

chdir( ".." );

require( "config.php" );
require( "dl/premailer.php" );

/* run this puppy through premailer */

$base_url = ( isset( $_SERVER[ "HTTPS" ] ) ? "https" : "http" ) . "://" . $_SERVER[ "SERVER_NAME" ] . dirname( dirname( $_SERVER[ "PHP_SELF" ] ) ) . "/";

$premailer = Premailer::html( $_POST[ "html" ], true, "hpricot", $base_url );

$html = $premailer[ "html" ];

/* create static versions of resized images */

$num_full_pattern_matches = preg_match_all( '#<img.*?src="([^"]*?\/[^/]*\.[^"]+)#i', $html, $matches );

for ( $i = 0; $i < $num_full_pattern_matches; $i++ )
{
	if ( stripos( $matches[ 1 ][ $i ], "/img?src=" ) !== FALSE )
	{
		if ( preg_match( '#/img\?src=(.*)&amp;method=(.*)&amp;params=(.*)#i', $matches[ 1 ][ $i ], $src_matches ) !== FALSE )
		{
			$file_name = urldecode( $src_matches[ 1 ] );
			$file_name = substr( $file_name, strlen( $uploads_dir ) );
			
			$method = urldecode( $src_matches[ 2 ] );
			
			$params = urldecode( $src_matches[ 3 ] );
			$params = explode( ",", $params );
			$width = (int) $params[ 0 ];
			$height = (int) $params[ 1 ];
			
			$static_file_name = $static_dir . $method . "_" . $width . "x" . $height . "_" . urlencode( $file_name );
			
			$html = str_ireplace( $matches[ 1 ][ $i ], $base_url . $static_file_name, $html );
			
			require( "img/resize.php" );
			
			$image->writeImage( $static_file_name );
		}
	}
}

/* perform the requested action */

switch ( $_POST[ "action" ] )
{
	case "download":
	{
		header( "Content-Type: application/force-download" );
		header( "Content-Disposition: attachment; filename=\"" . $_POST[ "filename" ] . "\"" );
		header( "Content-Length: " . strlen( $html ) );
		
		echo $html;
		
		break;
	}
	
	case "email":
	{
		$to = $_POST[ "rcpt" ];
		$subject = $_POST[ "subject" ];
		
		$headers = array();
		
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/html; charset=iso-8859-1";
		$headers[] = "To: $to";
		$headers[] = "Subject: $subject";
		
		$headers = implode( "\r\n", $headers );

		if ( mail( $to, $subject, $html, $headers ) === FALSE )
		{
			header( $_SERVER[ "SERVER_PROTOCOL" ] . " 500 Internal Server Error" );
			
			echo "ERR";
		}
		else
		{
			echo "OK: Mail sent.";
		}

		break;
	}
}
