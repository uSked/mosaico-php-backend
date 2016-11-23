<?php

/* note that all _URL and _DIR configurations below must end with a forward slash (/) */

$config = [
	
	/* base url for image folders */
	BASE_URL => ( array_key_exists( "HTTPS", $_SERVER ) ? "https://" : "http://" ) . $_SERVER[ "HTTP_HOST" ] . dirname( dirname( $_SERVER[ "PHP_SELF" ] ) ) . "/",
	
	/* local file system base path to where image directories are located */
	BASE_DIR => dirname( dirname( $_SERVER[ "SCRIPT_FILENAME" ] ) ) . "/",
	
	/* url to the uploads folder (relative to BASE_URL) */
	UPLOADS_URL => "data/uploads/",
	
	/* local file system path to the uploads folder (relative to BASE_DIR) */
	UPLOADS_DIR => "data/uploads/",
	
	/* url to the static images folder (relative to BASE_URL) */
	STATIC_URL => "data/static/",

	/* local file system path to the static images folder (relative to BASE_DIR) */
	STATIC_DIR => "data/static/",
	
	/* url to the thumbnail images folder (relative to BASE_URL */
	THUMBNAILS_URL => "data/thumbnails/",
	
	/* local file system path to the thumbnail images folder (relative to BASE_DIR) */
	THUMBNAILS_DIR => "data/thumbnails/",
	
	/* width and height of generated thumbnails */
	THUMBNAIL_WIDTH => 90,
	THUMBNAIL_HEIGHT => 90,

	/* premailer */
	PREMAILER => 'inlinestyle'  // inlinestyle | premailer
];
