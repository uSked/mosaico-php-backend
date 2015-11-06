<?php

chdir( ".." );

require( "config.php" );
require( "dl/premailer.php" );

$base_url = ( isset( $_SERVER[ "HTTPS" ] ) ? "https" : "http" ) . "://" . $_SERVER[ "SERVER_NAME" ] . dirname( dirname( $_SERVER[ "PHP_SELF" ] ) ) . "/";

$premailer = Premailer::html( $_POST[ "html" ], true, "hpricot", $base_url );

$html = $premailer[ "html" ];

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
