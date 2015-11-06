<?php

chdir( ".." );

require( "config.php" );

switch ( $_POST[ "action" ] )
{
	case "download":
	{
		header( "Content-Type: application/force-download" );
		header( "Content-Disposition: attachment; filename=\"" . $_POST[ "filename" ] . "\"" );
		header( "Content-Length: " . strlen( $_POST[ "html" ] ) );
		
		echo $_POST[ "html" ];
		
		break;
	}
	
	case "email":
	{
		$to = $_POST[ "rcpt" ];
		$subject = $_POST[ "subject" ];
		$message = $_POST[ "html" ];
		
		$headers = array();
		
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/html; charset=iso-8859-1";
		$headers[] = "To: $to";
		$headers[] = "Subject: $subject";
		
		$headers = implode( "\r\n", $headers );

		if ( mail( $to, $subject, $message, $headers ) === FALSE )
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
