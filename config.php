<?php

$uploads_dir = "uploads/";
$thumbnails_dir = "uploads/thumbnails/";
$thumbnail_width = 90;
$thumbnail_height = 90;

/* modify only lines above this point to configure the php back end for your server */

$hostname = ( isset( $_SERVER[ "HTTPS" ] ) ? "https" : "http" ) . "://" . $_SERVER[ "SERVER_NAME" ];

$uploads_url = $hostname . dirname( dirname( $_SERVER[ "PHP_SELF" ] ) ) . "/" . $uploads_dir;
$thumbnails_url = $hostname . dirname( dirname( $_SERVER[ "PHP_SELF" ] ) ) . "/" . $thumbnails_dir;
