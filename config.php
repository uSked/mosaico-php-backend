<?php

// folders shall end with '/'
$uploads_dir = "uploads/";
$static_dir = "uploads/static/";
$thumbnails_dir = "uploads/thumbnails/";

$thumbnail_width = 90;
$thumbnail_height = 90;
// this is the base-url for images
//
$base_url = ( isset( $_SERVER[ "HTTPS" ] ) ? "https" : "http" ) . "://" . $_SERVER[ "SERVER_NAME" ] . dirname( dirname( $_SERVER[ "PHP_SELF" ] ) ) . "/";
